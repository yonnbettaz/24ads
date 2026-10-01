<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Ads_model');
        $this->admin_auth->require_admin();
        $this->userToken = $this->session->userdata('24ads_ad_user_idetification');
        $this->userID = $this->admin_auth->get_admin_id() ? $this->admin_auth->get_admin_id() : getAdminUserID($this->userToken);
    }

    public function index($page = "all_ads") {
        if ($page == 'all_ads' || $page == 'index') {
            $this->all_ads();
            return;
        }

        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucwords(str_replace("_", " ", $page)) . ' - 24ads';
        $this->setView($page, $data);
    }

    public function setView($page = 'all_ads', $data = array()) {
        $this->load->view('includes/admin_header.php', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('includes/admin_footer.php', $data);
    }

    /**
     * All Advertisements Listing with search, filter, and pagination
     */
    public function all_ads() {
        $data['title'] = 'All Advertisements - 24ads';
        $data['page_header'] = 'Advertisements';
        $data['page_title'] = 'All Advertisements';

        $filters = [
            'status'     => $this->input->get('status'),
            'search'     => $this->input->get('search'),
            'start_date' => $this->input->get('start_date'),
            'end_date'   => $this->input->get('end_date')
        ];

        $page = max(1, (int)$this->input->get('page'));
        $perPage = 20;
        $offset = ($page - 1) * $perPage;

        $totalRecords = $this->Ads_model->count_all_ads($filters);
        $data['ads'] = $this->Ads_model->load_all_ads($filters, $perPage, $offset);
        $data['filters'] = $filters;
        $data['total_records'] = $totalRecords;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($totalRecords / $perPage);
        $data['csrf_token'] = $this->admin_auth->get_csrf_token();

        $this->setView('all_ads', $data);
    }

    /**
     * Pending approval ads list
     */
    public function pending_ads() {
        $data['title'] = 'Pending Advertisements - 24ads';
        $data['page_header'] = 'Pending Review';
        $data['page_title'] = 'Advertisements';
        $data['ads'] = $this->Ads_model->load_pending_ads();
        $data['csrf_token'] = $this->admin_auth->get_csrf_token();
        $this->setView('pending_ads', $data);
    }

    /**
     * Active ads list
     */
    public function active_ads() {
        $data['title'] = 'Active Advertisements - 24ads';
        $data['page_header'] = 'Active Advertisements';
        $data['page_title'] = 'Advertisements';
        $data['ads'] = $this->Ads_model->load_active_ads();
        $data['csrf_token'] = $this->admin_auth->get_csrf_token();
        $this->setView('active_ads', $data);
    }

    /**
     * Rejected ads list
     */
    public function denied_ads() {
        $data['title'] = 'Rejected Advertisements - 24ads';
        $data['page_header'] = 'Rejected Advertisements';
        $data['page_title'] = 'Advertisements';
        $data['ads'] = $this->Ads_model->load_denied_ads();
        $data['csrf_token'] = $this->admin_auth->get_csrf_token();
        $this->setView('denied_ads', $data);
    }

    /**
     * Alias for denied_ads
     */
    public function rejected_ads() {
        $this->denied_ads();
    }

    /**
     * Closed ads list
     */
    public function closed_ads() {
        $data['title'] = 'Closed Advertisements - 24ads';
        $data['page_header'] = 'Closed Advertisements';
        $data['page_title'] = 'Advertisements';
        $data['ads'] = $this->Ads_model->load_closed_ads();
        $data['csrf_token'] = $this->admin_auth->get_csrf_token();
        $this->setView('closed_ads', $data);
    }

    /**
     * Advertisement detailed review workstation
     */
    public function review() {
        $adId = (int)$this->input->get('ads');
        if (empty($adId)) {
            $adId = (int)$this->input->get('id');
        }

        if (empty($adId)) {
            redirect('admin/ads/pending_ads');
            return;
        }

        $info = $this->Ads_model->load_ads_details($adId);
        if (empty($info)) {
            show_404();
            return;
        }

        $data['title'] = 'Review Ad #' . $adId . ' - 24ads';
        $data['page_header'] = 'Advertisement Inspection';
        $data['page_title'] = 'Review Ad #' . $adId;
        $data['info'] = $info;
        $data['ads'] = $adId;
        $data['csrf_token'] = $this->admin_auth->get_csrf_token();

        $this->setView('ads_details', $data);
    }

    /**
     * Alias for review page
     */
    public function ads_details() {
        $this->review();
    }

    /**
     * Dedicated Approval History audit trail page
     */
    public function approval_history() {
        $data['title'] = 'Approval History & Audit Trail - 24ads';
        $data['page_header'] = 'Audit Trail';
        $data['page_title'] = 'Approval History';

        $filters = [
            'action'     => $this->input->get('action'),
            'search'     => $this->input->get('search'),
            'start_date' => $this->input->get('start_date'),
            'end_date'   => $this->input->get('end_date')
        ];

        $page = max(1, (int)$this->input->get('page'));
        $perPage = 25;
        $offset = ($page - 1) * $perPage;

        $totalRecords = $this->Ads_model->count_approval_history(null, $filters);
        $data['history'] = $this->Ads_model->load_approval_history(null, $filters, $perPage, $offset);
        $data['filters'] = $filters;
        $data['total_records'] = $totalRecords;
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($totalRecords / $perPage);

        $this->setView('approval_history', $data);
    }

    /**
     * AJAX Endpoint: Approve & Activate Advertisement
     */
    public function approve_ad() {
        // Enforce authorization
        $this->admin_auth->require_admin('approve_ads', true);

        // Verify CSRF
        if (!$this->admin_auth->verify_csrf_token()) {
            echo json_encode([
                'success' => false,
                'message' => 'CSRF verification failed or security token expired. Please refresh the page.'
            ]);
            return;
        }

        $adId = (int)$this->input->post('ads_id');
        if (empty($adId)) {
            $adId = (int)$this->input->post('ads');
        }

        if (empty($adId)) {
            echo json_encode(['success' => false, 'message' => 'Invalid advertisement identifier.']);
            return;
        }

        $comment = trim($this->input->post('approval_comment'));
        $adminId = $this->admin_auth->get_admin_id() ?: $this->userID;

        $result = $this->Ads_model->approve_ad($adId, $adminId, $comment);
        $result['csrf_token'] = $this->admin_auth->get_csrf_token(true);

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    /**
     * AJAX Endpoint: Reject Advertisement
     */
    public function reject_ad() {
        // Enforce authorization
        $this->admin_auth->require_admin('reject_ads', true);

        // Verify CSRF
        if (!$this->admin_auth->verify_csrf_token()) {
            echo json_encode([
                'success' => false,
                'message' => 'CSRF verification failed or security token expired. Please refresh the page.'
            ]);
            return;
        }

        $adId = (int)$this->input->post('ads_id');
        if (empty($adId)) {
            $adId = (int)$this->input->post('ads');
        }

        $reason = trim($this->input->post('rejected_reason'));

        if (empty($adId)) {
            echo json_encode(['success' => false, 'message' => 'Invalid advertisement identifier.']);
            return;
        }

        if (empty($reason)) {
            echo json_encode(['success' => false, 'message' => 'Rejection reason is required. Please specify why this ad is being rejected.']);
            return;
        }

        $adminId = $this->admin_auth->get_admin_id() ?: $this->userID;

        $result = $this->Ads_model->reject_ad($adId, $adminId, $reason);
        $result['csrf_token'] = $this->admin_auth->get_csrf_token(true);

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    /**
     * Legacy reject_ads POST endpoint (returns string or JSON)
     */
    public function reject_ads() {
        $this->admin_auth->require_admin('reject_ads', true);
        $data = $this->input->post();
        $adId = (int)($data['ads'] ?? 0);
        $reason = trim($data['rejected_reason'] ?? '');

        if (empty($adId) || empty($reason)) {
            echo ErrorMsg('Rejection reason is mandatory.');
            return;
        }

        $adminId = $this->admin_auth->get_admin_id() ?: $this->userID;
        $res = $this->Ads_model->reject_ad($adId, $adminId, $reason);
        if ($res['success']) {
            echo 'Success';
        } else {
            echo ErrorMsg($res['message']);
        }
    }

    /**
     * Enable ads (alias to approve)
     */
    public function enable_ads() {
        $this->admin_auth->require_admin('approve_ads', true);
        $dataId = (int)$this->input->get('k_ey');
        if (empty($dataId)) {
            die(ErrorMsg('Select ad to enable.'));
        }
        $adminId = $this->admin_auth->get_admin_id() ?: $this->userID;
        $res = $this->Ads_model->approve_ad($dataId, $adminId, 'Approved and enabled via quick action.');
        echo $res['success'] ? 'Success' : ErrorMsg($res['message']);
    }

    /**
     * Disable ads (change status to pending)
     */
    public function disable_ads() {
        $this->admin_auth->require_admin('approve_ads', true);
        $dataId = (int)$this->input->get('k_ey');
        if (empty($dataId)) {
            die(ErrorMsg('Select ad to disable.'));
        }
        $adminId = $this->admin_auth->get_admin_id() ?: $this->userID;
        $check = $this->Ads_model->disable_ads($dataId, $adminId);
        echo $check;
    }

    /**
     * Close ads
     */
    public function close_ads() {
        $this->admin_auth->require_admin('approve_ads', true);
        $dataId = (int)$this->input->get('k_ey');
        if (empty($dataId)) {
            die(ErrorMsg('Select ad to close.'));
        }
        $adminId = $this->admin_auth->get_admin_id() ?: $this->userID;
        $check = $this->Ads_model->close_ads($dataId, $adminId);
        echo $check;
    }

    /**
     * Promo ads list and management
     */
    public function promo() {
        $data['title'] = 'Promo Ads - 24ads';
        $data['page_header'] = 'Promotional Banners';
        $data['page_title'] = 'Promo Ads';
        $data['promos'] = $this->Ads_model->load_promos();
        $this->setView('promo', $data);
    }

    public function add_promo() {
        $data['title'] = 'Add/Update Promo - 24ads';
        $user_data = $this->input->get();
        $promo = "";
        $info = array();
        if (isset($user_data['promo']) && $user_data['promo']) {
            $promo = $user_data['promo'];
            $info = $this->Ads_model->load_promo_info($promo);
        }
        $data['promo'] = $promo;
        $data['info'] = $info;
        $this->setView('add_promo', $data);
    }

    public function save_promo() {
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('view_location', 'view location', 'trim|required');
        $this->form_validation->set_rules('expire_date', 'expire date', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empty.');

        if ($this->form_validation->run() === FALSE) {
            if (form_error('title') != "") {
                die(form_error('title'));
            } elseif (form_error('view_location') != "") {
                die(form_error('view_location'));
            } elseif (form_error('expire_date') != "") {
                die(form_error('expire_date'));
            }
        } else {
            $user_data = $this->input->post();
            $adminId = $this->admin_auth->get_admin_id() ?: $this->userID;
            $check = $this->Ads_model->save_promo($user_data, $adminId);
            echo $check;
        }
    }

    public function update_promo() {
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('view_location', 'view location', 'trim|required');
        $this->form_validation->set_rules('expire_date', 'expire date', 'trim|required');
        $this->form_validation->set_rules('promo', 'promo', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empty.');

        if ($this->form_validation->run() === FALSE) {
            if (form_error('title') != "") {
                die(form_error('title'));
            } elseif (form_error('view_location') != "") {
                die(form_error('view_location'));
            } elseif (form_error('expire_date') != "") {
                die(form_error('expire_date'));
            } elseif (form_error('promo') != "") {
                die(form_error('promo'));
            }
        } else {
            $user_data = $this->input->post();
            $adminId = $this->admin_auth->get_admin_id() ?: $this->userID;
            $check = $this->Ads_model->update_promo($user_data, $adminId);
            echo $check;
        }
    }

    public function is_login() {
        $this->admin_auth->require_admin(null, true);
        return true;
    }

    public function is_logged_in() {
        $this->admin_auth->require_admin();
    }
}
