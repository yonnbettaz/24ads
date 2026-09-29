<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Users_model extends CI_Model{

	    public function __construct(){
	        parent::__construct();
	        $this->load->database();
        	$this->userToken=$this->session->userdata('24ads_ad_user_idetification');
    	}

		public function load_user_roles(){
			$result=array();
			$this->db->select('id, role_name, permissions, status');
		   	$this->db->where('status!=', '1');
	   		$query = $this->db->get('tbl_roles');
	   		if($query->num_rows()>0)  	
		   		$result=$query->result();
		   	return $result;
		}

		public function load_user_role_info($role_id){
			$result=array();
			$this->db->select('id, role_name, permissions, status');
		   	$this->db->where('id', $role_id);
		   	$this->db->where('status!=', '1');
	   		$query = $this->db->get('tbl_roles');
	   		if($query->num_rows()>0)  	
		   		$result=$query->row_array();
		   	return $result;
		}

		public function load_system_users(){
			$result=array();
			$this->db->select('tbl_admin.id, name, gender, phone, email, tbl_admin.status, role_name');
		   	$this->db->from('tbl_admin');
		   	$this->db->join('tbl_admin_info', 'tbl_admin_info.admin_id=tbl_admin.id AND tbl_admin_info.status="0"');
		   	$this->db->join('tbl_roles', 'tbl_roles.id=tbl_admin.role AND tbl_roles.status="0"');
		   	$this->db->where('tbl_admin.status!=', '1');
	   		$query = $this->db->get();
	   		if($query->num_rows()>0)  	
		   		$result=$query->result();
		   	return $result;
		}

		public function load_system_user_info($user_id){
			$result=array();
			$this->db->select('tbl_admin.id, name, gender, phone, email, role');
		   	$this->db->from('tbl_admin');
		   	$this->db->join('tbl_admin_info', 'tbl_admin_info.admin_id=tbl_admin.id AND tbl_admin_info.status="0"');
		   	$this->db->where('tbl_admin.id', $user_id);
		   	$this->db->where('tbl_admin.status!=', '1');
	   		$query = $this->db->get();
	   		if($query->num_rows()>0)  	
		   		$result=$query->row_array();
		   	return $result;
		}

    	public function save_system_user($data, $userID){
    		$createdDate=date("Y-m-d H:i:s");
    		$name=$data['name'];
    		$gender=$data['gender'];
    		$phone=$data['phone'];
    		$email=$data['email'];
    		$role=$data['role'];
    		$password=sha1(md5(md5($email)));
		    $this->db->select('id'); 
		    $this->db->where('username', $email); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_admin');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This admin already exist');
		   	}else{
		   		$this->db->select('id'); 
			    $this->db->where('email', $email); 
			   	$this->db->where('status', '0');
			   	$query = $this->db->get('tbl_admin_info');
			   	if($query->num_rows()>0){
			   		return ErrorMsg('Sorry! This admin info already exist');
			   	}else{
			   		$this->db->insert('tbl_admin', array(
			            'username' => $email,
			            'password' => $password,
			            'role' => $role,
			            'status' => '0',
			            'createdBy' => $userID,
			            'createdDate' => $createdDate
			        ));

			        if($this->db->affected_rows() > 0){
			        	$admin_id="";
			        	$this->db->select('id'); 
					    $this->db->where('username', $email); 
					   	$this->db->where('status', '0');
					   	$query1 = $this->db->get('tbl_admin');
					   	if($query1->num_rows()>0){
					   		foreach ($query1->result_array() as $rows) {
					   			$admin_id=$rows['id'];
					   		}
					   	}
					   	if($admin_id!=""){
					   		$this->db->insert('tbl_admin_info', array(
					            'admin_id' => $admin_id,
					            'name' => ucwords($name),
					            'gender' => $gender,
					            'phone' => $phone,
					            'email' => $email,
					            'status' => '0',
					            'createdBy' => $userID,
					            'createdDate' => $createdDate
					        ));

					        if($this->db->affected_rows() > 0){
					        	return 'Success';
					        }else{
					        	return $this->db->_error_message();
					        }
					   	}else{
					   		die(ErrorMsg('Failed! try again...'));
					   	}
		        	}else{
		        		return $this->db->_error_message();
		        	}
			 	}
		 	}
		}

    	public function update_system_user($data, $userID){
    		$createdDate=date("Y-m-d H:i:s");
    		$name=$data['name'];
    		$gender=$data['gender'];
    		$phone=$data['phone'];
    		$email=$data['email'];
    		$role=$data['role'];
    		$user_id=$data['user'];
    		$password=sha1(md5(md5($email)));
		    $this->db->select('id'); 
		    $this->db->where('username', $email); 
		    $this->db->where('id!=', $user_id);
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_admin');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This admin already exist');
		   	}else{
		   		$this->db->select('id'); 
			    $this->db->where('email', $email);
		    	$this->db->where('admin_id!=', $user_id);
			   	$this->db->where('status', '0');
			   	$query = $this->db->get('tbl_admin_info');
			   	if($query->num_rows()>0){
			   		return ErrorMsg('Sorry! This admin info already exist');
			   	}else{
			   		$set=array(
			            'username' => $email,
			            'password' => $password,
			            'role' => $role
			        );
					$this->db->where('id', $user_id);
					$this->db->where('status', '0');
			     	$this->db->update('tbl_admin', $set);

			   		$set1=array(
			            'name' => ucwords($name),
			            'gender' => $gender,
			            'phone' => $phone,
			            'email' => $email
			        );
					$this->db->where('admin_id', $user_id);
					$this->db->where('status', '0');
			     	$this->db->update('tbl_admin_info', $set1);

		        	return 'Success';
			 	}
		 	}
		}

    	public function save_user_roles($data, $userID){
    		$createdDate=date("Y-m-d H:i:s");
    		$role_name=$data['role_name'];
		    $this->db->select('id'); 
		    $this->db->where('role_name', $role_name); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_roles');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This role already exist');
		   	}else{
		   		$this->db->insert('tbl_roles', array(
		            'role_name' => $role_name,
		            'status' => '0',
		            'createdBy' => $userID,
		            'createdDate' => $createdDate
		        ));

		        if($this->db->affected_rows() > 0){
	        		return 'Success';
	        	}else{
	        		return $this->db->_error_message();
	        	}
		 	}
		}

    	public function update_user_role($data, $userID){
    		$createdDate=date("Y-m-d H:i:s");
    		$role_name=$data['role_name'];
    		$role_id=$data['role'];
		    $this->db->select('id'); 
		    $this->db->where('role_name', $role_name); 
		    $this->db->where('id!=', $role_id); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_roles');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This role already exist');
		   	}else{
		        $this->db->set('role_name', $role_name);
				$this->db->where('id', $role_id);
				$this->db->where('status', '0');
		     	$this->db->update('tbl_roles');
        		return 'Success';
		 	}
		}

    	public function login($username, $password){
		    $this->db->where('username', $username); 
		   	$this->db->where('password', $password);
		   	$query = $this->db->get('tbl_admin');
		   	if(!empty($query->row_array())){
		   		$token=generateToken();
				$this->db->set('token', $token);
				$this->db->where('username', $username);
				$this->db->where('password', $password);
				$this->db->where('status', '0');
		     	$this->db->update('tbl_admin');
	        	$full_name=""; $admin_id="";
	            foreach ($query->result_array() as $data) {
	                $admin_id=$data['id'];
	            }

            	$user_avatar="";
            	$this->db->where('admin_id', $admin_id);
            	$this->db->where('status', '0');
            	$query = $this->db->get('tbl_admin_info');
            	foreach ($query->result_array() as $data){
	                $full_name=$data['name'];
	                if($data['avatar']!=""){ $user_avatar=$data['avatar'];}else{ $user_avatar="default.png";}
	            }
			   		     	
	        	$this->session->set_userdata('24ads_ad_user_idetification', $token);
				$this->session->set_userdata('user_full_name', $full_name);
				$this->session->set_userdata('user_avatar', $user_avatar);
	        	return 'Success';
		   	}else{
		   		return ErrorMsg('Incorrect username or password');
		 	}
		}

		public function change_password($userID, $cpassword, $password){
			$this->db->where('id', $userID); 
		   	$this->db->where('password', $cpassword);
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_admin');
		   	if(!empty($query->row_array())){
				$this->db->set('password', $password);
				$this->db->where('id', $userID);
				$this->db->where('password', $cpassword);
		     	$this->db->update('tbl_admin');
	        	echo 'Success';
		    }else{
		   		echo ErrorMsg("Incorrect Current Password");
		 	}
		}

		public function account_info($userID){
			$this->db->where('admin_id', $userID);
		   	$this->db->where('status', '0');
	   		$query = $this->db->get('tbl_admin_info');   	
		   	return $query->row_array();
		}

    	public function update_profile($data, $userID){
    		$avFile="";
    		unset($_SESSION['uploaded_file']);
    		if(isset($_FILES['avatar']) && $_FILES['avatar']['name']!=""){
    			$avatar=do_upload('media/admin_avatar', 'avatar', str_replace(" ", "_", $data['name']), '', '', '', 'image');
    			if($avatar!='ok'){ 
    				die(ErrorMsg($avata));
    			}
    		}
			if(!empty($this->session->userdata('uploaded_file')) && $this->session->userdata('uploaded_file')!=""){
				$avFile=$this->session->userdata('uploaded_file');
				$this->session->set_userdata('user_avatar', $avFile);
			}
			$values=array(
	            'name' => $data['name'],
	            'gender' => $data['gender'],
	            'email' => $data['email'],
	            'phone' => $data['phone'],
	            'avatar' => $avFile
	        );
			$this->db->where('admin_id', $userID);
			$this->db->where('status', '0');
	     	$update=$this->db->update('tbl_admin_info', $values);
	     	if($update){
        		$this->session->set_userdata('user_full_name', $data['name']);
	     		return 'Success';
	     	}else{
	        	return $this->db->_error_message();
	        }
		}

    }
?>