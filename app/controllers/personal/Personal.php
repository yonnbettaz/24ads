<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('personal/Personal_model');
        $this->account_type=$this->session->userdata('account_type');
        if($this->account_type!='personal'){ redirect('home');}
        $this->userToken=$this->session->userdata('24ads_user_idetification');
    }

    public function index($page="index"){
        if(!file_exists(APPPATH.'views/personal/'.$page.'.php')){
            show_404();
        }

        if($page=='index'){
            $data['title'] = 'User Account - 24ads';
            $userID=getUserID($this->userToken);
            $data['clicked_ads']=$this->Personal_model->get_clicked_ads($userID);
            $data['stats']=$this->Personal_model->get_answers_stats($userID);
            $data['results']=$this->Personal_model->load_ads_history($userID, 10);
        }else{
            $data['title'] = ucwords(str_replace("_", " ", $page)).' - 24ads';
        }
        
        $this->setView($page, $data);
    }

    public function setView($page='index', $data=array()){
        if(!is_array($data)){ $data = array(); }
        $data['page'] = 'personal_'.$page;
        $data['active_menu'] = $page;
        $this->load->view('includes/header.php', $data);
        $this->load->view('includes/personal_header.php', $data);
        $this->load->view('personal/'.$page, $data);
        $this->load->view('includes/personal_footer.php', $data);
        $this->load->view('includes/footer.php', $data);
    }

    public function recent_clicked(){
        $data['title'] = 'Recent Clicked - 24ads';
        $userID=getUserID($this->userToken);
        $data['clicked_ads']=$this->Personal_model->get_clicked_ads($userID);
        $data['stats']=$this->Personal_model->get_answers_stats($userID);
        $data['results']=$this->Personal_model->load_ads_history($userID, 50);
        $this->setView('recent_clicked', $data);
    }

    public function bonus(){
        $data['title'] = 'Bonuses - 24ads';
        $userID=getUserID($this->userToken);
        $data['bonuses']=$this->Personal_model->load_ads_bonus($userID);
        $this->setView('bonus', $data);
    }

    public function withdraw_balance(){
        $data['title'] = 'Withdraw & Balance - 24ads';
        $userID=getUserID($this->userToken);
        $user_data=$this->input->get();
        $requestID="";
        $info=array();
        if(isset($user_data['request']) && $user_data['request']!=""){
            $request=$user_data['request'];
            $info=$this->Personal_model->load_withdraw_info($userID, $request);
        }
        $data['info']=$info;
        $data['summary']=$this->Personal_model->get_transaction_summary($userID);
        $data['records']=$this->Personal_model->load_withdraw_records($userID);
        $this->setView('withdraw_balance', $data);
    }

    public function transaction_records(){
        $data['title'] = 'Transaction Records - 24ads';
        $userID=getUserID($this->userToken);
        $data['summary']=$this->Personal_model->get_transaction_summary($userID);
        $data['records']=$this->Personal_model->load_transaction_records($userID);
        $this->setView('transaction_records', $data);
    }

    public function ads_history(){
        $data['title'] = 'Ads History - 24ads';
        $userID=getUserID($this->userToken);
        $data['results']=$this->Personal_model->load_ads_history($userID, '');
        $this->setView('ads_history', $data);
    }

    public function profile(){
        $data['title'] = 'User Profile - 24ads';
        $userID = getUserID($this->userToken);
        $this->load->model('Users_model');
        $data['info'] = $this->Users_model->account_info($userID, 'personal');
        $this->setView('profile', $data);
    }

    public function account_info(){
        $data['title'] = 'Account Info - 24ads';
        $userID=getUserID($this->userToken);
        $data['info']=$this->Personal_model->load_account_info($userID);
        $this->setView('account_info', $data);
    }

    public function messages(){
        $data['title'] = 'Message Tickets - 24ads';
        $this->load->view('includes/header.php', $data);
        $this->load->view('personal/messages');
        $this->load->view('includes/footer.php');
    }

    public function save_withdraw_request(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('requestID', 'requestID', 'trim|required');
        $this->form_validation->set_rules('amount', 'amount', 'trim|required');
        $this->form_validation->set_message('required', 'Please Fill %s.');
        $data = array();

        if($this->form_validation->run() === FALSE){
            if(form_error('requestID')!=""){
                die(form_error('requestID'));
            }elseif(form_error('amount')!=""){
                die(form_error('amount'));
            }
        }else{
            $user_data = $this->input->post();

            $userID=getUserID($this->userToken);
            $check=$this->Personal_model->save_withdraw_request($user_data, $userID);
            echo $check;
        }
    }

    public function save_account_info(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('accountID', 'accountID', 'trim|required');
        $this->form_validation->set_rules('payment_method', 'payment method', 'trim|required');
        $this->form_validation->set_rules('operator', 'operator', 'trim|required');
        $this->form_validation->set_rules('country_code', 'country code', 'trim|required');
        $this->form_validation->set_rules('phone_number', 'phone number', 'trim|required');
        $this->form_validation->set_rules('account_name', 'account name', 'trim|required');
        $this->form_validation->set_rules('country', 'country', 'trim|required');
        $this->form_validation->set_rules('currency', 'currency', 'trim|required');
        $this->form_validation->set_message('required', 'Please Fill %s.');
        $data = array();

        if($this->form_validation->run() === FALSE){
            if(form_error('accountID')!=""){
                die(form_error('accountID'));
            }elseif(form_error('payment_method')!=""){
                die(form_error('payment_method'));
            }elseif(form_error('operator')!=""){
                die(form_error('operator'));
            }elseif(form_error('country_code')!=""){
                die(form_error('country_code'));
            }elseif(form_error('phone_number')!=""){
                die(form_error('phone_number'));
            }elseif(form_error('account_name')!=""){
                die(form_error('account_name'));
            }elseif(form_error('country')!=""){
                die(form_error('country'));
            }elseif(form_error('currency')!=""){
                die(form_error('currency'));
            }
        }else{
            $user_data = $this->input->post();
            if(isPhoneNumberValid($user_data['phone_number'])){
                die(ErrorMsg('Sorry! write your phone number in a right format. eg. 754000111'));
            }
            $userID=getUserID($this->userToken);
            $check=$this->Personal_model->save_account_info($user_data, $userID);
            echo $check;
        }
    }

    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('user_is_login');
        if ($is_logged_in != TRUE) {
            redirect('home');
        }
    }
}
