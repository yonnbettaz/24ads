<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home_model extends CI_Model{

	    public function __construct(){
	        parent::__construct();
	        $this->load->database();
        	$this->userToken=$this->session->userdata('24ads_user_idetification');
    	}

    	public function load_high_paid_ads(){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		$this->db->where('tbl_ads.ads_status', '1');
    		$this->db->where('tbl_ads.status', '0');
    		$this->db->order_by('cost_per_click', 'DESC');
    		$this->db->limit(15);
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_ads(){
    		$result=array();
    		$this->db->select('tbl_ads.id, title, url, banner, cost_per_click, business_name');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"');
    		$this->db->where('tbl_ads.ads_status', '1');
    		$this->db->where('tbl_ads.status', '0');
    		$this->db->order_by('date_uploaded', 'DESC');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

    	public function load_ads_content($ads_id){
    		$result=array();
    		if(empty($ads_id)){
    			return $result;
    		}
    		$this->db->select('tbl_ads.id, tbl_ads.title, tbl_ads.contents, tbl_ads.url, tbl_ads.banner, tbl_ads.cost_per_click, tbl_ads.budget_allocated, tbl_ads.total_bonus_allocated, tbl_ads.bonus, tbl_ads.question_timer, tbl_ads.ads_status, tbl_ads.date_uploaded, tbl_business_info.business_name, tbl_business_info.logo as business_logo, tbl_business_info.business_phone, tbl_business_info.business_email, tbl_business_info.business_website, tbl_business_info.region, tbl_business_info.district');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"', 'left');
    		$this->db->where('tbl_ads.id', $ads_id);
    		$this->db->where('tbl_ads.status!=', '1');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result_array();
    		return $result;
    	}

    	public function load_related_ads($current_ad_id = 0, $limit = 4){
    		$result = array();
    		$this->db->select('tbl_ads.id, tbl_ads.title, tbl_ads.banner, tbl_ads.cost_per_click, tbl_business_info.business_name');
    		$this->db->from('tbl_ads');
    		$this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id AND tbl_business_info.status="0"', 'left');
    		if(!empty($current_ad_id)){
    			$this->db->where('tbl_ads.id!=', $current_ad_id);
    		}
    		$this->db->where('tbl_ads.ads_status', '1');
    		$this->db->where('tbl_ads.status', '0');
    		$this->db->order_by('tbl_ads.cost_per_click', 'DESC');
    		$this->db->limit($limit);
    		$query = $this->db->get();
    		if($query->num_rows() > 0){
    			$result = $query->result();
    		}
    		return $result;
    	}

    	public function update_clicked_ads($ads_id, $userID, $total_question="", $correct_answer="", $total_cash=""){
    		$createdDate=date("Y-m-d H:i:s");
    		if($userID!=""){
    			$this->db->select('id');
	    		$this->db->from('tbl_clicked_ads');
	    		$this->db->where('user_id', $userID);
	    		$this->db->where('ads_id', $ads_id);
	    		$this->db->where('status', '0');
	    		$query=$this->db->get();
	    		if($query->num_rows()>0){
	    			$set=array('user_id'=>$userID);
	    			if($total_question>0){
	    				$set['total_question']=$total_question;
	    			}
	    			if($correct_answer>0){
	    				$set['correct_answer']=$correct_answer;
	    			}
	    			if($total_cash>0){
	    				$set['total_cash']=$total_cash;
	    			}
		    		$this->db->where('user_id', $userID);
		    		$this->db->where('ads_id', $ads_id);
		    		$this->db->where('status', '0');
		    		$this->db->update('tbl_clicked_ads', $set);
		    		if($this->db->affected_rows() > 0){
		        		return true;
		        	}
	    		}else{
	    			$this->db->insert('tbl_clicked_ads', array(
			            'user_id' => $userID,
			            'ads_id' => $ads_id,
			            'total_question' => $total_question,
			            'correct_answer' => $correct_answer,
			            'total_cash' => $total_cash,
			            'status' => '0',
			            'date_clicked' => $createdDate
			        ));
			        if($this->db->affected_rows() > 0){
		        		return true;
		        	}else{
		        		return ErrorMsg($this->db->_error_message());
		        	}
	    		}
	    	}
    	}

    	public function load_ads_questions($ads_id, $userID, $start, $limit){
    		$result=array(); $res=array();
    		$exist="0";
    		$check_status=$this->check_ads_balance($ads_id);
    		$has_commission=$check_status['has_commission'];
    		$has_bonus=$check_status['has_bonus'];
    		$this->db->select('id');
    		$this->db->from('tbl_user_answers');
    		$this->db->where('ads_id', $ads_id);
    		$this->db->where('user_id', $userID);
    		$this->db->where('answer!=', '');
    		$this->db->where('status', '0');
    		$query1=$this->db->get();
    		if($query1->num_rows()>0){
    			$exist="1";
    		}else{
    			$this->db->select('id, question, answers, is_bonus');
	    		$this->db->from('tbl_questions');
	    		$this->db->where('ads_id', $ads_id);
	    		$this->db->where('status', '0');
	    		$this->db->order_by('createdDate', 'ASC');
	    		if($limit>0 && $start!=""){
		    		$this->db->limit($limit, $start-1);
		    	}
	    		$query=$this->db->get();
	    		if($query->num_rows()>0)
	    			$res=$query->result();
    		}
    		$result['has_commission']=$has_commission;
    		$result['has_bonus']=$has_bonus;
    		$result['exist']=$exist;
    		$result['questions']=$res;
    		return $result;
    	}

    	public function load_ads__user_answers($ads_id, $userID){
    		$result=array(); $res=array();
    		$earned=0;
    		$this->db->select('total_cash');
    		$this->db->from('tbl_clicked_ads');
    		$this->db->where('ads_id', $ads_id);
    		$this->db->where('user_id', $userID);
    		$this->db->where('status', '0');
    		$query=$this->db->get();
    		if($query->num_rows()>0){
    			foreach ($query->result_array() as $data) {
    				$earned=$data['total_cash'];
    			}
    		}
    		$this->db->select('question, answer, is_correct');
    		$this->db->from('tbl_user_answers');
    		$this->db->join('tbl_questions', 'tbl_questions.id=tbl_user_answers.question_id');
    		$this->db->where('tbl_user_answers.ads_id', $ads_id);
    		$this->db->where('tbl_user_answers.user_id', $userID);
    		$this->db->where('tbl_user_answers.status', '0');
    		$query1=$this->db->get();
    		if($query1->num_rows()>0)
    			$res=$query1->result();

    		$result['earned']=$earned;
    		$result['answers']=$res;
    		return $result;
    	}

    	public function get_total_questions($ads_id){
    		$this->db->select('id');
    		$this->db->from('tbl_questions');
    		$this->db->where('ads_id', $ads_id);
    		$this->db->where('is_bonus', '0');
    		$this->db->where('status', '0');
    		$query=$this->db->get();
    		$result=$query->num_rows();
    		return $result;
    	}

    	public function get_total_bonuses($ads_id){
    		$this->db->select('id');
    		$this->db->from('tbl_questions');
    		$this->db->where('ads_id', $ads_id);
    		$this->db->where('is_bonus', '1');
    		$this->db->where('status', '0');
    		$query=$this->db->get();
    		$result=$query->num_rows();
    		return $result;
    	}

    	public function get_ads_question_time($ads_id){
    		$timer="";
    		$this->db->select('question_timer');
    		$this->db->from('tbl_ads');
    		$this->db->where('id', $ads_id);
    		$this->db->where('status', '0');
    		$query=$this->db->get();
    		if($query->num_rows()>0){
    			foreach ($query->result_array() as $data) {
    				$timer=$data['question_timer'];
    			}
    		}
    		return $timer;
    	}

    	public function get_ads_question_price($ads_id){
    		$price=array();
    		$total_bonus_allocated=0; $cost=0; $bonus=0; $budget_allocated=0;
    		$this->db->select('cost_per_click, bonus, total_bonus_allocated, budget_allocated');
    		$this->db->from('tbl_ads');
    		$this->db->where('id', $ads_id);
    		$this->db->where('status', '0');
    		$query=$this->db->get();
    		if($query->num_rows()>0){
    			foreach ($query->result_array() as $data) {
    				$budget_allocated=$data['budget_allocated'];
    				$cost=$data['cost_per_click'];
    				$total_bonus_allocated=$data['total_bonus_allocated'];
    				$bonus=$data['bonus'];
    			}
    		}
    		$price['budget_allocated']=$budget_allocated;
    		$price['cost']=$cost;
    		$price['total_bonus_allocated']=$total_bonus_allocated;
    		$price['bonus']=$bonus;
    		return $price;
    	}

    	public function get_ads_used_price($ads_id){
    		$price = array();
    		$cost = 0; 
    		$bonus = 0;
    		$this->db->select('amount_earned, is_bonus');
    		$this->db->from('tbl_user_answers');
    		$this->db->where('ads_id', $ads_id);
    		$this->db->where('status', '0');
    		$query = $this->db->get();
    		if($query->num_rows() > 0){
    			foreach ($query->result_array() as $data) {
    				$amount_earned = (float)($data['amount_earned'] ?? 0);
    				if($data['is_bonus'] == '1'){
    					$bonus = $bonus + $amount_earned;
    				}else{
    					$cost = $cost + $amount_earned;
    				}
    			}
    		}
    		$price['used_question_price'] = $cost;
    		$price['used_bonus_price'] = $bonus;
    		return $price;
    	}

    	public function get_user_ads_current_time($ads_id, $userID){
    		$timer = 0; 
    		$start_timer = "";
    		$current_time = time();
    		if(!empty($userID) && !empty($ads_id)){
	    		$this->db->select('question_start_time');
	    		$this->db->from('tbl_user_ads_record');
	    		$this->db->where('ads_id', $ads_id);
	    		$this->db->where('user_id', $userID);
	    		$this->db->where('status', '0');
	    		$query = $this->db->get();
	    		if($query->num_rows() == 0){
	    			$this->db->insert('tbl_user_ads_record', array(
			            'user_id' => $userID,
			            'ads_id' => $ads_id,
			            'question_start_time' => date("Y-m-d H:i:s"),
			            'status' => '0'
			        ));
	    		}
	    		$this->db->select('question_start_time');
	    		$this->db->from('tbl_user_ads_record');
	    		$this->db->where('ads_id', $ads_id);
	    		$this->db->where('user_id', $userID);
	    		$this->db->where('status', '0');
	    		$query = $this->db->get();
	    		if($query->num_rows() > 0){
	    			foreach ($query->result_array() as $data) {
	    				$start_timer = $data['question_start_time'];
	    			}
	    		}
	    		if($start_timer != ""){
	    			$timer = timeDiffInMin(strtotime($start_timer), $current_time);
	    		}
    		}
    		return $timer;
    	}

    	public function check_ads_balance($ads_id){
    		$status = array(); 
    		$has_cost = false; 
    		$has_bonus = false;
    		$total_price = $this->get_ads_question_price($ads_id);
    		$budget_allocated = (float)($total_price['budget_allocated'] ?? 0);
    		$single_question_price = (float)($total_price['cost'] ?? 0);
    		$total_bonus_allocated = (float)($total_price['total_bonus_allocated'] ?? 0);
    		$single_bonus_price = (float)($total_price['bonus'] ?? 0);

    		$used_price = $this->get_ads_used_price($ads_id);
    		$used_question_price = (float)($used_price['used_question_price'] ?? 0);
    		$used_bonus_price = (float)($used_price['used_bonus_price'] ?? 0);

    		if(($budget_allocated - $used_question_price) < $single_question_price && $budget_allocated > 0){
    			$this->db->set('ads_status', '0');
	    		$this->db->where('id', $ads_id);
	    		$this->db->where('status', '0');
	    		$this->db->update('tbl_ads');
    		}else{
    			$has_cost = true;
    		}

    		if($total_bonus_allocated > 0 && ($total_bonus_allocated - $used_bonus_price) >= $single_bonus_price){
    			$has_bonus = true;
    		}
    		$status['has_commission'] = $has_cost;
    		$status['has_bonus'] = $has_bonus;
    		return $status;
    	}

    	public function submit_ads_answers($data, $userID){
    		if(empty($userID)){
    			return ErrorMsg('Tafadhali ingia kwenye akaunti yako kuwasilisha majibu.');
    		}

    		$createdDate = date("Y-m-d H:i:s");
    		$ads_id = $data['ads'] ?? '';
    		if(empty($ads_id)){
    			return ErrorMsg('Ad identifier missing.');
    		}

    		$question_time = (int)($data['question_time'] ?? 2);
    		$total_questions = (int)($data['total_questions'] ?? 0);
    		$total_bonuses = (int)($data['bonuses'] ?? 0);

    		$user_question_time = $this->get_user_ads_current_time($ads_id, $userID);

    		$total_price = $this->get_ads_question_price($ads_id);
    		$budget_allocated = (float)($total_price['budget_allocated'] ?? 0);
    		$total_question_price = (float)($total_price['cost'] ?? 0);
    		$total_bonus_allocated = (float)($total_price['total_bonus_allocated'] ?? 0);
    		$total_bonus_price = (float)($total_price['bonus'] ?? 0);

    		$used_price = $this->get_ads_used_price($ads_id);
    		$used_question_price = (float)($used_price['used_question_price'] ?? 0);
    		$used_bonus_price = (float)($used_price['used_bonus_price'] ?? 0);

    		if(($budget_allocated - $used_question_price) < $total_question_price && $budget_allocated > 0){
    			return ErrorMsg('Sorry! Insufficient amount allocated. Please refresh the page and try other ads.');
    		}

    		if($total_bonus_allocated > 0 && ($total_bonus_allocated - $used_bonus_price) < $total_bonus_price){
    			return ErrorMsg('Sorry! Insufficient bonus amount allocated. Please refresh the page and try again.');
    		}

    		$qn_answer_price = ($total_questions > 0) ? ($total_question_price / $total_questions) : $total_question_price;
    		$bonus_answer_price = ($total_bonuses > 0) ? ($total_bonus_price / $total_bonuses) : 0;

    		if($question_time <= 0 || ($question_time - $user_question_time) >= 0){
    			$success = 0;
    			$total_amount_earned = 0;
    			$correct_ans_count = 0;
    			$total_items = $total_questions + $total_bonuses;
    			if($total_items <= 0) $total_items = 10;

    			for ($i = 1; $i <= $total_items; $i++) {
    				if(isset($data['answer'.$i]) && $data['answer'.$i] !== ""){
    					$answer = trim($data['answer'.$i]);
    					$question = $data['question'.$i] ?? '';
    					$is_bonus = $data['is_bonus'.$i] ?? '0';
    					$correct_answer = "";
    					$is_correct = 0;
    					$amount_earned = 0;

    					$this->db->select('correct_answer');
    					$this->db->from('tbl_questions');
    					$this->db->where('ads_id', $ads_id);
    					$this->db->where('id', $question);
    					$this->db->where('status', '0');
    					$query1 = $this->db->get();
    					if($query1->num_rows() > 0){
    						$qRow = $query1->row_array();
    						$correct_answer = trim($qRow['correct_answer'] ?? '');
    					}

    					if(strcasecmp($answer, $correct_answer) === 0){
    						$correct_ans_count++;
    						$is_correct = 1;
    						if($is_bonus == '1'){
    							$amount_earned = $bonus_answer_price;
    						}else{
    							$amount_earned = $qn_answer_price;
    						}
    						$total_amount_earned += $amount_earned;
    					}

    					$this->db->select('id');
    					$this->db->from('tbl_user_answers');
    					$this->db->where('ads_id', $ads_id);
    					$this->db->where('user_id', $userID);
    					$this->db->where('question_id', $question);
    					$this->db->where('status', '0');
    					$query = $this->db->get();

    					if($query->num_rows() == 0){
    						$set = $this->db->insert('tbl_user_answers', array(
    							'user_id' => $userID,
    							'ads_id' => $ads_id,
    							'question_id' => $question,
    							'answer' => $answer,
    							'is_bonus' => $is_bonus,
    							'is_correct' => $is_correct,
    							'amount_earned' => $amount_earned,
    							'answered_date' => $createdDate,
    							'status' => '0'
    						));
    						if($set){
    							$success++;
    						}
    					}
    				}
    			}

    			if($success >= $total_questions || $success > 0){
    				$this->update_clicked_ads($ads_id, $userID, $total_questions, $correct_ans_count, $total_amount_earned);
    				
    				$this->db->select('id');
    				$this->db->from('tbl_transaction_records');
    				$this->db->where('ads_id', $ads_id);
    				$this->db->where('user_id', $userID);
    				$this->db->where('transaction_type', 'commission');
    				$this->db->where('status', '0');
    				$query = $this->db->get();

    				if($query->num_rows() == 0 && $total_amount_earned > 0){
    					$this->db->insert('tbl_transaction_records', array(
    						'transaction_type' => 'commission',
    						'user_id' => $userID,
    						'ads_id' => $ads_id,
    						'credit' => $total_amount_earned,
    						'is_complete' => '0',
    						'status' => '0',
    						'createdBy' => $userID,
    						'createdDate' => $createdDate
    					));
    				}
    				$this->check_ads_balance($ads_id);
    				return 'Success';
    			}else{
    				return ErrorMsg('Failed! Please try again or contact our support team.');
    			}
    		}else{
    			return ErrorMsg('Uko nje ya muda wa kujibu hili swali, tafadhali jaribu kujibu swali lingine.');
    		}
    	}

    	public function send_contact_message($data){
			$name=$data['name'];
			$phone=$data['phone'];
			$email=$data['email'];
			$message=$data['message'];
			$this->load->helper('email');
			$from_title='Contact - Message';
			$from_email="reply@24ads.co";
			if($email!=""){
				$from_email=$email;
			}
			
			$to='info@24ads.co';
			$subject="Contact Message - From ".$name;
			$sendE=sendQuickEmail($subject, $message, $from_title, $from_email, $to, "");
			if($sendE=="sent"){
				return SuccessMsg("Thank you for contacting us, we received your message.");
			}else{
				// return ErrorMsg("Failed to send email (".$sendE.")");
				return ErrorMsg("Failed to send message! please use another method to contact us or try gain.");
			}
		}

    	public function load_search_result($keyword){
			$result=array();
		   	$cond="";
		   	if($keyword!="")
		   		$cond.=' AND (title LIKE "%'.$keyword.'%" OR contents LIKE "%'.$keyword.'%" OR url LIKE "%'.$keyword.'%" OR cost_per_click LIKE "%'.$keyword.'%" OR business_name LIKE "%'.$keyword.'%")';
		   	
	   		$query = $this->db->query("SELECT tbl_ads.id, business_name, title, url, banner, cost_per_click FROM `tbl_ads` JOIN tbl_business_info ON tbl_business_info.id=tbl_ads.business_id WHERE tbl_ads.status='0' AND tbl_business_info.status='0' AND ads_status='1' $cond");
	   		if($query->num_rows() > 0)
		   	$result = $query->result();
		   	return $result;
		}

    }
?>