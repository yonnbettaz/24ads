<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('admin/Users_model');
        $this->userToken=$this->session->userdata('24ads_ad_user_idetification');
    }

    public function index($index=""){
        $data['title'] = 'Login - 24ads';
        $this->load->view('admin/login', $data);
    }

	public function view(){
		$this->setView('index');
	}

    public function setView($page='index', $data=""){
        $this->load->view('includes/admin_header.php', $data);
        $this->load->view('admin/'.$page);
        $this->load->view('includes/admin_footer.php');
    }

    public function add_user(){
    	$this->is_logged_in();
        $data['title'] = 'New User - 24ads';
        $user_data=$this->input->get();
        $user=""; $info=array();
        if(isset($user_data['user']) && $user_data['user']){
        	$user=$user_data['user'];
        	$info=$this->Users_model->load_system_user_info($user);
        }
        $data['user']=$user;
        $data['info']=$info;
	    $data['roles']=$this->Users_model->load_user_roles();
        $this->setView('add_user', $data);
    }

    public function system_users(){
    	$this->is_logged_in();
        $data['title'] = 'System Users - 24ads';
	    $data['users']=$this->Users_model->load_system_users();
        $this->setView('system_users', $data);
    }

    public function roles(){
    	$this->is_logged_in();
        $data['title'] = 'System Roles - 24ads';
        $data['page_header'] = 'System Roles';
        $user_data=$this->input->get();
        $role=""; $info=array();
        if(isset($user_data['role']) && $user_data['role']){
        	$role=$user_data['role'];
        	$info=$this->Users_model->load_user_role_info($role);
        }
        $data['role']=$role;
        $data['info']=$info;
	    $data['roles']=$this->Users_model->load_user_roles();
        $this->setView('roles', $data);
    }

	public function save_system_user(){
    	$this->form_validation->set_error_delimiters(errMsg(), '</div>');
    	$this->form_validation->set_rules('name', 'full name', 'trim|required');
    	$this->form_validation->set_rules('gender', 'gender', 'trim|required');
    	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
    	$this->form_validation->set_rules('email', 'email', 'trim|required');
    	$this->form_validation->set_rules('role', 'role', 'trim|required');
   		$this->form_validation->set_message('required', 'Please Fill %s.');
   		$data = array();

   		if ($this->form_validation->run() === FALSE){
	        if(form_error('name')!=""){
	        	die(form_error('name'));
	        }elseif(form_error('gender')!=""){
	        	die(form_error('gender'));
	        }elseif(form_error('phone')!=""){
	        	die(form_error('phone'));
	        }elseif(form_error('email')!=""){
	        	die(form_error('email'));
	        }elseif(form_error('role')!=""){
	        	die(form_error('role'));
	        }
	    }else{
	    	$user_data = $this->input->post();
        	$userID=getUserID($this->userToken);
	        $check=$this->Users_model->save_system_user($user_data, $userID);
	        echo $check;
	    }
	}

	public function update_system_user(){
    	$this->form_validation->set_error_delimiters(errMsg(), '</div>');
    	$this->form_validation->set_rules('name', 'full name', 'trim|required');
    	$this->form_validation->set_rules('gender', 'gender', 'trim|required');
    	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
    	$this->form_validation->set_rules('email', 'email', 'trim|required');
    	$this->form_validation->set_rules('role', 'role', 'trim|required');
    	$this->form_validation->set_rules('user', 'user token', 'trim|required');
   		$this->form_validation->set_message('required', 'Please Fill %s.');
   		$data = array();

   		if ($this->form_validation->run() === FALSE){
	        if(form_error('name')!=""){
	        	die(form_error('name'));
	        }elseif(form_error('gender')!=""){
	        	die(form_error('gender'));
	        }elseif(form_error('phone')!=""){
	        	die(form_error('phone'));
	        }elseif(form_error('email')!=""){
	        	die(form_error('email'));
	        }elseif(form_error('role')!=""){
	        	die(form_error('role'));
	        }elseif(form_error('user')!=""){
	        	die(form_error('user'));
	        }
	    }else{
	    	$user_data = $this->input->post();
        	$userID=getUserID($this->userToken);
	        $check=$this->Users_model->update_system_user($user_data, $userID);
	        echo $check;
	    }
	}

	public function save_user_roles(){
    	$this->form_validation->set_error_delimiters(errMsg(), '</div>');
    	$this->form_validation->set_rules('role_name', 'role name', 'trim|required');
   		$this->form_validation->set_message('required', 'Please Fill %s.');
   		$data = array();

   		if ($this->form_validation->run() === FALSE){
	        if(form_error('role_name')!=""){
	        	die(form_error('role_name'));
	        }
	    }else{
	    	$user_data = $this->input->post();
        	$userID=getUserID($this->userToken);
	        $check=$this->Users_model->save_user_roles($user_data, $userID);
	        echo $check;
	    }
	}

	public function update_user_role(){
    	$this->form_validation->set_error_delimiters(errMsg(), '</div>');
    	$this->form_validation->set_rules('role_name', 'role name', 'trim|required');
    	$this->form_validation->set_rules('role', 'role', 'trim|required');
   		$this->form_validation->set_message('required', 'Please Fill %s.');
   		$data = array();

   		if ($this->form_validation->run() === FALSE){
	        if(form_error('role_name')!=""){
	        	die(form_error('role_name'));
	        }elseif(form_error('role')!=""){
	        	die(form_error('role'));
	        }
	    }else{
	    	$user_data = $this->input->post();
        	$userID=getUserID($this->userToken);
	        $check=$this->Users_model->update_user_role($user_data, $userID);
	        echo $check;
	    }
	}

    /*user logs*/
	public function login(){
        $data['title'] = 'Login - 24ads';
        $this->load->view('admin/login', $data);
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
	        echo $check;
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
			$userID=getAdminUserID($this->userToken);
	        $check=$this->Users_model->change_password($userID, $cpass, $pass);
        	echo $check;
	    }
	}

    public function profile(){
        $data['title'] = 'Admin Profile - 24ads';
		$userID=getAdminUserID($this->userToken);
        $data['info']=$this->Users_model->account_info($userID);
        $this->load->view('includes/admin_header.php', $data);
        $this->load->view('admin/profile');
        $this->load->view('includes/admin_footer.php');
    }

    public function update_profile(){
		if($this->userToken=="" || $this->userToken==null || empty($this->userToken)){
			die(ErrorMsg('Session expired refresh the page...'));
		}

    	$this->form_validation->set_error_delimiters(errMsg(), '</div>');
    	$this->form_validation->set_rules('name', 'Name', 'trim|required');
   		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
   		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
   		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
   		$data = array();

   		if ($this->form_validation->run() === FALSE){
	        if(form_error('name')!=""){
	        	die(form_error('name'));
	        }elseif(form_error('gender')!=""){
	        	die(form_error('gender'));
	        }elseif(form_error('phone')!=""){
	        	die(form_error('phone'));
	        }elseif(form_error('email')!=""){
	        	die(form_error('email'));
	        }
	    }else{
	    	$user_data = $this->input->post();
			$userID=getAdminUserID($this->userToken);
	        $check=$this->Users_model->update_profile($user_data, $userID);
        	echo $check;
	    }
	}

	public function logout(){
        unset($_SESSION['24ads_ad_user_idetification']);
        $this->session->sess_destroy();
        redirect('admin/users/login');
    }

    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('24ads_ad_user_idetification');
        if ($is_logged_in != TRUE) {
            redirect('admin/users/login');
        }
    }
    /*end user logs*/
}
