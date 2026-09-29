<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin_model extends CI_Model{

	    public function __construct(){
	        parent::__construct();
	        $this->load->database();
    	}

		public function load_personal_accounts(){
			$result=array();
			$this->db->select('tbl_users.id, username, account_type, name, gender, date_of_birth, avatar, phone, email, country, region, district, tbl_users.status, tbl_users.createdDate');
		   	$this->db->from('tbl_users');
		   	$this->db->join('tbl_personal_info', 'tbl_personal_info.user_id=tbl_users.id');
		   	$this->db->where('tbl_users.account_type', 'personal');
		   	$this->db->where('tbl_users.status!=', '1');
	   		$query = $this->db->get();
	   		if($query->num_rows()>0)  	
		   		$result=$query->result();
		   	return $result;
		}

		public function load_business_accounts(){
			$result=array();
			$this->db->select('tbl_users.id, username, account_type, business_name, business_phone, business_email, business_address, TIN, name, gender, logo, country, region, district, tbl_users.status, tbl_users.createdDate');
		   	$this->db->from('tbl_users');
		   	$this->db->join('tbl_business_info', 'tbl_business_info.user_id=tbl_users.id');
		   	$this->db->where('tbl_users.account_type', 'business');
		   	$this->db->where('tbl_users.status!=', '1');
	   		$query = $this->db->get();
	   		if($query->num_rows()>0)  	
		   		$result=$query->result();
		   	return $result;
		}

    	public function load_personal_records(){
    		$result=array();
    		$this->db->select('tbl_ads.id, tbl_personal_info.name, title, banner, business_name, total_question, correct_answer, total_cash');
    		$this->db->from('tbl_clicked_ads');
    		$this->db->join('tbl_ads', 'tbl_ads.id=tbl_clicked_ads.ads_id');
            $this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id');
		   	$this->db->join('tbl_personal_info', 'tbl_personal_info.user_id=tbl_clicked_ads.user_id AND tbl_personal_info.status<>"1"');
    		$this->db->where('tbl_clicked_ads.status', '0');
    		$this->db->order_by('date_clicked', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_business_records(){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_uploaded');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		// $this->db->where('tbl_ads.ads_status', '2');
    		$this->db->where('tbl_ads.status!=', '1');
    		$this->db->order_by('date_uploaded', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_budget_history(){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_clicked, total_cash');
    		$this->db->from('tbl_clicked_ads');
    		$this->db->join('tbl_ads', 'tbl_ads.id=tbl_clicked_ads.ads_id AND tbl_ads.status<>"1"');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		// $this->db->where('tbl_ads.ads_status', '2');
    		$this->db->where('tbl_clicked_ads.status', '0');
    		$this->db->where('tbl_clicked_ads.total_cash>0');
    		$this->db->order_by('tbl_ads.id', 'ASC');
    		$this->db->order_by('date_clicked', 'ASC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function check_pending_ads(){
    		$result=array();
    		$this->db->select('tbl_ads.id');
    		$this->db->from('tbl_ads');
    		$this->db->where('tbl_ads.ads_status', '2');
    		$this->db->where('tbl_ads.status', '0');
    		$query=$this->db->get();
    		return $query->num_rows();
    	}

    	public function load_personal_withdraw(){
    		$result=array();
    		$this->db->select('id, requestID, amount, is_processed, rejection_reason, createdDate, rejected_date, user_id, status');
            $this->db->from('tbl_withdrawal');
            $this->db->where('status!=', '1');
            $this->db->order_by('createdDate', 'DESC');
	   		$query = $this->db->get();
	   		if($query->num_rows()>0){ 	
		   		foreach ($query->result_array() as $rows) {
		   			$list=array();
		   			$user_id=$rows['user_id'];
		   			$list['id']=$rows['id'];
		   			$list['status']=$rows['status'];
		   			$list['requestID']=$rows['requestID'];
                	$list['amount']=$rows['amount'];
                	$list['is_processed']=$rows['is_processed'];
                	$list['createdDate']=$rows['createdDate'];
                	$name="";
		   			
		   			$this->db->select('tbl_users.id, name, avatar, phone, email');
				   	$this->db->from('tbl_users');
				   	$this->db->join('tbl_personal_info', 'tbl_personal_info.user_id=tbl_users.id');
				   	$this->db->where('tbl_users.account_type', 'personal');
		            $this->db->where('tbl_users.id', $user_id);
		            $query1=$this->db->get();
		            if($query1->num_rows()>0){
		                foreach ($query1->result_array() as $data) {
		                	$name=$data['name'];
				   			$avatar=$data['avatar'];
				   			$phone=$data['phone'];
				   			$email=$data['email'];

				   			$list['name']=$name;
				   			$list['avatar']=$avatar;
				   			$list['phone']=$phone;
				   			$list['email']=$email;
		                }
	                }
	                if($name!=""){
			            array_push($result, $list);
			        }
		   		}
		   	}            
            return $result;
    	}

    	public function load_pending_transactions(){
    		$result=array();
    		$this->db->select('transaction_type, credit, debit, is_complete, createdDate, user_id');
            $this->db->from('tbl_transaction_records');
            $this->db->where('is_complete', '1');
            $this->db->where('status', '0');
            $this->db->order_by('createdDate', 'ASC');
	   		$query = $this->db->get();
	   		if($query->num_rows()>0){ 	
		   		foreach ($query->result_array() as $rows) {
		   			$list=array();
		   			$user_id=$rows['user_id'];
		   			$list['transaction_type']=$rows['transaction_type'];
                	$list['credit']=$rows['credit'];
                	$list['debit']=$rows['debit'];
                	$list['is_complete']=$rows['is_complete'];
                	$list['createdDate']=$rows['createdDate'];
                	$name="";
		   			
		   			$this->db->select('tbl_users.id, name, avatar, phone, email');
				   	$this->db->from('tbl_users');
				   	$this->db->join('tbl_personal_info', 'tbl_personal_info.user_id=tbl_users.id');
				   	$this->db->where('tbl_users.account_type', 'personal');
		            $this->db->where('tbl_users.id', $user_id);
		            $query1=$this->db->get();
		            if($query1->num_rows()>0){
		                foreach ($query1->result_array() as $data) {
		                	$name=$data['name'];
				   			$avatar=$data['avatar'];
				   			$phone=$data['phone'];
				   			$email=$data['email'];

				   			$list['name']=$name;
				   			$list['avatar']=$avatar;
				   			$list['phone']=$phone;
				   			$list['email']=$email;
		                }
	                }
	                if($name!=""){
			            array_push($result, $list);
			        }
		   		}
		   	}            
            return $result;
    	}

    	public function load_transaction_history(){
    		$result=array();
    		$this->db->select('transaction_type, credit, debit, is_complete, createdDate, user_id');
            $this->db->from('tbl_transaction_records');
            $this->db->where('is_complete', '0');
            $this->db->where('status', '0');
            $this->db->order_by('createdDate', 'ASC');
	   		$query = $this->db->get();
	   		if($query->num_rows()>0){ 	
		   		foreach ($query->result_array() as $rows) {
		   			$list=array();
		   			$user_id=$rows['user_id'];
		   			$list['transaction_type']=$rows['transaction_type'];
                	$list['credit']=$rows['credit'];
                	$list['debit']=$rows['debit'];
                	$list['is_complete']=$rows['is_complete'];
                	$list['createdDate']=$rows['createdDate'];
                	$name="";
		   			
		   			$this->db->select('tbl_users.id, name, avatar, phone, email');
				   	$this->db->from('tbl_users');
				   	$this->db->join('tbl_personal_info', 'tbl_personal_info.user_id=tbl_users.id');
				   	$this->db->where('tbl_users.account_type', 'personal');
		            $this->db->where('tbl_users.id', $user_id);
		            $query1=$this->db->get();
		            if($query1->num_rows()>0){
		                foreach ($query1->result_array() as $data) {
		                	$name=$data['name'];
				   			$avatar=$data['avatar'];
				   			$phone=$data['phone'];
				   			$email=$data['email'];

				   			$list['name']=$name;
				   			$list['avatar']=$avatar;
				   			$list['phone']=$phone;
				   			$list['email']=$email;
		                }
	                }
	                if($name!=""){
			            array_push($result, $list);
			        }
		   		}
		   	}            
            return $result;
    	}

    	public function load_transaction_balance(){
    		$result=array();
    		$this->db->select('tbl_users.id, name, avatar, phone, email');
		   	$this->db->from('tbl_users');
		   	$this->db->join('tbl_personal_info', 'tbl_personal_info.user_id=tbl_users.id');
		   	$this->db->where('tbl_users.account_type', 'personal');
		   	$this->db->where('tbl_users.status!=', '1');
	   		$query = $this->db->get();
	   		if($query->num_rows()>0){ 	
		   		foreach ($query->result_array() as $data) {
		   			$list=array();
		   			$user_id=$data['id'];
		   			$name=$data['name'];
		   			$avatar=$data['avatar'];
		   			$phone=$data['phone'];
		   			$email=$data['email'];

		   			$total_commission=0; $total_withdraw=0; $total_charge=0;
		            $this->db->select('transaction_type, credit, debit');
		            $this->db->from('tbl_transaction_records');
		            $this->db->where('user_id', $user_id);
		            $this->db->where('is_complete', '0');
		            $this->db->where('status', '0');
		            $query1=$this->db->get();
		            if($query1->num_rows()>0){
		                foreach ($query1->result_array() as $data1) {
		                    $transaction_type=$data1['transaction_type'];
		                    $credit=$data1['credit'];
		                    $debit=$data1['debit'];
		                    if($transaction_type=='commission'){
		                        $total_commission=$total_commission+$credit;
		                    }
		                    if($transaction_type=='withdraw'){
		                        $total_withdraw=$total_withdraw+$debit;
		                    }
		                    if($transaction_type=='charge'){
		                        $total_charge=$total_charge+$debit;
		                    }
		                }
		            }
		            $list['name']=$name;
		            $list['avatar']=$avatar;
		            $list['phone']=$phone;
		            $list['email']=$email;
		            $list['total_commission']=$total_commission;
		            $list['total_withdraw']=$total_withdraw;
		            $list['total_charge']=$total_charge;
		            $list['balance']=$total_commission-($total_withdraw+$total_charge);
		            array_push($result, $list);
		   		}
		   	}            
            return $result;
    	}

    	public function personal_withdraw(){
    		$result=array();
    		$this->db->select('tbl_ads.id, tbl_personal_info.name, title, banner, business_name, total_question, correct_answer, total_cash');
    		$this->db->from('tbl_clicked_ads');
    		$this->db->join('tbl_ads', 'tbl_ads.id=tbl_clicked_ads.ads_id');
            $this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id');
		   	$this->db->join('tbl_personal_info', 'tbl_personal_info.user_id=tbl_clicked_ads.user_id AND tbl_personal_info.status<>"1"');
    		$this->db->where('tbl_clicked_ads.status', '0');
    		$this->db->order_by('date_clicked', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

		public function load_payment_providers(){
			$result=array();
			$this->db->select('id, status, provider, method');
		   	$this->db->where('status!=', '1');
	   		$query = $this->db->get('tbl_payment_provider');
	   		if($query->num_rows()>0)  	
		   		$result=$query->result();
		   	return $result;
		}

		public function load_payment_provider_info($provider_id){
			$result=array();
			$this->db->select('id, provider, method');
		   	$this->db->where('id', $provider_id);
		   	$this->db->where('status!=', '1');
	   		$query = $this->db->get('tbl_payment_provider');
	   		if($query->num_rows()>0)  	
		   		$result=$query->row_array();
		   	return $result;
		}

		public function load_system_settings(){
			$result=array();
			$this->db->select('id, status, setting_key, setting_value');
		   	$this->db->where('status!=', '1');
	   		$query = $this->db->get('tbl_settings');
	   		if($query->num_rows()>0)  	
		   		$result=$query->result();
		   	return $result;
		}

		public function load_system_setting_info($setting){
			$result=array();
			$this->db->select('id, setting_key, setting_value');
		   	$this->db->where('id', $setting);
		   	$this->db->where('status!=', '1');
	   		$query = $this->db->get('tbl_settings');
	   		if($query->num_rows()>0)  	
		   		$result=$query->row_array();
		   	return $result;
		}

    	public function save_payment_provider($data, $userID){
    		$createdDate=date("Y-m-d H:i:s");
    		$method=$data['method'];
    		$provider=$data['provider'];
		    $this->db->select('id'); 
		    $this->db->where('provider', $provider); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_payment_provider');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This provider already exist');
		   	}else{
		   		$this->db->insert('tbl_payment_provider', array(
		            'method' => $method,
		            'provider' => $provider,
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

    	public function update_payment_provider($data, $userID){
    		$method=$data['method'];
    		$provider=$data['provider'];
    		$provider_id=$data['provider_id'];
		    $this->db->select('id'); 
		    $this->db->where('provider', $provider); 
		    $this->db->where('id!=', $provider_id); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_payment_provider');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This provider already exist');
		   	}else{
		        $this->db->set('method', $method);
		        $this->db->set('provider', $provider);
				$this->db->where('id', $provider_id);
				$this->db->where('status', '0');
		     	$this->db->update('tbl_payment_provider');
        		return 'Success';
		 	}
		}

    	public function save_system_setting($data, $userID){
    		$createdDate=date("Y-m-d H:i:s");
    		$setting_key=$data['setting_key'];
    		$setting_value=$data['setting_value'];
		    $this->db->select('id'); 
		    $this->db->where('setting_key', $setting_key); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_settings');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This setting already exist');
		   	}else{
		   		$this->db->insert('tbl_settings', array(
		            'setting_key' => $setting_key,
		            'setting_value' => $setting_value,
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

    	public function update_system_setting($data, $userID){
    		$setting_key=$data['setting_key'];
    		$setting_value=$data['setting_value'];
    		$setting_id=$data['setting'];
		    $this->db->select('id'); 
		    $this->db->where('setting_key', $setting_key); 
		    $this->db->where('id!=', $setting_id); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_settings');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This setting already exist');
		   	}else{
		        $this->db->set('setting_key', $setting_key);
		        $this->db->set('setting_value', $setting_value);
				$this->db->where('id', $setting_id);
				$this->db->where('status', '0');
		     	$this->db->update('tbl_settings');
        		return 'Success';
		 	}
		}

    	public function reject_withdraw($data, $userID){
    		$withdraw_id=$data['withdraw'];
    		$rejected_reason=$data['rejected_reason'];

	        $this->db->set('is_processed', '2');
	        $this->db->set('rejection_reason', $rejected_reason);
	        $this->db->set('rejected_by', $userID);
	        $this->db->set('rejected_date', date("Y-m-d H:i:s"));
			$this->db->where('id', $withdraw_id);
			$this->db->where('status', '0');
	     	$this->db->update('tbl_withdrawal');
    		return 'Success';
		}

		public function enable_withdraw($info, $userID){
			$this->db->set('is_processed', '1');
		   	$this->db->where('id', $info);
		   	$this->db->update('tbl_withdrawal');
		   	return 'Success';
		}

		public function disburse_withdraw_request($info, $userID){
			$this->db->set('is_processed', '0');
		   	$this->db->where('id', $info);
		   	$this->db->update('tbl_withdrawal');

			$this->db->set('is_complete', '0');
		   	$this->db->where('withdraw_id', $info);
		   	$this->db->update('tbl_transaction_records');
		   	return 'Success';
		}

		/*Control*/
		public function delete_row($info, $table, $userID){
			$this->db->set('status', '1'); 
		   	$this->db->where('id', $info);
		   	$this->db->update($table);
		   	return 'Success';
		}

		public function activate_row($info, $table, $userID){
			$this->db->set('status', '0'); 
		   	$this->db->where('id', $info);
		   	$this->db->update($table);
		   	return 'Success';
		}

		public function diactivate_row($info, $table, $userID){
			$this->db->set('status', '2'); 
		   	$this->db->where('id', $info);
		   	$this->db->update($table);
		   	return 'Success';
		}
		/*end of control*/
    }
?>