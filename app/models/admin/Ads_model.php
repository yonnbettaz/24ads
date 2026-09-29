<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Ads_model extends CI_Model{

	    public function __construct(){
	        parent::__construct();
	        $this->load->database();
    	}

    	public function load_ads_details($ads_id){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_uploaded, question_timer, bonus, contents, rejected_reason');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		$this->db->where('tbl_ads.id', $ads_id);
    		$this->db->where('tbl_ads.status!=', '1');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->row_array();
    		return $result;
    	}

    	public function load_pending_ads(){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_uploaded');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		$this->db->where('tbl_ads.ads_status', '2');
    		$this->db->where('tbl_ads.status!=', '1');
    		$this->db->order_by('date_uploaded', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_active_ads(){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_uploaded');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		$this->db->where('tbl_ads.ads_status', '1');
    		$this->db->where('tbl_ads.status!=', '1');
    		$this->db->order_by('date_uploaded', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_denied_ads(){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_uploaded');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		$this->db->where('tbl_ads.ads_status', '3');
    		$this->db->where('tbl_ads.status!=', '1');
    		$this->db->order_by('date_uploaded', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_closed_ads(){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_uploaded');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		$this->db->where('tbl_ads.ads_status', '0');
    		$this->db->where('tbl_ads.status!=', '1');
    		$this->db->order_by('date_uploaded', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_promos(){
    		$result=array();
    		$this->db->select('id, title, banner, view_location, expire_date, createdDate, cost, status, url');
    		$this->db->from('tbl_promo');
    		$this->db->where('status!=', '1');
    		$this->db->order_by('createdDate', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_promo_info($promo_id){
    		$result=array();
    		$this->db->select('id, title, banner, view_location, expire_date, createdDate, cost, url');
    		$this->db->from('tbl_promo');
    		$this->db->where('id', $promo_id);
    		$this->db->where('status!=', '1');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->row_array();
    		return $result;
    	}

    	public function reject_ads($data, $userID){
    		$ads=$data['ads'];
    		$rejected_reason=$data['rejected_reason'];

	        $this->db->set('ads_status', '3');
	        $this->db->set('rejected_reason', $rejected_reason);
	        $this->db->set('rejected_by', $userID);
	        $this->db->set('rejected_date', date("Y-m-d H:i:s"));
			$this->db->where('id', $ads);
			$this->db->where('status', '0');
	     	$this->db->update('tbl_ads');
    		return 'Success';
		}

    	public function save_promo($data, $userID){
    		$createdDate=date("Y-m-d H:i:s");
    		$title=$data['title'];
    		$url=$data['url'];
    		$view_location=$data['view_location'];
    		$expire_date=$data['expire_date'];
    		$cost=$data['cost'];
    		$this->db->select('id'); 
		    $this->db->where('title', $title); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_promo');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This promo already exist');
		   	}else{
		   		$bannerFile="";
	    		unset($_SESSION['uploaded_file']);
	    		if(isset($_FILES['banner']) && $_FILES['banner']['name']!=""){
	    			$banner=do_upload('media/promo', 'banner', str_replace(" ", "_", $title), '', '', '', 'image');
	    			if($banner!='ok'){ 
	    				die(ErrorMsg($banner));
	    			}
	    		}else{
	    			die(ErrorMsg('Please! upload promo banner'));
	    		}
				if(!empty($this->session->userdata('uploaded_file')) && $this->session->userdata('uploaded_file')!=""){
					$bannerFile=$this->session->userdata('uploaded_file');
				}
				$set=$this->db->insert('tbl_promo', array(
		            'title' => $title,
		            'url' => $url,
		            'view_location' => $view_location,
		            'expire_date' => $expire_date,
		            'cost' => $cost,
		            'banner' => $bannerFile,
		            'status' => '0',
		            'createdBy' => $userID,
		            'createdDate' => $createdDate
		        ));
		     	if($set){
		     		return 'Success';
		     	}else{
		        	return $this->db->_error_message();
		        }
		   	}
		}

    	public function update_promo($data, $userID){
    		$createdDate=date("Y-m-d H:i:s");
    		$title=$data['title'];
    		$url=$data['url'];
    		$view_location=$data['view_location'];
    		$expire_date=$data['expire_date'];
    		$cost=$data['cost'];
    		$promo=$data['promo'];
    		$this->db->select('id'); 
		    $this->db->where('id!=', $promo); 
		    $this->db->where('title', $title); 
		   	$this->db->where('status', '0');
		   	$query = $this->db->get('tbl_promo');
		   	if($query->num_rows()>0){
		   		return ErrorMsg('Sorry! This promo already exist');
		   	}else{
		   		$bannerFile="";
	    		unset($_SESSION['uploaded_file']);
	    		if(isset($_FILES['banner']) && $_FILES['banner']['name']!=""){
	    			$banner=do_upload('media/promo', 'banner', str_replace(" ", "_", $title), '', '', '', 'image');
	    			if($banner!='ok'){ 
	    				die(ErrorMsg($banner));
	    			}
	    		}
				if(!empty($this->session->userdata('uploaded_file')) && $this->session->userdata('uploaded_file')!=""){
					$bannerFile=$this->session->userdata('uploaded_file');
				}
				$set=array(
		            'title' => $title,
		            'url' => $url,
		            'view_location' => $view_location,
		            'expire_date' => $expire_date,
		            'cost' => $cost
		        );
		        if($bannerFile!=""){
		        	$set['banner']=$bannerFile;
		        }
		        $this->db->where('id', $promo);
			   	$this->db->update('tbl_promo', $set);
		     	return 'Success';
		   	}
		}

    	/*Control*/
		public function close_ads($info, $userID){
			$this->db->set('ads_status', '0');
			$this->db->set('closed_by', $userID); 
			$this->db->set('closed_date', date("Y-m-d H:i:s"));
		   	$this->db->where('id', $info);
		   	$this->db->update('tbl_ads');
		   	return 'Success';
		}

		public function enable_ads($info, $userID){
			$this->db->set('ads_status', '1');
			$this->db->set('enabled_by', $userID); 
			$this->db->set('enabled_date', date("Y-m-d H:i:s"));
		   	$this->db->where('id', $info);
		   	$this->db->update('tbl_ads');
		   	return 'Success';
		}

		public function disable_ads($info, $userID){
			$this->db->set('ads_status', '2');
			$this->db->set('disabled_by', $userID); 
			$this->db->set('disabled_date', date("Y-m-d H:i:s"));
		   	$this->db->where('id', $info);
		   	$this->db->update('tbl_ads');
		   	return 'Success';
		}
		/*end of control*/

    }
?>