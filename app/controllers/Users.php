<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Users_model');
        $this->userToken=$this->session->userdata('24ads_user_idetification');
    }

    public function index($index=""){
        redirect(base_url());
    }

	public function view(){
		$this->setView('index');
	}

	public function setView($page='index', $data=""){
        $this->load->view('includes/header.php', $data);
        $this->load->view('site/'.$page);
        $this->load->view('includes/footer.php');
    }

	public function business_register(){
    	$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('business_name', 'Business Name', 'trim|required');
		$this->form_validation->set_rules('business_phone', 'Business Phone', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('repassword', 'Repeat password', 'trim|required|matches[password]');
		$this->form_validation->set_message('is_unique', 'The %s is already registered.');
		$this->form_validation->set_message('matches', 'The %s does not match.');
   		$data = array();
   		$data['title']="Business Registration - 24ads";

   		if($this->form_validation->run() === FALSE){
	        $this->setView('register_business', $data);
	    }else{
	    	$user_data = $this->input->post();
	    	$nm=explode(" ", $user_data['name']);
	    	if(sizeof($nm)<2){
	    		$this->session->set_flashdata('feedback', errorMsg('Please! enter your full name'));
	        	$this->setView('register_business', $data);
	    	}else{
	    		$check=$this->Users_model->register_business($user_data);
		        if($check=='true'){
		        	$this->session->set_flashdata('feedback', successMsg('You have successfully created an account.'));
	        		redirect(base_url('users/business_profile'));
		        }else{
		        	$this->session->set_flashdata('feedback', errorMsg('Failed, '.$check));
		        	$this->setView('register_business', $data);
		        }
	    	}

	    }
	}

	public function register(){
    	$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone number', 'trim|required');
		$this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('repassword', 'Repeat password', 'trim|required|matches[password]');
		$this->form_validation->set_message('is_unique', 'The %s is already registered.');
		$this->form_validation->set_message('matches', 'The %s does not match.');
   		$data = array();
   		$data['title']="Personal Registration - 24ads";

   		if($this->form_validation->run() === FALSE){
	        $this->setView('register', $data);
	    }else{
	    	$user_data = $this->input->post();
	    	$nm=explode(" ", $user_data['name']);
	    	if(sizeof($nm)<2){
	    		$this->session->set_flashdata('feedback', errorMsg('Please! enter your full name'));
	        	$this->setView('register', $data);
	    	}else{
	    		$check=$this->Users_model->register($user_data);
		        if($check=='true'){
		        	$this->session->set_flashdata('feedback', successMsg('You have successfully created an account.'));
	        		redirect_back();
		        }else{
		        	$this->session->set_flashdata('feedback', errorMsg('Failed, '.$check));
		        	$this->setView('register', $data);
		        }
	    	}

	    }
	}

	public function recover_password(){
    	$this->form_validation->set_error_delimiters(errMsg(), '</div>');
    	$this->form_validation->set_rules('username', 'Username', 'trim|required');
   		$this->form_validation->set_message('required', 'Please Fill %s.');
   		$data = array();

   		if ($this->form_validation->run() === FALSE){
	        $this->setView('password_recover', $data);
	    }else{
	    	$data = $this->input->post();
	    	$username=$data['username'];
	    	$new_password=getRandomMixedCode(4).''.getRandomMixedCode(4).''.getRandomMixedCode(4);
	    	$encryted_password=sha1(md5(md5($new_password)));

	        $check=$this->Users_model->recover_password($username, $new_password, $encryted_password);
	        if($check=='incorrect'){
	        	$this->session->set_flashdata('feedback', errorMsg('Incorrect Username'));
	        	$this->setView('password_recover');
	        }else{
	        	$this->session->set_flashdata('feedback', successMsg('New password sent to your email address, check your spam folder if it is not in your inbox'));
	        	$this->setView('password_recover');
	        }
	    }
	}

	public function user_login(){
    	$this->form_validation->set_error_delimiters(errMsg(), '</div>');
    	$this->form_validation->set_rules('username', 'Username', 'trim|required');
   		$this->form_validation->set_rules('password', 'Password', 'trim|required');
   		$this->form_validation->set_message('required', 'Please Fill %s.');
   		$data = array();

   		if ($this->form_validation->run() === FALSE){
	        if(form_error('username')!=""){
	        	die(form_error('username'));
	        }elseif(form_error('password')!=""){
	        	die(form_error('password'));
	        }
	    }else{
	    	$data = $this->input->post();
			
			$username=$data['username'];
			$password=sha1(md5(md5($data['password'])));

	        $check=$this->Users_model->login($username, $password);
	        if($check=='incorrect'){
	        	die(ErrorMsg('Incorrect Username Or Password'));
	        }else if($check=='not active'){
	        	die(ErrorMsg('Sorry! your account is not activated yet, please wait or contact us to fastern the activation.'));
	        }else if($check=='blocked'){
	        	die(ErrorMsg('Your account is blocked, please contact us.'));
	        }else if($check=='deleted'){
	        	die(ErrorMsg('Your account is deleted, please contact us or create new account.'));
	        }else{
	        	if($check!=""){
	        		echo 'Success';
	        	}else{
	        		echo 'redirect_back';
	        	}
	        	
	        }
	    }
	}

	public function change_password(){
		if($this->userToken=="" || $this->userToken==null || empty($this->userToken)){
			die(ErrorMsg('Session expired refresh the page...'));
		}
        $this->load->helper('form');
    	$this->load->library('form_validation');

    	$this->form_validation->set_error_delimiters(errMsg(), '</div>');
    	$this->form_validation->set_rules('cpassword', 'Current Password', 'trim|required');
   		$this->form_validation->set_rules('repassword', 'Re-Enter Password', 'trim|required');
   		$this->form_validation->set_rules('password', 'New Password', 'trim|required');
   		$data = array();

   		if ($this->form_validation->run() === FALSE){
	        // die(validation_errors());
	        if(form_error('cpassword')!=""){
	        	die(form_error('cpassword'));
	        }elseif(form_error('password')!=""){
	        	die(form_error('password'));
	        }elseif(form_error('repassword')!=""){
	        	die(form_error('repassword'));
	        }
	    }else{
	    	$data = $this->input->post();			
			$cpassword=$data['cpassword'];
			$repassword=$data['repassword'];
			$password=$data['password'];
			$pass=sha1(md5(md5($password)));
			$cpass=sha1(md5(md5($cpassword)));

			if($password!=$repassword){
				die(errorMsg("Sorry! Your New Password Does Not Match"));
			}
			$userID=getUserID($this->userToken);
	        $check=$this->Users_model->change_password($userID, $cpass, $pass);
        	echo $check;
	    }
	}

    public function business_profile(){
    	$account_type=$this->session->userdata('account_type');
        if($account_type!='business'){ redirect('home');}
        $data['title'] = 'Business Profile - 24ads';
        $data['page'] = 'business_profile';
        $data['active_menu'] = 'business_profile';
		$userID=getUserID($this->userToken);
        $data['info']=$this->Users_model->account_info($userID, 'business');
        $this->load->view('includes/header.php', $data);
        $this->load->view('includes/business_header.php', $data);
        $this->load->view('business/profile', $data);
        $this->load->view('includes/business_footer.php', $data);
        $this->load->view('includes/footer.php', $data);
    }

    public function profile(){
    	$account_type=$this->session->userdata('account_type');
        if($account_type!='personal'){ redirect('home');}
        $data['title'] = 'Personal Profile - 24ads';
        $data['page'] = 'personal_profile';
        $data['active_menu'] = 'profile';
		$userID=getUserID($this->userToken);
        $data['info']=$this->Users_model->account_info($userID, 'personal');
        $this->load->view('includes/header.php', $data);
        $this->load->view('includes/personal_header.php', $data);
        $this->load->view('personal/profile', $data);
        $this->load->view('includes/personal_footer.php', $data);
        $this->load->view('includes/footer.php', $data);
    }

	public function update_business_profile(){
		$this->is_logged_in();
		$account_type=$this->session->userdata('account_type');
        if($account_type!='business'){ redirect('home');}
    	$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('business_name', 'Business Name', 'trim|required');
		$this->form_validation->set_rules('business_phone', 'Business Phone', 'trim|required');
		$this->form_validation->set_rules('business_email', 'Business Email', 'trim|required|valid_email');
   		$data = array();
		$account_type=$this->session->userdata('account_type');
		$userID=getUserID($this->userToken);
   		$data['title'] = 'Business Profile - 24ads';
        $data['page'] = 'business_profile';
        $data['active_menu'] = 'business_profile';

   		if ($this->form_validation->run() === FALSE){
			$data['info']=$this->Users_model->account_info($userID, 'business');
	        $this->load->view('includes/header.php', $data);
	        $this->load->view('includes/business_header.php', $data);
	        $this->load->view('business/profile', $data);
	        $this->load->view('includes/business_footer.php', $data);
	        $this->load->view('includes/footer.php', $data);
	    }else{
	    	$user_data = $this->input->post();
	        $check=$this->Users_model->update_business_profile($user_data, $userID);
	        if($check=='Success'){
	        	$this->session->set_flashdata('feedback', successMsg('You have successfully updated business info.'));
	        }else{
	        	$this->session->set_flashdata('feedback', errorMsg('Failed '.$check));
	        }
	        $data['info']=$this->Users_model->account_info($userID, 'business');
	        $this->load->view('includes/header.php', $data);
	        $this->load->view('includes/business_header.php', $data);
	        $this->load->view('business/profile', $data);
	        $this->load->view('includes/business_footer.php', $data);
	        $this->load->view('includes/footer.php', $data);
	    }
	}

	public function update_profile(){
		$this->is_logged_in();
		$account_type=$this->session->userdata('account_type');
        if($account_type!='personal'){ redirect('home');}
    	$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
   		$data = array();
		$account_type=$this->session->userdata('account_type');
		$userID=getUserID($this->userToken);
   		$data['title'] = 'Personal Profile - 24ads';

   		if ($this->form_validation->run() === FALSE){
			$data['info']=$this->Users_model->account_info($userID, 'personal');
	        $this->load->view('includes/header.php', $data);
	        $this->load->view('includes/personal_header.php');
	        $this->load->view('personal/profile');
	        $this->load->view('includes/personal_footer.php');
	        $this->load->view('includes/footer.php');
	    }else{
	    	$user_data = $this->input->post();
	        $check=$this->Users_model->update_profile($user_data, $userID);
	        if($check=='Success'){
	        	$this->session->set_flashdata('feedback', successMsg('You have successfully updated personal info.'));
	        }else{
	        	$this->session->set_flashdata('feedback', errorMsg('Failed '.$check));
	        }
	        $data['info']=$this->Users_model->account_info($userID, 'personal');
	        $this->load->view('includes/header.php', $data);
	        $this->load->view('includes/personal_header.php');
	        $this->load->view('personal/profile');
	        $this->load->view('includes/personal_footer.php');
	        $this->load->view('includes/footer.php');
	    }
	}

	public function logout(){
		foreach ($_SESSION as $key => $val) {
			if($key!=='redirect_back'){
				unset($_SESSION[$key]);
			}
		}
        // unset($_SESSION['getvalue_user_idetification']);
        // $this->session->sess_destroy();
        redirect($this->session->userdata('redirect_back'));
    }

    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('24ads_user_idetification');
        if ($is_logged_in != TRUE) {
            redirect(base_url());
        }
    }
}
