<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('admin/Reports_model');
        $this->userToken=$this->session->userdata('24ads_ad_user_idetification');
        $this->is_logged_in();
        $this->userID=getUserID($this->userToken);
    }

    public function index($page="index"){
        if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
            show_404();
        }

        if($page=='index'){
            $data['title'] = 'Admin - 24ads';
            $data['page_header'] = 'Report';
            $data['page_title'] = 'Dashboard';
        }else{
            $data['title'] = ucwords(str_replace("_", " ", $page)).' - 24ads';
        }
        
        $this->setView($page, $data);
    }

    public function setView($page='index', $data=""){
        $this->load->view('includes/admin_header.php', $data);
        $this->load->view('admin/'.$page);
        $this->load->view('includes/admin_footer.php');
    }

    public function personal_account_report(){
        $this->is_logged_in();
        $data['title'] = 'Personal Account Report - 24ads';
        $user_data=$this->input->get();
        $startDate=date("Y-m-d 00:01"); $endDate=date("Y-m-d H:i:s");
        if(isset($user_data['startDate']) && $user_data['startDate']){
            $startDate=$user_data['startDate'];
            $data['startDate']=$startDate;
        }
        if(isset($user_data['endDate']) && $user_data['endDate']){
            $endDate=$user_data['endDate'];
            $data['endDate']=$endDate;
        }
        $data['accounts']=$this->Reports_model->load_personal_account_report($startDate, $endDate);
        $this->setView('personal_account_report', $data);
    }

    public function business_account_report(){
        $this->is_logged_in();
        $data['title'] = 'Business Account Report - 24ads';
        $user_data=$this->input->get();
        $startDate=date("Y-m-d 00:01"); $endDate=date("Y-m-d H:i:s");
        if(isset($user_data['startDate']) && $user_data['startDate']){
            $startDate=$user_data['startDate'];
            $data['startDate']=$startDate;
        }
        if(isset($user_data['endDate']) && $user_data['endDate']){
            $endDate=$user_data['endDate'];
            $data['endDate']=$endDate;
        }
        $data['accounts']=$this->Reports_model->load_business_account_report($startDate, $endDate);
        $this->setView('business_account_report', $data);
    }

    public function ads_report(){
        $this->is_logged_in();
        $data['title'] = 'Ads Report - 24ads';
        $user_data=$this->input->get();
        $startDate=date("Y-m-d 00:01"); $endDate=date("Y-m-d H:i:s");
        if(isset($user_data['startDate']) && $user_data['startDate']){
            $startDate=$user_data['startDate'];
            $data['startDate']=$startDate;
        }
        if(isset($user_data['endDate']) && $user_data['endDate']){
            $endDate=$user_data['endDate'];
            $data['endDate']=$endDate;
        }
        $data['reports']=$this->Reports_model->load_ads_report($startDate, $endDate);
        $this->setView('ads_report', $data);
    }

    public function cash_flow_report(){
        $this->is_logged_in();
        $data['title'] = 'Cash Flow Report - 24ads';
        $user_data=$this->input->get();
        $startDate=date("Y-m-d 00:01"); $endDate=date("Y-m-d H:i:s");
        if(isset($user_data['startDate']) && $user_data['startDate']){
            $startDate=$user_data['startDate'];
            $data['startDate']=$startDate;
        }
        if(isset($user_data['endDate']) && $user_data['endDate']){
            $endDate=$user_data['endDate'];
            $data['endDate']=$endDate;
        }
        $data['record']=$this->Reports_model->load_cash_flow_report($startDate, $endDate);
        $this->setView('cash_flow_report', $data);
    }

    /*User logs*/
    public function login(){
        $data['title'] = 'Login - 24ads';
        $this->load->view('admin/login', $data);
    }

    public function logout(){
        unset($_SESSION['24ads_ad_user_idetification']);
        $this->session->sess_destroy();
        redirect('admin/users/login');
    }

    public function is_login(){
        if(isset($_SESSION['24ads_ad_user_idetification']) && $this->session->userdata('24ads_ad_user_idetification')!=""){
            return true;
        }else{
            die("Session expired, please! refresh the page");
        }
    }

    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('24ads_ad_user_idetification');
        if ($is_logged_in != TRUE) {
            redirect('admin/users/login');
        }
    }
    /*end of user logs*/
}
