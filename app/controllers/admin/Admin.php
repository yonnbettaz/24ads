<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_model');
        $this->admin_auth->require_admin();
        $this->userToken = $this->session->userdata('24ads_ad_user_idetification');
        $this->userID = $this->admin_auth->get_admin_id() ? $this->admin_auth->get_admin_id() : getAdminUserID($this->userToken);
    }

    public function index($page="index"){
        if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
            show_404();
        }

        if($page=='index'){
            $data['title'] = 'Ads Administration Dashboard - 24ads';
            $data['page_header'] = 'ADS ADMINISTRATION';
            $data['page_title'] = 'Dashboard';
            $this->load->model('admin/Reports_model');
            $data['total_personal_accounts'] = $this->Reports_model->get_total_personal_accounts();
            $data['total_business_accounts'] = $this->Reports_model->get_total_business_accounts();
            $data['total_ads'] = $this->Reports_model->get_total_ads();
            $data['pending_ads'] = $this->Reports_model->get_total_pending_ads();
            $data['active_ads'] = $this->Reports_model->get_total_active_ads();
            $data['rejected_ads'] = $this->Reports_model->get_total_rejected_ads();
            $data['ads_created_today'] = $this->Reports_model->get_ads_created_today();
            $data['ads_approved_today'] = $this->Reports_model->get_ads_approved_today();
            $data['ads_rejected_today'] = $this->Reports_model->get_ads_rejected_today();
            $data['recent_pending'] = $this->Reports_model->load_recent_pending_ads(6);
            $data['recent_approvals'] = $this->Reports_model->load_recent_approvals(6);
            $data['recent_rejections'] = $this->Reports_model->load_recent_rejections(6);
            $data['latest_ads'] = $this->Reports_model->load_latest_ads();
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

    public function personal_accounts(){
        $data['title'] = 'Personal Accounts - 24ads';
        $data['accounts']=$this->Admin_model->load_personal_accounts();
        $this->setView('personal_accounts', $data);
    }

    public function business_accounts(){
        $data['title'] = 'Business Accounts - 24ads';
        $data['accounts']=$this->Admin_model->load_business_accounts();
        $this->setView('business_accounts', $data);
    }

    public function personal_records(){
        $data['title'] = 'Personal Records - 24ads';
        $data['records']=$this->Admin_model->load_personal_records();
        $this->setView('personal_records', $data);
    }

    public function transaction_history(){
        $data['title'] = 'Transaction History - 24ads';
        $data['balances']=$this->Admin_model->load_transaction_history();
        $this->setView('transaction_history', $data);
    }

    public function transaction_balance(){
        $data['title'] = 'Account Balance - 24ads';
        $data['balances']=$this->Admin_model->load_transaction_balance();
        $this->setView('transaction_balance', $data);
    }

    public function pending_transactions(){
        $data['title'] = 'Pending Transactions - 24ads';
        $data['balances']=$this->Admin_model->load_pending_transactions();
        $this->setView('pending_transactions', $data);
    }

    public function personal_withdraw(){
        $data['title'] = 'Personal Withdraw - 24ads';
        $data['records']=$this->Admin_model->load_personal_withdraw();
        $this->setView('personal_withdraw', $data);
    }

    public function business_records(){
        $data['title'] = 'Business Records - 24ads';
        $data['ads']=$this->Admin_model->load_business_records();
        $this->setView('business_records', $data);
    }

    public function budget_history(){
        $data['title'] = 'Budget History - 24ads';
        $data['ads']=$this->Admin_model->load_budget_history();
        $this->setView('budget_history', $data);
    }

    public function payment_providers(){
        $data['title'] = 'Payment Providers - 24ads';
        $data['page_header'] = 'Payment Providers';
        $data['page_title'] = 'Setting';
        $user_data=$this->input->get();
        $provider=""; $info=array();
        if(isset($user_data['provider']) && $user_data['provider']){
            $provider=$user_data['provider'];
            $info=$this->Admin_model->load_payment_provider_info($provider);
        }
        $data['provider']=$provider;
        $data['info']=$info;
        $data['providers']=$this->Admin_model->load_payment_providers();
        $this->setView('payment_providers', $data);
    }

    public function settings(){
        $data['title'] = 'System Settings - 24ads';
        $data['page_header'] = 'System Settings';
        $data['page_title'] = 'Setting';
        $user_data=$this->input->get();
        $setting=""; $info=array();
        if(isset($user_data['setting']) && $user_data['setting']){
            $setting=$user_data['setting'];
            $info=$this->Admin_model->load_system_setting_info($setting);
        }
        $data['setting']=$setting;
        $data['info']=$info;
        $data['settings']=$this->Admin_model->load_system_settings();
        $this->setView('settings', $data);
    }

    public function save_system_setting(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('setting_key', 'setting key', 'trim|required');
        $this->form_validation->set_rules('setting_value', 'setting value', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empy.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('setting_key')!=""){
                die(form_error('setting_key'));
            }elseif(form_error('setting_value')!=""){
                die(form_error('setting_value'));
            }
        }else{
            $user_data = $this->input->post();
            $userID=getUserID($this->userToken);
            $check=$this->Admin_model->save_system_setting($user_data, $userID);
            echo $check;
        }
    }

    public function update_system_setting(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('setting_key', 'setting key', 'trim|required');
        $this->form_validation->set_rules('setting_value', 'setting value', 'trim|required');
        $this->form_validation->set_rules('setting', 'setting token', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empy.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('setting_key')!=""){
                die(form_error('setting_key'));
            }elseif(form_error('setting_value')!=""){
                die(form_error('setting_value'));
            }elseif(form_error('setting')!=""){
                die(form_error('setting'));
            }
        }else{
            $user_data = $this->input->post();
            $userID=getUserID($this->userToken);
            $check=$this->Admin_model->update_system_setting($user_data, $userID);
            echo $check;
        }
    }

    public function save_payment_provider(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('method', 'method', 'trim|required');
        $this->form_validation->set_rules('provider', 'provider', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empy.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('method')!=""){
                die(form_error('method'));
            }elseif(form_error('provider')!=""){
                die(form_error('provider'));
            }
        }else{
            $user_data = $this->input->post();
            $userID=getUserID($this->userToken);
            $check=$this->Admin_model->save_payment_provider($user_data, $userID);
            echo $check;
        }
    }

    public function update_payment_provider(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('method', 'method', 'trim|required');
        $this->form_validation->set_rules('provider', 'provider', 'trim|required');
        $this->form_validation->set_rules('provider_id', 'provider id', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empy.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('method')!=""){
                die(form_error('method'));
            }elseif(form_error('provider')!=""){
                die(form_error('provider'));
            }elseif(form_error('provider_id')!=""){
                die(form_error('provider_id'));
            }
        }else{
            $user_data = $this->input->post();
            $userID=getUserID($this->userToken);
            $check=$this->Admin_model->update_payment_provider($user_data, $userID);
            echo $check;
        }
    }

    public function reject_withdraw(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('withdraw', 'withdraw', 'trim|required');
        $this->form_validation->set_rules('rejected_reason', 'rejected reason', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empy.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('withdraw')!=""){
                die(form_error('withdraw'));
            }elseif(form_error('rejected_reason')!=""){
                die(form_error('rejected_reason'));
            }
        }else{
            $user_data = $this->input->post();
            $userID=getUserID($this->userToken);
            $check=$this->Admin_model->reject_withdraw($user_data, $userID);
            echo $check;
        }
    }

    public function check_pending_ads(){
        $this->is_login();
        $check=$this->Admin_model->check_pending_ads();
        echo $check;
    }

    public function enable_withdraw(){
        $this->is_login();
        $user_data = $this->input->get();
        if(!isset($user_data['k_ey']) || $user_data['k_ey']==''){
            die(ErrorMsg('Select request to enable.'));
        }
        $dataID=$user_data['k_ey'];
        $check=$this->Admin_model->enable_withdraw($dataID, $this->userID);
        echo $check;
    }

    public function disburse_withdraw_request(){
        $this->is_login();
        $user_data = $this->input->get();
        if(!isset($user_data['k_ey']) || $user_data['k_ey']==''){
            die(ErrorMsg('Select request to disburse.'));
        }
        $dataID=$user_data['k_ey'];
        $check=$this->Admin_model->disburse_withdraw_request($dataID, $this->userID);
        echo $check;
    }

    /*Control starts here*/

    public function delete_data_row(){
        $this->is_login();
        $user_data = $this->input->get();
        if(!isset($user_data['k_ey']) || $user_data['k_ey']==''){
            die(ErrorMsg('Select row to delete.'));
        }
        if(!isset($user_data['record']) || $user_data['record']==''){
            die(ErrorMsg('Empty record... refresh the try again!'));
        }
        $dataID=$user_data['k_ey'];
        $table='tbl_'.$user_data['record'];
        $check=$this->Admin_model->delete_row($dataID, $table, $this->userID);
        echo $check;
    }

    public function activate_data_row(){
        $this->is_login();
        $user_data = $this->input->get();
        if(!isset($user_data['k_ey']) || $user_data['k_ey']==''){
            die(ErrorMsg('Select row to delete.'));
        }
        if(!isset($user_data['record']) || $user_data['record']==''){
            die(ErrorMsg('Empty record... refresh the try again!'));
        }
        $dataID=$user_data['k_ey'];
        $table='tbl_'.$user_data['record'];
        $check=$this->Admin_model->activate_row($dataID, $table, $this->userID);
        echo $check;
    }

    public function diactivate_data_row(){
        $this->is_login();
        $user_data = $this->input->get();
        if(!isset($user_data['k_ey']) || $user_data['k_ey']==''){
            die(ErrorMsg('Select row to delete.'));
        }
        if(!isset($user_data['record']) || $user_data['record']==''){
            die(ErrorMsg('Empty record... refresh the try again!'));
        }
        $dataID=$user_data['k_ey'];
        $table='tbl_'.$user_data['record'];
        $check=$this->Admin_model->diactivate_row($dataID, $table, $this->userID);
        echo $check;
    }
    /*end of control*/

    /*User logs*/
    public function login(){
        $data['title'] = 'Login - 24ads';
        $this->load->view('admin/login', $data);
    }

    public function logout(){
        $this->admin_auth->logout();
        redirect('admin/users/login');
    }

    public function is_login(){
        $this->admin_auth->require_admin(null, true);
        return true;
    }

    public function is_logged_in(){
        $this->admin_auth->require_admin();
    }
    /*end of user logs*/
}
