<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Reports_model extends CI_Model{

	    public function __construct(){
	        parent::__construct();
	        $this->load->database();
    	}

    	public function load_personal_account_report($startDate, $endDate){
    		$result=array();
            $this->db->select('tbl_users.id, username, account_type, name, gender, date_of_birth, avatar, phone, email, country, region, district, tbl_users.status, tbl_users.createdDate');
            $this->db->from('tbl_users');
            $this->db->join('tbl_personal_info', 'tbl_personal_info.user_id=tbl_users.id');
            $this->db->where('tbl_users.account_type', 'personal');
            $this->db->where('tbl_users.status!=', '1');
            $this->db->where('tbl_users.createdDate BETWEEN "'.$startDate.'" AND "'.$endDate.'"');
            $query = $this->db->get();
            if($query->num_rows()>0)    
                $result=$query->result();
            return $result;
    	}

        public function load_business_account_report($startDate, $endDate){
            $result=array();
            $this->db->select('tbl_users.id, username, account_type, business_name, business_phone, business_email, business_address, TIN, name, gender, logo, country, region, district, tbl_users.status, tbl_users.createdDate');
            $this->db->from('tbl_users');
            $this->db->join('tbl_business_info', 'tbl_business_info.user_id=tbl_users.id');
            $this->db->where('tbl_users.account_type', 'business');
            $this->db->where('tbl_users.status!=', '1');
            $this->db->where('tbl_users.createdDate BETWEEN "'.$startDate.'" AND "'.$endDate.'"');
            $query = $this->db->get();
            if($query->num_rows()>0)    
                $result=$query->result();
            return $result;
        }

        public function load_ads_report($startDate, $endDate){
            $result=array();
            $this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_uploaded');
            $this->db->from('tbl_ads');
            $this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
            $this->db->where('tbl_ads.ads_status', '1');
            $this->db->where('tbl_ads.status!=', '1');
            $this->db->where('tbl_ads.date_uploaded BETWEEN "'.$startDate.'" AND "'.$endDate.'"');
            $this->db->order_by('date_uploaded', 'DESC');
            $query = $this->db->get();
            if($query->num_rows()>0)    
                $result=$query->result();
            return $result;
        }

        public function load_cash_flow_report($startDate, $endDate){
            $result=array();
            $total_budget=0; $total_bonus=0; $total_commission=0;
            $this->db->select('tbl_ads.id, budget_allocated, total_bonus_allocated');
            $this->db->from('tbl_ads');
            $this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
            $this->db->where('tbl_ads.status', '0');
            $this->db->where('date_uploaded BETWEEN "'.$startDate.'" AND "'.$endDate.'"');
            $query=$this->db->get();
            if($query->num_rows()>0){
                foreach ($query->result_array() as $data) {
                    $ads_id=$data['id'];
                    $budget_allocated=$data['budget_allocated'];
                    $total_bonus_allocated=$data['total_bonus_allocated'];
                    $total_budget=$total_budget+$budget_allocated;
                    $total_bonus=$total_bonus+$total_bonus_allocated;

                    $this->db->select('credit');
                    $this->db->from('tbl_transaction_records');
                    $this->db->where('ads_id', $ads_id);
                    $this->db->where('status', '0');
                    $query1=$this->db->get();
                    if($query1->num_rows()>0){
                        foreach ($query1->result_array() as $data1) {
                            $credit=$data1['credit'];
                            $total_commission=$total_commission+$credit;
                        }
                    }
                }
            }
            $result['total_budget']=$total_budget;
            $result['total_bonus']=$total_bonus;
            $result['total_commission']=$total_commission;
            $result['profit']="";
            return $result;
        }

        /*Statistics starts here*/

        public function get_total_personal_accounts(){
            $result=array();
            $this->db->select('tbl_users.id');
            $this->db->from('tbl_users');
            $this->db->where('tbl_users.account_type', 'personal');
            $this->db->where('tbl_users.status', '0');
            $query = $this->db->get();
            return $query->num_rows();
        }        

        public function get_total_business_accounts(){
            $result=array();
            $this->db->select('tbl_users.id');
            $this->db->from('tbl_users');
            $this->db->where('tbl_users.account_type', 'business');
            $this->db->where('tbl_users.status', '0');
            $query = $this->db->get();
            return $query->num_rows();
        }        

        public function get_total_ads(){
            $result=array();
            $this->db->select('tbl_ads.id');
            $this->db->from('tbl_ads');
            $this->db->where('tbl_ads.status', '0');
            $query=$this->db->get();
            return $query->num_rows();
        }    

        public function get_total_active_ads(){
            $result=array();
            $this->db->select('tbl_ads.id');
            $this->db->from('tbl_ads');
            $this->db->where('tbl_ads.ads_status', '1');
            $this->db->where('tbl_ads.status', '0');
            $query=$this->db->get();
            return $query->num_rows();
        }

        public function load_latest_ads(){
            $result=array();
            $this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name, ads_status, tbl_ads.status, budget_allocated, total_bonus_allocated, date_uploaded');
            $this->db->from('tbl_ads');
            $this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
            $this->db->where('tbl_ads.status!=', '1');
            $this->db->order_by('date_uploaded', 'DESC');
            $this->db->limit(6);
            $query=$this->db->get();
            if($query->num_rows()>0)
                $result=$query->result();
            return $result;
        }

        public function get_total_pending_ads(){
            $this->db->select('id');
            $this->db->from('tbl_ads');
            $this->db->where('ads_status', '2');
            $this->db->where('status!=', '1');
            return $this->db->count_all_results();
        }

        public function get_total_rejected_ads(){
            $this->db->select('id');
            $this->db->from('tbl_ads');
            $this->db->where('ads_status', '3');
            $this->db->where('status!=', '1');
            return $this->db->count_all_results();
        }

        public function get_ads_created_today(){
            $today = date('Y-m-d');
            $this->db->select('id');
            $this->db->from('tbl_ads');
            $this->db->like('date_uploaded', $today, 'after');
            $this->db->where('status!=', '1');
            return $this->db->count_all_results();
        }

        public function get_ads_approved_today(){
            $today = date('Y-m-d');
            $this->db->select('id');
            $this->db->from('tbl_ad_approval_history');
            $this->db->where('action', 'APPROVED');
            $this->db->like('created_at', $today, 'after');
            return $this->db->count_all_results();
        }

        public function get_ads_rejected_today(){
            $today = date('Y-m-d');
            $this->db->select('id');
            $this->db->from('tbl_ad_approval_history');
            $this->db->where('action', 'REJECTED');
            $this->db->like('created_at', $today, 'after');
            return $this->db->count_all_results();
        }

        public function load_recent_pending_ads($limit = 6){
            $this->db->select('tbl_ads.id, tbl_ads.title, tbl_ads.banner, tbl_ads.cost_per_click, tbl_ads.budget_allocated, tbl_ads.date_uploaded, tbl_ads.ads_status, tbl_business_info.business_name');
            $this->db->from('tbl_ads');
            $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id', 'left');
            $this->db->where('tbl_ads.ads_status', '2');
            $this->db->where('tbl_ads.status!=', '1');
            $this->db->order_by('tbl_ads.date_uploaded', 'DESC');
            $this->db->limit($limit);
            return $this->db->get()->result();
        }

        public function load_recent_approvals($limit = 6){
            $this->db->select('tbl_ad_approval_history.*, tbl_ads.title as ad_title, tbl_ads.banner as ad_banner, tbl_business_info.business_name, tbl_admin_info.name as admin_name');
            $this->db->from('tbl_ad_approval_history');
            $this->db->join('tbl_ads', 'tbl_ads.id = tbl_ad_approval_history.ad_id', 'left');
            $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id', 'left');
            $this->db->join('tbl_admin_info', 'tbl_admin_info.admin_id = tbl_ad_approval_history.admin_id', 'left');
            $this->db->where('tbl_ad_approval_history.action', 'APPROVED');
            $this->db->order_by('tbl_ad_approval_history.created_at', 'DESC');
            $this->db->limit($limit);
            return $this->db->get()->result();
        }

        public function load_recent_rejections($limit = 6){
            $this->db->select('tbl_ad_approval_history.*, tbl_ads.title as ad_title, tbl_ads.banner as ad_banner, tbl_business_info.business_name, tbl_admin_info.name as admin_name');
            $this->db->from('tbl_ad_approval_history');
            $this->db->join('tbl_ads', 'tbl_ads.id = tbl_ad_approval_history.ad_id', 'left');
            $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id', 'left');
            $this->db->join('tbl_admin_info', 'tbl_admin_info.admin_id = tbl_ad_approval_history.admin_id', 'left');
            $this->db->where('tbl_ad_approval_history.action', 'REJECTED');
            $this->db->order_by('tbl_ad_approval_history.created_at', 'DESC');
            $this->db->limit($limit);
            return $this->db->get()->result();
        }

        /*end of statistics*/

    }
?>