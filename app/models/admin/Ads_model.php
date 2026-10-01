<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Load all ads with optional filters, search, and pagination
     */
    public function load_all_ads($filters = array(), $limit = 0, $offset = 0) {
        $result = array();
        $this->db->select('tbl_ads.id, tbl_ads.title, tbl_ads.url, tbl_ads.banner, tbl_ads.cost_per_click, tbl_ads.business_id, tbl_business_info.business_name, tbl_ads.ads_status, tbl_ads.status, tbl_ads.budget_allocated, tbl_ads.total_bonus_allocated, tbl_ads.date_uploaded, tbl_ads.enabled_date, tbl_ads.enabled_by, tbl_ads.approved_by, tbl_ads.approved_at, tbl_ads.approval_comment, tbl_ads.rejected_by, tbl_ads.rejected_date, tbl_ads.rejected_reason, tbl_ads.country, tbl_ads.region, tbl_ads.district, tbl_admin_info.name as approver_name');
        $this->db->from('tbl_ads');
        $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id', 'left');
        $this->db->join('tbl_admin_info', 'tbl_admin_info.admin_id = tbl_ads.approved_by', 'left');

        // General non-deleted check
        $this->db->where('tbl_ads.status!=', '1');

        // Filter by Status
        if (isset($filters['status']) && $filters['status'] !== '' && $filters['status'] !== 'all') {
            $this->db->where('tbl_ads.ads_status', (int)$filters['status']);
        }

        // Search by ID, Title, Business Name, Location
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $this->db->group_start();
            $this->db->like('tbl_ads.title', $search);
            $this->db->or_like('tbl_business_info.business_name', $search);
            $this->db->or_like('tbl_ads.region', $search);
            $this->db->or_like('tbl_ads.district', $search);
            if (is_numeric($search)) {
                $this->db->or_where('tbl_ads.id', (int)$search);
            }
            $this->db->group_end();
        }

        // Filter by Date Range
        if (!empty($filters['start_date'])) {
            $this->db->where('tbl_ads.date_uploaded >=', $filters['start_date'] . ' 00:00:00');
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('tbl_ads.date_uploaded <=', $filters['end_date'] . ' 23:59:59');
        }

        $this->db->order_by('tbl_ads.date_uploaded', 'DESC');

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
        }
        return $result;
    }

    /**
     * Count total ads matching filters for pagination
     */
    public function count_all_ads($filters = array()) {
        $this->db->from('tbl_ads');
        $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id', 'left');
        $this->db->where('tbl_ads.status!=', '1');

        if (isset($filters['status']) && $filters['status'] !== '' && $filters['status'] !== 'all') {
            $this->db->where('tbl_ads.ads_status', (int)$filters['status']);
        }
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $this->db->group_start();
            $this->db->like('tbl_ads.title', $search);
            $this->db->or_like('tbl_business_info.business_name', $search);
            $this->db->or_like('tbl_ads.region', $search);
            $this->db->or_like('tbl_ads.district', $search);
            if (is_numeric($search)) {
                $this->db->or_where('tbl_ads.id', (int)$search);
            }
            $this->db->group_end();
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('tbl_ads.date_uploaded >=', $filters['start_date'] . ' 00:00:00');
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('tbl_ads.date_uploaded <=', $filters['end_date'] . ' 23:59:59');
        }

        return $this->db->count_all_results();
    }

    /**
     * Load pending ads (status 2)
     */
    public function load_pending_ads() {
        return $this->load_all_ads(['status' => AD_STATUS_PENDING]);
    }

    /**
     * Load active ads (status 1)
     */
    public function load_active_ads() {
        return $this->load_all_ads(['status' => AD_STATUS_ACTIVE]);
    }

    /**
     * Load denied/rejected ads (status 3)
     */
    public function load_denied_ads() {
        return $this->load_all_ads(['status' => AD_STATUS_REJECTED]);
    }

    /**
     * Load closed ads (status 0)
     */
    public function load_closed_ads() {
        return $this->load_all_ads(['status' => AD_STATUS_CLOSED]);
    }

    /**
     * Load full ad details for review workstation
     */
    public function load_ads_details($ads_id) {
        $result = array();
        $this->db->select('tbl_ads.*, 
            tbl_business_info.business_name, tbl_business_info.business_phone, tbl_business_info.business_email, tbl_business_info.business_website, tbl_business_info.TIN, tbl_business_info.business_address, tbl_business_info.name as owner_name, tbl_business_info.logo as business_logo, tbl_business_info.createdDate as business_created,
            approver_info.name as approver_name, approver_info.email as approver_email,
            rejector_info.name as rejector_name, rejector_info.email as rejector_email');
        $this->db->from('tbl_ads');
        $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id', 'left');
        $this->db->join('tbl_admin_info as approver_info', 'approver_info.admin_id = tbl_ads.approved_by', 'left');
        $this->db->join('tbl_admin_info as rejector_info', 'rejector_info.admin_id = tbl_ads.rejected_by', 'left');
        $this->db->where('tbl_ads.id', (int)$ads_id);
        $this->db->where('tbl_ads.status!=', '1');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row_array();

            // Load associated quiz questions
            $this->db->select('*');
            $this->db->from('tbl_questions');
            $this->db->where('ads_id', (int)$ads_id);
            $this->db->where('status', '0');
            $qRes = $this->db->get();
            $result['questions'] = $qRes->result_array();

            // Load approval history audit trail for this ad
            $result['history'] = $this->load_approval_history((int)$ads_id);
        }
        return $result;
    }

    /**
     * Approve and activate an advertisement
     * PENDING -> ACTIVE (1)
     */
    public function approve_ad($ad_id, $admin_id, $comment = '') {
        $ad_id = (int)$ad_id;
        $now = date('Y-m-d H:i:s');
        $comment = trim($comment);
        if (empty($comment)) {
            $comment = 'Advertisement reviewed and verified. Approved & activated.';
        }

        // Fetch current ad status to ensure it exists
        $ad = $this->db->where('id', $ad_id)->where('status!=', '1')->get('tbl_ads')->row_array();
        if (empty($ad)) {
            return ['success' => false, 'message' => 'Advertisement not found.'];
        }

        $this->db->trans_start();

        // Update tbl_ads
        $updateData = [
            'ads_status'       => AD_STATUS_ACTIVE,
            'enabled_by'       => $admin_id,
            'enabled_date'     => $now,
            'approved_by'      => $admin_id,
            'approved_at'      => $now,
            'approval_comment' => $comment,
            'updated_at'       => $now
        ];
        $this->db->where('id', $ad_id)->update('tbl_ads', $updateData);

        // Record in tbl_ad_approval_history audit trail
        $this->db->insert('tbl_ad_approval_history', [
            'ad_id'      => $ad_id,
            'admin_id'   => $admin_id,
            'action'     => 'APPROVED',
            'comment'    => $comment,
            'created_at' => $now
        ]);

        // Record in system audit trails
        if (function_exists('recordTrails')) {
            $adminUsername = $this->session->userdata('admin_username') ?? 'Admin #' . $admin_id;
            recordTrails('tbl_ads', $ad_id, "Approved & Activated Ad #$ad_id: {$ad['title']}", $adminUsername);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return ['success' => false, 'message' => 'Failed to approve advertisement due to a database error.'];
        }

        return ['success' => true, 'message' => 'Advertisement approved successfully and is now ACTIVE.'];
    }

    /**
     * Reject an advertisement with mandatory reason
     * PENDING -> REJECTED (3)
     */
    public function reject_ad($ad_id, $admin_id, $reason) {
        $ad_id = (int)$ad_id;
        $now = date('Y-m-d H:i:s');
        $reason = trim($reason);

        if (empty($reason)) {
            return ['success' => false, 'message' => 'Rejection reason is mandatory.'];
        }

        // Fetch current ad
        $ad = $this->db->where('id', $ad_id)->where('status!=', '1')->get('tbl_ads')->row_array();
        if (empty($ad)) {
            return ['success' => false, 'message' => 'Advertisement not found.'];
        }

        $this->db->trans_start();

        // Update tbl_ads
        $updateData = [
            'ads_status'      => AD_STATUS_REJECTED,
            'rejected_by'     => $admin_id,
            'rejected_date'   => $now,
            'rejected_reason' => $reason,
            'updated_at'      => $now
        ];
        $this->db->where('id', $ad_id)->update('tbl_ads', $updateData);

        // Record in tbl_ad_approval_history
        $this->db->insert('tbl_ad_approval_history', [
            'ad_id'      => $ad_id,
            'admin_id'   => $admin_id,
            'action'     => 'REJECTED',
            'comment'    => $reason,
            'created_at' => $now
        ]);

        // Record in system audit trails
        if (function_exists('recordTrails')) {
            $adminUsername = $this->session->userdata('admin_username') ?? 'Admin #' . $admin_id;
            recordTrails('tbl_ads', $ad_id, "Rejected Ad #$ad_id: {$ad['title']} - Reason: $reason", $adminUsername);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return ['success' => false, 'message' => 'Failed to reject advertisement due to a database error.'];
        }

        return ['success' => true, 'message' => 'Advertisement rejected successfully.'];
    }

    /**
     * Backward-compatible reject_ads method called by existing code
     */
    public function reject_ads($data, $userID) {
        $ad_id = $data['ads'] ?? ($data['ad_id'] ?? 0);
        $reason = $data['rejected_reason'] ?? '';
        $res = $this->reject_ad($ad_id, $userID, $reason);
        return $res['success'] ? 'Success' : $res['message'];
    }

    /**
     * Load approval history audit trail for an ad or globally
     */
    public function load_approval_history($ad_id = null, $filters = array(), $limit = 50, $offset = 0) {
        $this->db->select('tbl_ad_approval_history.*, 
            tbl_ads.title as ad_title, tbl_ads.banner as ad_banner, tbl_ads.ads_status as current_ad_status,
            tbl_business_info.business_name,
            tbl_admin_info.name as admin_name, tbl_admin.username as admin_username');
        $this->db->from('tbl_ad_approval_history');
        $this->db->join('tbl_ads', 'tbl_ads.id = tbl_ad_approval_history.ad_id', 'left');
        $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id', 'left');
        $this->db->join('tbl_admin', 'tbl_admin.id = tbl_ad_approval_history.admin_id', 'left');
        $this->db->join('tbl_admin_info', 'tbl_admin_info.admin_id = tbl_ad_approval_history.admin_id', 'left');

        if ($ad_id !== null && $ad_id > 0) {
            $this->db->where('tbl_ad_approval_history.ad_id', (int)$ad_id);
        }

        if (!empty($filters['action']) && $filters['action'] !== 'all') {
            $this->db->where('tbl_ad_approval_history.action', strtoupper(trim($filters['action'])));
        }

        if (!empty($filters['search'])) {
            $s = trim($filters['search']);
            $this->db->group_start();
            $this->db->like('tbl_ads.title', $s);
            $this->db->or_like('tbl_business_info.business_name', $s);
            $this->db->or_like('tbl_admin_info.name', $s);
            $this->db->or_like('tbl_ad_approval_history.comment', $s);
            if (is_numeric($s)) {
                $this->db->or_where('tbl_ad_approval_history.ad_id', (int)$s);
            }
            $this->db->group_end();
        }

        if (!empty($filters['start_date'])) {
            $this->db->where('tbl_ad_approval_history.created_at >=', $filters['start_date'] . ' 00:00:00');
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('tbl_ad_approval_history.created_at <=', $filters['end_date'] . ' 23:59:59');
        }

        $this->db->order_by('tbl_ad_approval_history.created_at', 'DESC');

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result();
    }

    /**
     * Count approval history logs matching filters
     */
    public function count_approval_history($ad_id = null, $filters = array()) {
        $this->db->from('tbl_ad_approval_history');
        $this->db->join('tbl_ads', 'tbl_ads.id = tbl_ad_approval_history.ad_id', 'left');
        $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id', 'left');
        $this->db->join('tbl_admin_info', 'tbl_admin_info.admin_id = tbl_ad_approval_history.admin_id', 'left');

        if ($ad_id !== null && $ad_id > 0) {
            $this->db->where('tbl_ad_approval_history.ad_id', (int)$ad_id);
        }
        if (!empty($filters['action']) && $filters['action'] !== 'all') {
            $this->db->where('tbl_ad_approval_history.action', strtoupper(trim($filters['action'])));
        }
        if (!empty($filters['search'])) {
            $s = trim($filters['search']);
            $this->db->group_start();
            $this->db->like('tbl_ads.title', $s);
            $this->db->or_like('tbl_business_info.business_name', $s);
            $this->db->or_like('tbl_admin_info.name', $s);
            $this->db->or_like('tbl_ad_approval_history.comment', $s);
            if (is_numeric($s)) {
                $this->db->or_where('tbl_ad_approval_history.ad_id', (int)$s);
            }
            $this->db->group_end();
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('tbl_ad_approval_history.created_at >=', $filters['start_date'] . ' 00:00:00');
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('tbl_ad_approval_history.created_at <=', $filters['end_date'] . ' 23:59:59');
        }

        return $this->db->count_all_results();
    }

    /**
     * Close advertisement
     */
    public function close_ads($info, $userID) {
        $this->db->set('ads_status', '0');
        $this->db->set('closed_by', $userID);
        $this->db->set('closed_date', date("Y-m-d H:i:s"));
        $this->db->where('id', $info);
        $this->db->update('tbl_ads');

        $this->db->insert('tbl_ad_approval_history', [
            'ad_id'      => $info,
            'admin_id'   => $userID,
            'action'     => 'CLOSED',
            'comment'    => 'Advertisement closed by administrator.',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        return 'Success';
    }

    /**
     * Enable ads (alias to approve)
     */
    public function enable_ads($info, $userID) {
        $res = $this->approve_ad($info, $userID, 'Enabled by administrator.');
        return $res['success'] ? 'Success' : $res['message'];
    }

    /**
     * Disable ads (change to pending)
     */
    public function disable_ads($info, $userID) {
        $this->db->set('ads_status', '2');
        $this->db->set('disabled_by', $userID);
        $this->db->set('disabled_date', date("Y-m-d H:i:s"));
        $this->db->where('id', $info);
        $this->db->update('tbl_ads');
        return 'Success';
    }

    public function load_promos() {
        $result = array();
        $this->db->select('id, title, banner, view_location, expire_date, createdDate, cost, status, url');
        $this->db->from('tbl_promo');
        $this->db->where('status!=', '1');
        $this->db->order_by('createdDate', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            $result = $query->result();
        return $result;
    }

    public function load_promo_info($promo_id) {
        $result = array();
        $this->db->select('id, title, banner, view_location, expire_date, createdDate, cost, url');
        $this->db->from('tbl_promo');
        $this->db->where('id', $promo_id);
        $this->db->where('status!=', '1');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            $result = $query->row_array();
        return $result;
    }

    public function save_promo($data, $userID) {
        $createdDate = date("Y-m-d H:i:s");
        $title = $data['title'];
        $url = $data['url'];
        $view_location = $data['view_location'];
        $expire_date = $data['expire_date'];
        $cost = $data['cost'];
        $this->db->select('id');
        $this->db->where('title', $title);
        $this->db->where('status', '0');
        $query = $this->db->get('tbl_promo');
        if ($query->num_rows() > 0) {
            return ErrorMsg('Sorry! This promo already exist');
        } else {
            $bannerFile = "";
            unset($_SESSION['uploaded_file']);
            if (isset($_FILES['banner']) && $_FILES['banner']['name'] != "") {
                $banner = do_upload('media/promo', 'banner', str_replace(" ", "_", $title), '', '', '', 'image');
                if ($banner != 'ok') {
                    die(ErrorMsg($banner));
                }
            } else {
                die(ErrorMsg('Please! upload promo banner'));
            }
            if (!empty($this->session->userdata('uploaded_file')) && $this->session->userdata('uploaded_file') != "") {
                $bannerFile = $this->session->userdata('uploaded_file');
            }
            $set = $this->db->insert('tbl_promo', array(
                'title' => $title,
                'url' => $url,
                'view_location' => $view_location,
                'expire_date' => $expire_date,
                'cost' => $cost,
                'banner' => $bannerFile,
                'status' => '0',
                'createdBy' => $userID,
                'createdDate' => $createdDate
            ));
            if ($set) {
                return 'Success';
            } else {
                return $this->db->_error_message();
            }
        }
    }

    public function update_promo($data, $userID) {
        $title = $data['title'];
        $url = $data['url'];
        $view_location = $data['view_location'];
        $expire_date = $data['expire_date'];
        $cost = $data['cost'];
        $promo = $data['promo'];
        $this->db->select('id');
        $this->db->where('id!=', $promo);
        $this->db->where('title', $title);
        $this->db->where('status', '0');
        $query = $this->db->get('tbl_promo');
        if ($query->num_rows() > 0) {
            return ErrorMsg('Sorry! This promo already exist');
        } else {
            $bannerFile = "";
            unset($_SESSION['uploaded_file']);
            if (isset($_FILES['banner']) && $_FILES['banner']['name'] != "") {
                $banner = do_upload('media/promo', 'banner', str_replace(" ", "_", $title), '', '', '', 'image');
                if ($banner != 'ok') {
                    die(ErrorMsg($banner));
                }
            }
            if (!empty($this->session->userdata('uploaded_file')) && $this->session->userdata('uploaded_file') != "") {
                $bannerFile = $this->session->userdata('uploaded_file');
            }
            $set = array(
                'title' => $title,
                'url' => $url,
                'view_location' => $view_location,
                'expire_date' => $expire_date,
                'cost' => $cost
            );
            if ($bannerFile != "") {
                $set['banner'] = $bannerFile;
            }
            $this->db->where('id', $promo);
            $this->db->update('tbl_promo', $set);
            return 'Success';
        }
    }
}