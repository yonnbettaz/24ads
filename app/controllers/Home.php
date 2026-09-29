<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->account_role=$this->session->userdata('account_role');
        $this->is_first_login=$this->session->userdata('is_first_login');
        $this->userToken=$this->session->userdata('24ads_user_idetification');
    }

    public function index($page="index"){
        if(!file_exists(APPPATH.'views/site/'.$page.'.php')){
            show_404();
        }

        $data['page'] = $page;
        if($page=='index'){
            $data['title'] = '24ads - Earn Money Reading Ads | Tanzania Advertising Platform';
            $data['high_paid_ads']=$this->Home_model->load_high_paid_ads();
            $data['ads']=$this->Home_model->load_ads();
        }else{
            $data['title'] = ucwords(str_replace("_", " ", $page)).' - 24ads';
        }
        
        $this->setView($page, $data);
    }

    public function setView($page='index', $data=array()){
        if(!is_array($data)){ $data = array(); }
        if(!isset($data['page'])){ $data['page'] = $page; }
        $this->load->view('includes/header.php', $data);
        $this->load->view('site/'.$page, $data);
        $this->load->view('includes/footer.php', $data);
    }

    public function contact(){
        $data['title'] = 'Contact Us - 24ads';
        $this->setView('contact', $data);
    }

    public function about(){
        $data['title'] = 'About Us - 24ads';
        $this->setView('about', $data);
    }

    public function ads_content(){
        $user_data = $this->input->get();
        $ads_id = "";
        if(isset($user_data['ads']) && $user_data['ads'] != ""){
            $ads_id = $user_data['ads'];
            $this->session->set_userdata('current_read_ads', $ads_id);
        }
        $data['info'] = $this->Home_model->load_ads_content($ads_id);
        $data['related_ads'] = $this->Home_model->load_related_ads($ads_id, 4);
        $data['total_questions'] = $this->Home_model->get_total_questions($ads_id);

        $ad_title = (!empty($data['info']) && isset($data['info'][0]['title'])) ? $data['info'][0]['title'] : 'Ad Story';
        $data['title'] = $ad_title . ' - 24ads';

        $userID = getUserID($this->userToken);
        if(!empty($ads_id) && !empty($userID)){
            $update = $this->Home_model->update_clicked_ads($ads_id, $userID, "", "", "");
        }
        $this->setView('ads_content', $data);
    }

    public function ads_questions(){
        $data['title'] = 'Ads Question - 24ads';
        $user_data=$this->input->get();
        $ads_id=""; $questions=array(); $user_question_time=0;
        if(isset($user_data['ads']) && $user_data['ads']!=""){
            $ads_id=$user_data['ads'];
            $this->session->set_userdata('current_read_ads', $ads_id);
        }
        $userID=getUserID($this->userToken);
        if($userID!=""){
            $user_question_time=$this->Home_model->get_user_ads_current_time($ads_id, $userID);
            $questions=$this->Home_model->load_ads_questions($ads_id, $userID, "", "");
        }
        $question_time=$this->Home_model->get_ads_question_time($ads_id);
        $data['question_time']=$question_time;
        $data['user_question_time']=$user_question_time;
        $data['bonuses']=$this->Home_model->get_total_bonuses($ads_id);
        $data['total_questions']=$this->Home_model->get_total_questions($ads_id);
        $data['questions']=$questions;
        $data['ads']=$ads_id;
        $this->setView('ads_questions', $data);
    }

    public function ads_answers(){
        $data['title'] = 'Ads Question - 24ads';
        $user_data=$this->input->get();
        $ads_id=""; $answers=array(); $user_question_time=0;
        if(isset($user_data['ads']) && $user_data['ads']!=""){
            $ads_id=$user_data['ads'];
        }
        $userID=getUserID($this->userToken);
        if($userID!=""){
            $answers=$this->Home_model->load_ads__user_answers($ads_id, $userID);
        }
        $total_price=$this->Home_model->get_ads_question_price($ads_id);
        $data['total_qn_cost']=$total_price['cost'];
        $data['total_bonus_cost']=$total_price['bonus'];
        $data['bonuses']=$this->Home_model->get_total_bonuses($ads_id);
        $data['total_questions']=$this->Home_model->get_total_questions($ads_id);
        $data['info']=$this->Home_model->load_ads_content($ads_id);
        $data['answers']=$answers;
        $this->setView('ads_answers', $data);
    }

    public function get_user_ads_time(){
        $user_data=$this->input->get();
        $ads_id="";
        if(isset($user_data['ads']) && $user_data['ads']!=""){
            $ads_id=$user_data['ads'];
        }
        $userID=getUserID($this->userToken);
        $time=$this->Home_model->get_user_ads_current_time($ads_id, $userID);
        echo $time;
    }

    public function search_results(){
        $data['title'] = 'Search Results - 24ads';
        $user_data=$this->input->get();
        $keyword="";
        $results=array();
        if(isset($user_data['keyword']) && $user_data['keyword']!=""){
            $keyword=$user_data['keyword'];
            $results=$this->Home_model->load_search_result($keyword);
        }
        $data['keyword']=$keyword;
        $data['results']=$results;
        $this->setView('search_results', $data);
    }

    public function submit_ads_answers(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('ads', 'ads token', 'trim|required');
        $this->form_validation->set_message('required', 'Please Fill %s.');

        if ($this->form_validation->run() === FALSE){
            if(form_error('ads')!=""){
                die(form_error('ads'));
            }
        }else{
            $user_data = $this->input->post();
            $userID = getUserID($this->userToken);
            if(empty($userID)){
                die(ErrorMsg('Tafadhali ingia kwenye akaunti yako kuwasilisha majibu.'));
            }
            $check = $this->Home_model->submit_ads_answers($user_data, $userID);
            echo $check;
        }
    }

    public function send_contact_message(){
        $this->form_validation->set_error_delimiters(errMsg(), '</div>');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone number', 'trim|required');
        $this->form_validation->set_rules('message', 'message', 'trim|required');
        $this->form_validation->set_message('required', 'Please Fill %s.');
        $data = array();

        if ($this->form_validation->run() === FALSE){
            if(form_error('name')!=""){
                die(form_error('name'));
            }elseif(form_error('phone')!=""){
                die(form_error('phone'));
            }elseif(form_error('message')!=""){
                die(form_error('message'));
            }
        }else{
            $user_data = $this->input->post();
            $check=$this->Home_model->send_contact_message($user_data);
            echo $check;
        }
    }

    public function logout(){
        /*foreach ($_SESSION as $key => $val) {
            if($key!=='redirect_back'){
                unset($_SESSION[$key]);
            }
        }*/
        unset($_SESSION['24ads_user_idetification']);
        $this->session->sess_destroy();
        redirect($this->session->userdata('redirect_back'));
    }

    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('user_is_login');
        if ($is_logged_in != TRUE) {
            redirect('home');
        }
    }
}
