<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Users_model extends CI_Model{

	    public function __construct(){
	        parent::__construct();
	        $this->load->database();
        	$this->userToken=$this->session->userdata('24ads_user_idetification');
    	}

    	public function register_business($data){
    		$createdDate=date("Y-m-d H:i:s");
			$password=sha1(md5(md5($data['password'])));
    		$token=generateToken();
    		$this->db->select('id');
	        $this->db->where('username', $data['email']);
	        $this->db->where('status!=', '1');
	        $query3 = $this->db->get('tbl_users');
    		$num = $query3->num_rows();
	        if ($num == 0) {
	        	$status='0';
	            $set=$this->db->insert('tbl_users', array(
		            'username' => $data['email'],
		            'password' => $password,
		            'token' => $token,
		            'account_type' => "business",
		            'is_new_user' => '1',
		            'status' => $status,
		            'createdDate' => $createdDate
		        ));		        

		        if($set){
		        	$is_new_user='0';
		        	$this->db->select('id, is_new_user');
			        $this->db->where('username', $data['email']);
			        $this->db->where('status', $status);
			        $query = $this->db->get('tbl_users');
			        if($query->num_rows() > 0){
			            foreach ($query->result_array() as $data1) {
			                $user_id=$data1['id'];
			                $is_new_user=$data1['is_new_user'];
			            }
			        }

			        $this->db->insert('tbl_business_info', array(
			            'user_id' => $user_id,
			            'name' => ucwords($data['name']),
			            'gender' => $data['gender'],
			            'business_name' => $data['business_name'],
			            'business_phone' => $data['business_phone'],
			            'business_email' => $data['email'],
			            'status' => '0',
			            'createdDate' => $createdDate
			        ));


			        if($this->db->affected_rows() > 0){
		        		$this->session->set_userdata('24ads_user_idetification', $token);
		        		$this->session->set_userdata('is_new_user', $is_new_user);
		        		$this->session->set_userdata('user_avatar', "default.png");
		        		$this->session->set_userdata('account_type', "business");
		        		$this->session->set_userdata('business_name', ucwords($data['business_name']));
		        		$this->session->set_userdata('user_full_name', ucwords($data['name']));
		        		return 'true';
		        	}else{
		        		return $this->db->_error_message();
		        	}
		        }else{
		        	return $this->db->_error_message();
		        }
	        }else{
	        	return "User already exist";
	        }
		}

    	public function register($data){
    		$createdDate=date("Y-m-d H:i:s");
			$password=sha1(md5(md5($data['password'])));
    		$token=generateToken();
    		$this->db->select('id');
	        $this->db->where('username', $data['email']);
	        $this->db->where('status!=', '1');
	        $query3 = $this->db->get('tbl_users');
    		$num = $query3->num_rows();
	        if ($num == 0) {
	        	$status='0';
	            $set=$this->db->insert('tbl_users', array(
		            'username' => $data['email'],
		            'password' => $password,
		            'token' => $token,
		            'account_type' => "personal",
		            'is_new_user' => '1',
		            'status' => $status,
		            'createdDate' => $createdDate
		        ));		        

		        if($set){
		        	$is_new_user='0';
		        	$this->db->select('id, is_new_user');
			        $this->db->where('username', $data['email']);
			        $this->db->where('status', $status);
			        $query = $this->db->get('tbl_users');
			        if($query->num_rows() > 0){
			            foreach ($query->result_array() as $data1) {
			                $user_id=$data1['id'];
			                $is_new_user=$data1['is_new_user'];
			            }
			        }

			        $this->db->insert('tbl_personal_info', array(
			            'user_id' => $user_id,
			            'name' => ucwords($data['name']),
			            'gender' => $data['gender'],
			            'date_of_birth' => $data['date_of_birth'],
			            'phone' => $data['phone'],
			            'email' => $data['email'],
			            'status' => '0',
			            'createdDate' => $createdDate
			        ));


			        if($this->db->affected_rows() > 0){
		        		$this->session->set_userdata('24ads_user_idetification', $token);
		        		$this->session->set_userdata('is_new_user', $is_new_user);
		        		$this->session->set_userdata('user_avatar', "default.png");
		        		$this->session->set_userdata('account_type', "personal");
		        		$this->session->set_userdata('business_name', '');
		        		$this->session->set_userdata('user_full_name', ucwords($data['name']));
		        		return 'true';
		        	}else{
		        		return $this->db->_error_message();
		        	}
		        }else{
		        	return $this->db->_error_message();
		        }
	        }else{
	        	return "User already exist";
	        }
		}

    	public function login($username, $password){
		    $this->db->where('username', $username); 
		   	$this->db->where('password', $password);
		   	$query = $this->db->get('tbl_users');
		   	if(!empty($query->row_array())){
		   		$token=generateToken();
		   		$status=""; $is_new_user="";
				$this->db->set('token', $token);
				$this->db->where('username', $username);
				$this->db->where('password', $password);
				$this->db->where('status', '0');
		     	$this->db->update('tbl_users');
	        	$account_type=""; $full_name=""; $user_id="";
	            foreach ($query->result_array() as $data) {
	                $user_id=$data['id'];
	                $account_type=$data['account_type'];
	                $status=$data['status'];
	                $is_new_user=$data['is_new_user'];
	            }

	            if($status=='0'){
                	/*Account is okay*/
                	$user_avatar=""; $business_name=""; $logo="";
                	$this->db->where('user_id', $user_id);
                	$this->db->where('status', '0');
		            if($account_type=='personal'){
		            	$query = $this->db->get('tbl_personal_info');
		            	foreach ($query->result_array() as $data){
			                $full_name=$data['name'];
			                if($data['avatar']!=""){ $user_avatar=$data['avatar'];}else{ $user_avatar="default.png";}
			            }
		            }else if($account_type=='business'){
		            	$query = $this->db->get('tbl_business_info');
		            	foreach ($query->result_array() as $data){
			                $business_name=$data['business_name'];
			                $full_name=$data['name'];
			                if($data['avatar']!=""){ $user_avatar=$data['avatar'];}else{ $user_avatar="default.png";}
			                if($data['logo']!=""){ $logo=$data['logo'];}else{ $logo="default.jpg";}
			            }
		            }
				   		     	
		        	$this->session->set_userdata('24ads_user_idetification', $token);
		            $this->session->set_userdata('account_type', $account_type);
					$this->session->set_userdata('user_full_name', $full_name);
					$this->session->set_userdata('user_avatar', $user_avatar);
	        		$this->session->set_userdata('is_new_user', $is_new_user);
	        		$this->session->set_userdata('business_name', $business_name);
	        		$this->session->set_userdata('logo', $logo);
		        	// $userID=getUserID($this->userToken);
		        	// recordTrails('tbl_users', $username, 'User logged in', $user_id);
		        	if($account_type=='personal'){
		        		return '';
		        	}elseif($account_type=='business'){
		        		return 'business';
		        	}
                }elseif($data['status']=='2'){
                	/*Account is blocked*/
                	return 'blocked';
                }elseif($data['status']=='3'){
                	/*Account is not activated*/
                	return 'not active';
                }elseif($data['status']=='1'){
                	return 'deleted';
                }
		   	}else{
		   		return 'incorrect';
		 	}
		}

    	public function recover_password($username, $new_password, $encrypted_password){
    		$this->db->select('id, account_type');
    		$this->db->from('tbl_users');
		    $this->db->where('username', $username);
		    $this->db->where('status!=', '1');
		   	$query = $this->db->get();
		   	if($query->num_rows() > 0){
		   		$email="";
	            foreach ($query->result_array() as $data) {
	                $user_id=$data['id'];
	                $account_type=$data['account_type'];
	                if($account_type=='customer'){
	                	$this->db->select('email');
			    		$this->db->from('tbl_user_info');
					    $this->db->where('user_id', $user_id);
					    $this->db->where('status', '0');
					   	$query = $this->db->get();
					   	if($query->num_rows() > 0){
				            foreach ($query->result_array() as $data) {
				                $email=$data['email'];
				            }
					   	}
	                }elseif($account_type=='admin'){
	                	$this->db->select('email');
			    		$this->db->from('tbl_admin');
					    $this->db->where('user_id', $user_id);
					    $this->db->where('status', '0');
					   	$query = $this->db->get();
					   	if($query->num_rows() > 0){
				            foreach ($query->result_array() as $data) {
				                $email=$data['email'];
				            }
					   	}
	                }else{
	                	$this->db->select('email');
			    		$this->db->from('tbl_sellers');
					    $this->db->where('user_id', $user_id);
					    $this->db->where('status', '0');
					   	$query = $this->db->get();
					   	if($query->num_rows() > 0){
				            foreach ($query->result_array() as $data) {
				                $email=$data['email'];
				            }
					   	}
	                }

	                $msg='Your new password is '.$new_password.', use it to login then you can change it';
	                $this->load->library('email');
					$this->email->from('info@getvalueinc.com', 'Get Value Inc - Help Center');
					$this->email->to($email);
					$this->email->subject('Password Recovery');
					$this->email->message($msg);
					$this->email->send();

	                $this->db->set('password', $encrypted_password);
					$this->db->where('id', $user_id);
			     	$this->db->update('tbl_users');
			     	return 'Success';
	            }
		   	}else{
		   		return 'incorrect';
		   	}
		}

		public function change_password($userID, $cpassword, $password){
			$this->db->where('id', $userID); 
		   	$this->db->where('password', $cpassword);
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_users');
		   	if(!empty($query->row_array())){
				$this->db->set('password', $password);
				// $this->db->set('password_set', '0');
				$this->db->where('id', $userID);
				$this->db->where('password', $cpassword);
		     	$this->db->update('tbl_users');
	        	echo 'Success';
	            // $desc=$this->session->userdata('user_full_name').' changed password';
	            // recordTrails('tbl_users', $userID, $desc, $userID);
		    }else{
		   		echo ErrorMsg("Incorrect Current Password");
            	// $desc=$this->session->userdata('user_full_name').' attempt to change password failed, Incorrect Current Password';
            	// recordTrails('tbl_users', $userID, $desc, $userID);
		 	}
		}

		public function account_info($userID, $account_type){
			$this->db->where('user_id', $userID);
		   	$this->db->where('status', '0');
		   	if($account_type=='personal'){
		   		$query = $this->db->get('tbl_personal_info');
		   	}else if($account_type=='business'){
		   		$query = $this->db->get('tbl_business_info');
		   	}	   	
		   	return $query->row_array();
		}

    	public function update_business_profile($data, $userID){
    		$avFile="";
    		unset($_SESSION['uploaded_file']);
    		// $avatar='ok';
    		if(isset($_FILES['logo']) && $_FILES['logo']['name']!=""){
    			$logo=do_upload('media/logo', 'logo', str_replace(" ", "_", $data['business_name']), '', '', '', 'image');
    			if($logo!='ok'){ 
    				return $logo;
    				exit;
    			}
    		}
			if(!empty($this->session->userdata('uploaded_file')) && $this->session->userdata('uploaded_file')!=""){
				$avFile=$this->session->userdata('uploaded_file');
				$this->session->set_userdata('logo', $avFile);
			}
			$values=array(
	            'name' => $data['name'],
	            'gender' => $data['gender'],
	            'business_email' => $data['business_email'],
	            'business_phone' => $data['business_phone'],
	            'business_name' => $data['business_name'],
	            'business_address' => $data['business_address'],
	            'business_website' => $data['business_website'],
	            'country' => $data['country'],
	            'region' => $data['region'],
	            'district' => $data['district'],
	            'TIN' => $data['TIN'],
	            'description' => $data['description'],
	            'logo' => $avFile
	        );
			$this->db->where('user_id', $userID);
			$this->db->where('status', '0');
	     	$update=$this->db->update('tbl_business_info', $values);
	     	if($update){
	     		$this->db->set('is_new_user', '0');
	     		$this->db->where('id', $userID);
	     		$this->db->where('status', '0');
		     	$this->db->update('tbl_users');
        		$this->session->set_userdata('is_new_user', '0');
        		$this->session->set_userdata('business_name', ucwords($data['business_name']));
        		$this->session->set_userdata('user_full_name', ucwords($data['name']));
	     		return 'Success';
	     	}else{
	        	return $this->db->_error_message();
	        }
		}

    	public function update_profile($data, $userID){
    		$avFile="";
    		unset($_SESSION['uploaded_file']);
    		// $avatar='ok';
    		if(isset($_FILES['avatar']) && $_FILES['avatar']['name']!=""){
    			$avatar=do_upload('media/avatar', 'avatar', str_replace(" ", "_", $data['name']), '', '', '', 'image');
    			if($avatar!='ok'){ 
    				return $avatar;
    				exit;
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
	            'country' => $data['country'],
	            'region' => $data['region'],
	            'district' => $data['district'],
	            'date_of_birth' => $data['date_of_birth'],
	            'avatar' => $avFile
	        );
			$this->db->where('user_id', $userID);
			$this->db->where('status', '0');
	     	$update=$this->db->update('tbl_personal_info', $values);
	     	if($update){
	     		$this->db->set('is_new_user', '0');
	     		$this->db->where('id', $userID);
	     		$this->db->where('status', '0');
		     	$this->db->update('tbl_users');
        		$this->session->set_userdata('is_new_user', '0');
        		$this->session->set_userdata('user_full_name', ucwords($data['name']));
	     		return 'Success';
	     	}else{
	        	return $this->db->_error_message();
	        }
		}

    }
?>