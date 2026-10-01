<?php defined('BASEPATH') || exit('No direct script access allowed');

class Business extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->is_logged_in();
        $this->load->model('business/Business_model');
        $this->account_type=$this->session->userdata('account_type');
        $this->is_new_user=$this->session->userdata('is_new_user');
        if($this->is_new_user){ redirect('users/business_profile');}
        if($this->account_type!='business'){ redirect('home');}
        $this->userToken=$this->session->userdata('24ads_user_idetification');
    }

    public function index($page="index"){
        if(!file_exists(APPPATH.'views/business/'.$page.'.php')){
            show_404();
        }

        if($page=='index'){
            $data['title'] = 'Business Dashboard - 24ads';
            $userID = getUserID($this->userToken);
            $business = $this->Business_model->get_business_info($userID);
            $businessID = isset($business['id']) ? $business['id'] : 0;

            $data['business'] = $business;
            $data['stats'] = $this->Business_model->get_ads_stats($businessID);
            $data['recent_ads'] = $this->Business_model->load_ads($businessID, 8);
            $data['recent_clicks'] = $this->Business_model->load_ads_clicks($businessID, 10);
        }else{
            $data['title'] = ucwords(str_replace("_", " ", $page)).' - 24ads';
        }
        
        $this->setView($page, $data);
    }

    public function setView($page='index', $data=array()){
        if(!is_array($data)){ $data = array(); }
        $data['page'] = 'business_'.$page;
        $data['active_menu'] = $page;
        $this->load->view('includes/header.php', $data);
        $this->load->view('includes/business_header.php', $data);
        $this->load->view('business/'.$page, $data);
        $this->load->view('includes/business_footer.php', $data);
        $this->load->view('includes/footer.php', $data);
    }

    public function ads(){
        $data['title'] = 'Ad Campaigns - 24ads';
        $userID = getUserID($this->userToken);
        $business = $this->Business_model->get_business_info($userID);
        $businessID = isset($business['id']) ? $business['id'] : 0;

        $status = $this->input->get('status');
        $data['business'] = $business;
        $data['stats'] = $this->Business_model->get_ads_stats($businessID);
        $data['ads'] = $this->Business_model->load_ads($businessID, 0, $status);
        $data['current_filter'] = $status;
        $this->setView('ads', $data);
    }

    public function new_ads(){
        $data['title'] = 'Create New Ad - 24ads';
        $userID = getUserID($this->userToken);
        $business = $this->Business_model->get_business_info($userID);
        $businessID = isset($business['id']) ? $business['id'] : 0;
        $data['business'] = $business;
        $data['stats'] = $this->Business_model->get_ads_stats($businessID);
        $this->setView('new_ads', $data);
    }

    public function save_ad(){
        $userID = getUserID($this->userToken);
        $business = $this->Business_model->get_business_info($userID);
        $businessID = isset($business['id']) ? $business['id'] : 0;
        if(empty($businessID)){
            echo ErrorMsg('Business profile not found. Please complete your profile first.');
            return;
        }

        $postData = $this->input->post();
        $result = $this->Business_model->save_ad($postData, $userID, $businessID);
        echo $result;
    }

    public function edit_ad(){
        $adID = (int)$this->input->get('ad');
        $userID = getUserID($this->userToken);
        $business = $this->Business_model->get_business_info($userID);
        $businessID = isset($business['id']) ? $business['id'] : 0;

        if(empty($adID) || empty($businessID)){
            redirect('business/ads');
            return;
        }

        $ad = $this->Business_model->load_ad_details($adID, $businessID);
        if(empty($ad)){
            redirect('business/ads');
            return;
        }

        $data['title'] = 'Edit & Resubmit Ad - 24ads';
        $data['business'] = $business;
        $data['ad'] = $ad;
        $data['questions'] = $this->Business_model->load_ad_questions($adID);
        $data['history'] = $this->Business_model->load_ad_history($adID);
        $this->setView('edit_ad', $data);
    }

    public function update_ad(){
        $userID = getUserID($this->userToken);
        $business = $this->Business_model->get_business_info($userID);
        $businessID = isset($business['id']) ? $business['id'] : 0;
        if(empty($businessID)){
            echo ErrorMsg('Business profile not found. Please complete your profile first.');
            return;
        }

        $postData = $this->input->post();
        $result = $this->Business_model->update_ad($postData, $userID, $businessID);
        echo $result;
    }

    public function transactions(){
        $data['title'] = 'Transactions & Financials - 24ads';
        $userID = getUserID($this->userToken);
        $business = $this->Business_model->get_business_info($userID);
        $businessID = isset($business['id']) ? $business['id'] : 0;

        $type = $this->input->get('type');
        $data['business'] = $business;
        $data['summary'] = $this->Business_model->get_business_transaction_summary($businessID, $userID);
        $data['records'] = $this->Business_model->load_business_transactions($businessID, $userID, 0, $type);
        $data['current_type'] = $type;
        $this->setView('transactions', $data);
    }

    public function transaction_info(){
        $data['title'] = 'Transaction Details - 24ads';
        $userID = getUserID($this->userToken);
        $business = $this->Business_model->get_business_info($userID);
        $businessID = isset($business['id']) ? $business['id'] : 0;

        $txID = $this->input->get('tx');
        if(empty($txID)){
            redirect('business/transactions');
        }

        $data['business'] = $business;
        $data['info'] = $this->Business_model->load_business_transaction_details($txID, $businessID, $userID);
        $this->setView('transaction_info', $data);
    }

    public function support_tickets(){
        $data['title'] = 'Support Tickets - 24ads';
        $this->setView('support_tickets', $data);
    }

    public function ticket(){
        $data['title'] = 'Support Tickets - 24ads';
        $this->setView('ticket', $data);
    }

    public function new_ticket(){
        $data['title'] = 'New Support Tickets - 24ads';
        $this->setView('new_ticket', $data);
    }

    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('24ads_user_idetification');
        if (!$is_logged_in) {
            redirect(base_url());
        }
    }
}
