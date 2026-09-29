<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('admin/Ads_model');
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
            $data['page_header'] = 'System Roles';
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

    public function add_promo(){
        $this->is_logged_in();
        $data['title'] = 'Add/Update Promo - 24ads';
        $user_data=$this->input->get();
        $promo=""; $info=array();
        if(isset($user_data['promo']) && $user_data['promo']){
            $promo=$user_data['promo'];
            $info=$this->Ads_model->load_promo_info($promo);
        }
        $data['promo']=$promo;
        $data['info']=$info;
        $this->setView('add_promo', $data);
    }

    public function ads_details(){
        $this->is_logged_in();
        $data['title'] = 'Ads Details - 24ads';
        $user_data=$this->input->get();
        $ads=""; $info=array();
        if(isset($user_data['ads']) && $user_data['ads']){
            $ads=$user_data['ads'];
            $info=$this->Ads_model->load_ads_details($ads);
        }
        $data['ads']=$ads;
        $data['info']=$info;
        $this->setView('ads_details', $data);
    }

    public function pending_ads(){
        $data['title'] = 'Pending Ads - 24ads';
        $data['ads']=$this->Ads_model->load_pending_ads();
        $this->setView('pending_ads', $data);
    }

    public function active_ads(){
        $data['title'] = 'Active Ads - 24ads';
        $data['ads']=$this->Ads_model->load_active_ads();
        $this->setView('active_ads', $data);
    }

    public function denied_ads(){
        $data['title'] = 'Rejected Ads - 24ads';
        $data['ads']=$this->Ads_model->load_denied_ads();
        $this->setView('denied_ads', $data);
    }

    public function closed_ads(){
        $data['title'] = 'Closed Ads - 24ads';
        $data['ads']=$this->Ads_model->load_closed_ads();
        $this->setView('closed_ads', $data);
    }

    public function promo(){
        $data['title'] = 'Promo Ads - 24ads';
        $data['promos']=$this->Ads_model->load_promos();
        $this->setView('promo', $data);
    }

    public function reject_ads(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('ads', 'ads', 'trim|required');
        $this->form_validation->set_rules('rejected_reason', 'rejected reason', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empy.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('ads')!=""){
                die(form_error('ads'));
            }elseif(form_error('rejected_reason')!=""){
                die(form_error('rejected_reason'));
            }
        }else{
            $user_data = $this->input->post();
            $userID=getUserID($this->userToken);
            $check=$this->Ads_model->reject_ads($user_data, $userID);
            echo $check;
        }
    }

    public function save_promo(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('view_location', 'view location', 'trim|required');
        $this->form_validation->set_rules('expire_date', 'expire date', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empy.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('title')!=""){
                die(form_error('title'));
            }elseif(form_error('view_location')!=""){
                die(form_error('view_location'));
            }elseif(form_error('expire_date')!=""){
                die(form_error('expire_date'));
            }
        }else{
            $user_data = $this->input->post();
            $userID=getUserID($this->userToken);
            $check=$this->Ads_model->save_promo($user_data, $userID);
            echo $check;
        }
    }

    public function update_promo(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('view_location', 'view location', 'trim|required');
        $this->form_validation->set_rules('expire_date', 'expire date', 'trim|required');
        $this->form_validation->set_rules('promo', 'promo', 'trim|required');
        $this->form_validation->set_message('required', 'Sorry! %s is empy.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('title')!=""){
                die(form_error('title'));
            }elseif(form_error('view_location')!=""){
                die(form_error('view_location'));
            }elseif(form_error('expire_date')!=""){
                die(form_error('expire_date'));
            }elseif(form_error('promo')!=""){
                die(form_error('promo'));
            }
        }else{
            $user_data = $this->input->post();
            $userID=getUserID($this->userToken);
            $check=$this->Ads_model->update_promo($user_data, $userID);
            echo $check;
        }
    }

    /*Control starts here*/

    public function enable_ads(){
        $this->is_login();
        $user_data = $this->input->get();
        if(!isset($user_data['k_ey']) || $user_data['k_ey']==''){
            die(ErrorMsg('Select ad to enable.'));
        }
        $dataID=$user_data['k_ey'];
        $check=$this->Ads_model->enable_ads($dataID, $this->userID);
        echo $check;
    }

    public function disable_ads(){
        $this->is_login();
        $user_data = $this->input->get();
        if(!isset($user_data['k_ey']) || $user_data['k_ey']==''){
            die(ErrorMsg('Select ad to disable.'));
        }
        $dataID=$user_data['k_ey'];
        $check=$this->Ads_model->disable_ads($dataID, $this->userID);
        echo $check;
    }

    public function close_ads(){
        $this->is_login();
        $user_data = $this->input->get();
        if(!isset($user_data['k_ey']) || $user_data['k_ey']==''){
            die(ErrorMsg('Select ad to close.'));
        }
        $dataID=$user_data['k_ey'];
        $check=$this->Ads_model->close_ads($dataID, $this->userID);
        echo $check;
    }

    /*end of control*/

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
