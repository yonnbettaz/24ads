<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Authentication & Authorization Security Library
 *
 * Implements:
 * - Secure password hashing using PHP password_hash() / password_verify()
 * - Legacy hash compatibility and automatic re-hashing
 * - Session fixation protection (session_regenerate_id)
 * - Session timeout handling (30 minutes inactivity)
 * - Brute-force rate limiting (5 failed attempts per 15 mins)
 * - Strict server-side role and permission checks (HTTP 403 enforcement)
 * - CSRF token generation and verification
 */
class Admin_auth {

    protected $CI;
    protected $session_timeout = 1800; // 30 minutes in seconds
    protected $max_attempts = 5;
    protected $lockout_time = 900; // 15 minutes

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->library('session');
    }

    /**
     * Verify password with modern password_verify, with backward compatibility
     * for legacy sha1(md5(md5($password))) and auto-upgrade.
     *
     * @param string $plainPassword
     * @param string $storedHash
     * @param int|string $adminId Optional ID to auto-upgrade hash in database
     * @return bool
     */
    public function verify_password($plainPassword, $storedHash, $adminId = null) {
        // Modern password_hash check
        if (password_verify($plainPassword, $storedHash)) {
            // Check if password needs rehash according to updated algo/cost
            if ($adminId && password_needs_rehash($storedHash, PASSWORD_BCRYPT)) {
                $newHash = $this->hash_password($plainPassword);
                $this->CI->db->where('id', $adminId)->update('tbl_admin', ['password' => $newHash]);
            }
            return true;
        }

        // Legacy 24ads password format: sha1(md5(md5($password)))
        $legacyHash = sha1(md5(md5($plainPassword)));
        if (hash_equals($storedHash, $legacyHash) || $storedHash === $legacyHash) {
            // Auto-upgrade stored hash to modern bcrypt password_hash
            if ($adminId) {
                $newHash = $this->hash_password($plainPassword);
                $this->CI->db->where('id', $adminId)->update('tbl_admin', ['password' => $newHash]);
            }
            return true;
        }

        return false;
    }

    /**
     * Hash password using modern BCRYPT
     *
     * @param string $plainPassword
     * @return string
     */
    public function hash_password($plainPassword) {
        return password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * Check if client IP/username is rate-limited
     *
     * @param string $username
     * @return bool True if allowed, False if rate limited
     */
    public function check_rate_limit($username) {
        $ip = $this->CI->input->ip_address();
        $cutoff = time() - $this->lockout_time;

        $this->CI->db->where('attempt_time >=', $cutoff);
        $this->CI->db->group_start();
        $this->CI->db->where('ip_address', $ip);
        $this->CI->db->or_where('username', $username);
        $this->CI->db->group_end();
        $attempts = $this->CI->db->count_all_results('tbl_login_attempts');

        return ($attempts < $this->max_attempts);
    }

    /**
     * Record a failed login attempt
     *
     * @param string $username
     */
    public function record_failed_attempt($username) {
        $ip = $this->CI->input->ip_address();
        $this->CI->db->insert('tbl_login_attempts', [
            'ip_address' => $ip,
            'username' => substr($username, 0, 100),
            'attempt_time' => time()
        ]);
    }

    /**
     * Clear failed login attempts after successful authentication
     *
     * @param string $username
     */
    public function clear_failed_attempts($username) {
        $ip = $this->CI->input->ip_address();
        $this->CI->db->where('ip_address', $ip)->or_where('username', $username)->delete('tbl_login_attempts');
    }

    /**
     * Authenticate administrator user
     *
     * @param string $username
     * @param string $password
     * @return array [success => bool, message => string]
     */
    public function login($username, $password) {
        $username = trim($username);

        if (empty($username) || empty($password)) {
            return ['success' => false, 'message' => 'Please enter both username and password.'];
        }

        // Rate limiting check
        if (!$this->check_rate_limit($username)) {
            return [
                'success' => false,
                'message' => 'Too many failed login attempts. Please wait 15 minutes before trying again.'
            ];
        }

        // Fetch administrator by username or email
        $this->CI->db->select('tbl_admin.*, tbl_roles.role_name, tbl_roles.permissions, tbl_roles.status as role_status');
        $this->CI->db->from('tbl_admin');
        $this->CI->db->join('tbl_roles', 'tbl_roles.id = tbl_admin.role', 'left');
        $this->CI->db->where('tbl_admin.username', $username);
        $this->CI->db->where('tbl_admin.status', '0'); // Active admins only
        $query = $this->CI->db->get();

        if ($query->num_rows() === 0) {
            $this->record_failed_attempt($username);
            return ['success' => false, 'message' => 'Invalid username or password.'];
        }

        $admin = $query->row_array();

        // Check if role is deactivated
        if ($admin['role_status'] === '1') {
            return ['success' => false, 'message' => 'Your administrator account role is currently disabled.'];
        }

        // Verify password
        if (!$this->verify_password($password, $admin['password'], $admin['id'])) {
            $this->record_failed_attempt($username);
            return ['success' => false, 'message' => 'Invalid username or password.'];
        }

        // Clear failed attempts
        $this->clear_failed_attempts($username);

        // Session fixation protection: regenerate session ID
        if (session_status() === PHP_SESSION_ACTIVE) {
            @session_regenerate_id(true);
        }

        // Generate fresh secure token
        $token = md5(uniqid(mt_rand(), true)) . bin2hex(random_bytes(16));
        $now = date('Y-m-d H:i:s');
        $this->CI->db->where('id', $admin['id'])->update('tbl_admin', [
            'token' => $token,
            'last_login' => $now
        ]);

        // Fetch admin info
        $this->CI->db->where('admin_id', $admin['id'])->where('status', '0');
        $info = $this->CI->db->get('tbl_admin_info')->row_array();
        $fullName = !empty($info['name']) ? $info['name'] : $admin['username'];
        $avatar = (!empty($info['avatar'])) ? $info['avatar'] : 'default.png';

        // Set session data
        $sessionData = [
            '24ads_ad_user_idetification' => $token,
            'admin_id'                   => (int)$admin['id'],
            'admin_username'             => $admin['username'],
            'user_full_name'             => $fullName,
            'user_avatar'                => $avatar,
            'admin_role_id'              => (int)$admin['role'],
            'admin_role_name'            => $admin['role_name'] ?? 'Administrator',
            'admin_permissions'          => $admin['permissions'] ?? 'all',
            'admin_last_activity'        => time(),
            'admin_logged_in'            => true
        ];
        $this->CI->session->set_userdata($sessionData);

        // Generate fresh CSRF token
        $this->get_csrf_token(true);

        return ['success' => true, 'message' => 'Login successful.'];
    }

    /**
     * Logout administrator
     */
    public function logout() {
        $keys = [
            '24ads_ad_user_idetification',
            'admin_id',
            'admin_username',
            'user_full_name',
            'user_avatar',
            'admin_role_id',
            'admin_role_name',
            'admin_permissions',
            'admin_last_activity',
            'admin_logged_in',
            'admin_csrf_token'
        ];
        $this->CI->session->unset_userdata($keys);
        if (session_status() === PHP_SESSION_ACTIVE) {
            @session_regenerate_id(true);
        }
    }

    /**
     * Check if currently logged-in user is an active administrator.
     * Enforces session expiration and role validation.
     *
     * @return bool
     */
    public function is_admin() {
        $token = $this->CI->session->userdata('24ads_ad_user_idetification');
        if (empty($token)) {
            return false;
        }

        // Check session inactivity timeout
        $lastActivity = $this->CI->session->userdata('admin_last_activity');
        if ($lastActivity && (time() - $lastActivity > $this->session_timeout)) {
            $this->logout();
            return false;
        }

        // Verify token in database
        $this->CI->db->select('tbl_admin.id, tbl_admin.status, tbl_admin.role, tbl_roles.role_name, tbl_roles.permissions, tbl_roles.status as role_status');
        $this->CI->db->from('tbl_admin');
        $this->CI->db->join('tbl_roles', 'tbl_roles.id = tbl_admin.role', 'left');
        $this->CI->db->where('tbl_admin.token', $token);
        $this->CI->db->where('tbl_admin.status', '0');
        $query = $this->CI->db->get();

        if ($query->num_rows() === 0) {
            return false;
        }

        $row = $query->row_array();
        if ($row['role_status'] === '1') {
            return false;
        }

        // Refresh activity time
        $this->CI->session->set_userdata('admin_last_activity', time());
        return true;
    }

    /**
     * Enforce administrator access server-side.
     * Denies non-admins with HTTP 403 Forbidden.
     *
     * @param string|null $requiredPermission
     * @param bool $isAjax
     */
    public function require_admin($requiredPermission = null, $isAjax = false) {
        if (!$this->is_admin()) {
            if ($isAjax || $this->CI->input->is_ajax_request()) {
                $this->CI->output
                    ->set_status_header(403)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => false,
                        'message' => 'Access Denied: You are not authorized or your session has expired.'
                    ]))
                    ->_display();
                exit;
            } else {
                redirect('admin/users/login');
                exit;
            }
        }

        if ($requiredPermission && !$this->has_permission($requiredPermission)) {
            if ($isAjax || $this->CI->input->is_ajax_request()) {
                $this->CI->output
                    ->set_status_header(403)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'success' => false,
                        'message' => 'Access Denied: You do not possess the required permission: ' . $requiredPermission
                    ]))
                    ->_display();
                exit;
            } else {
                show_error('Access Denied: You do not possess the required administrator permission.', 403, '403 Forbidden');
                exit;
            }
        }
    }

    /**
     * Check if admin possesses specific permission
     *
     * @param string $permission
     * @return bool
     */
    public function has_permission($permission) {
        $permissions = (string)$this->CI->session->userdata('admin_permissions');
        if (empty($permissions)) {
            // Fallback: check role in database
            $roleId = $this->CI->session->userdata('admin_role_id');
            if ($roleId) {
                $role = $this->CI->db->select('permissions')->where('id', $roleId)->get('tbl_roles')->row_array();
                $permissions = $role['permissions'] ?? '';
            }
        }

        if ($permissions === 'all' || strpos($permissions, 'all') !== false) {
            return true;
        }

        $permList = array_map('trim', explode(',', strtolower($permissions)));
        return in_array(strtolower($permission), $permList, true);
    }

    /**
     * Get the CSRF token input field name
     *
     * @return string
     */
    public function get_csrf_token_name() {
        return 'admin_csrf_token';
    }

    /**
     * Get or generate CSRF token for admin actions
     *
     * @param bool $regenerate
     * @return string
     */
    public function get_csrf_token($regenerate = false) {
        $token = $this->CI->session->userdata('admin_csrf_token');
        if (!$token || $regenerate) {
            $token = bin2hex(random_bytes(32));
            $this->CI->session->set_userdata('admin_csrf_token', $token);
        }
        return $token;
    }

    /**
     * Verify CSRF token from request
     *
     * @param string|null $token
     * @return bool
     */
    public function verify_csrf_token($token = null) {
        if ($token === null) {
            $token = $this->CI->input->post('admin_csrf_token');
            if (empty($token)) {
                $token = $this->CI->input->get_request_header('X-CSRF-TOKEN', true);
            }
            if (empty($token)) {
                $token = $this->CI->input->get('admin_csrf_token');
            }
        }

        $sessionToken = $this->CI->session->userdata('admin_csrf_token');
        if (empty($token) || empty($sessionToken)) {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }

    /**
     * Get current admin user ID
     *
     * @return int|null
     */
    public function get_admin_id() {
        return (int)$this->CI->session->userdata('admin_id');
    }

    /**
     * Get current admin username
     *
     * @return string
     */
    public function get_admin_username() {
        return (string)$this->CI->session->userdata('admin_username');
    }
}
