<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Personal_model extends CI_Model{

	    public function __construct(){
	        parent::__construct();
	        $this->load->database();
        	$this->userToken=$this->session->userdata('24ads_user_idetification');
    	}

    	public function load_ads_history($userID, $limit){
    		$result=array();
    		$this->db->select('tbl_ads.id, tbl_ads.title, tbl_ads.banner, tbl_business_info.business_name, tbl_clicked_ads.total_question, tbl_clicked_ads.correct_answer, tbl_clicked_ads.total_cash, tbl_clicked_ads.date_clicked');
    		$this->db->from('tbl_clicked_ads');
    		$this->db->join('tbl_ads', 'tbl_ads.id=tbl_clicked_ads.ads_id');
            $this->db->join('tbl_business_info', 'tbl_business_info.id=tbl_ads.business_id', 'left');
            $this->db->where('tbl_clicked_ads.user_id', $userID);
    		$this->db->where('tbl_clicked_ads.status', '0');
    		$this->db->order_by('tbl_clicked_ads.date_clicked', 'DESC');
            if($limit>0){
                $this->db->limit($limit);
            }
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result();
    		return $result;
    	}

        public function load_ads_bonus($userID){
            $result=array();
            $this->db->select('question, answer, amount_earned, answered_date');
            $this->db->from('tbl_user_answers');
            $this->db->join('tbl_questions', 'tbl_questions.id=tbl_user_answers.question_id');
            $this->db->where('tbl_user_answers.user_id', $userID);
            $this->db->where('tbl_user_answers.is_correct', '1');
            $this->db->where('tbl_user_answers.is_bonus', '1');
            $this->db->where('tbl_user_answers.status', '0');
            $this->db->order_by('answered_date', 'DESC');
            $query=$this->db->get();
            if($query->num_rows()>0)
                $result=$query->result();
            return $result;
        }

        public function get_clicked_ads($userID){
            $result=0;
            $correct_answers=0; $incorrect_answers=0;
            $this->db->select('id');
            $this->db->from('tbl_clicked_ads');
            $this->db->where('user_id', $userID);
            $this->db->where('status', '0');
            $query=$this->db->get();
                $result=$query->num_rows();
            return $result;
        }

        public function get_answers_stats($userID){
            $result=array();
            $correct_answers=0; $incorrect_answers=0;
            $this->db->select('is_correct');
            $this->db->from('tbl_user_answers');
            $this->db->where('user_id', $userID);
            $this->db->where('status', '0');
            $query=$this->db->get();
            if($query->num_rows()>0){
                foreach ($query->result_array() as $data) {
                    $is_correct=$data['is_correct'];
                    if($is_correct=='1'){
                        $correct_answers++;
                    }
                    if($is_correct=='0'){
                        $incorrect_answers++;
                    }
                }
            }
            $result['correct_answers']=$correct_answers;
            $result['incorrect_answers']=$incorrect_answers;
            return $result;
        }

        public function load_transaction_records($userID){
            $result=array();
            $this->db->select('transaction_type, credit, debit, is_complete, createdDate');
            $this->db->from('tbl_transaction_records');
            $this->db->where('user_id', $userID);
            $this->db->where('is_complete', '0');
            $this->db->where('status', '0');
            $this->db->order_by('createdDate', 'ASC');
            $query=$this->db->get();
            if($query->num_rows()>0)
                $result=$query->result();
            return $result;
        }

        public function load_withdraw_records($userID){
            $result=array();
            $this->db->select('requestID, amount, is_processed, rejection_reason, createdDate, rejected_date');
            $this->db->from('tbl_withdrawal');
            $this->db->where('user_id', $userID);
            $this->db->where('status', '0');
            $this->db->order_by('createdDate', 'DESC');
            $query=$this->db->get();
            if($query->num_rows()>0)
                $result=$query->result();
            return $result;
        }

        public function load_withdraw_info($userID, $requestID){
            $result=array();
            $this->db->select('requestID, amount');
            $this->db->from('tbl_withdrawal');
            $this->db->where('user_id', $userID);
            $this->db->where('requestID', $requestID);
            $this->db->where('status', '0');
            $this->db->order_by('createdDate', 'DESC');
            $query=$this->db->get();
            if($query->num_rows()>0)
                $result=$query->result_array();
            return $result;
        }

        public function get_transaction_summary($userID){
            $result=array();
            $total_commission=0; $total_withdraw=0; $total_charge=0;
            $this->db->select('transaction_type, credit, debit');
            $this->db->from('tbl_transaction_records');
            $this->db->where('user_id', $userID);
            $this->db->where('is_complete', '0');
            $this->db->where('status', '0');
            $query=$this->db->get();
            if($query->num_rows()>0){
                foreach ($query->result_array() as $data) {
                    $transaction_type = $data['transaction_type'];
                    $credit = (float)($data['credit'] ?? 0);
                    $debit = (float)($data['debit'] ?? 0);
                    if($transaction_type == 'commission'){
                        $total_commission += $credit;
                    }
                    if($transaction_type == 'withdraw'){
                        $total_withdraw += $debit;
                    }
                    if($transaction_type == 'charge'){
                        $total_charge += $debit;
                    }
                }
            }
            $result['total_commission']=$total_commission;
            $result['total_withdraw']=$total_withdraw;
            $result['total_charge']=$total_charge;
            return $result;
        }

    	public function load_account_info($userID){
    		$result=array();
    		$this->db->select('id, accountID, payment_method, account_number, account_name, operator, country, country_code, currency');
    		$this->db->from('tbl_personal_account');
    		$this->db->where('user_id', $userID);
    		$this->db->where('status', '0');
    		$query=$this->db->get();
    		if($query->num_rows()>0)
    			$result=$query->result_array();
    		return $result;
    	}

    	public function save_account_info($data, $userID){
    		$accountID=$data['accountID'];
    		$payment_method=$data['payment_method'];
    		$operator=$data['operator'];
    		$country_code=$data['country_code'];
            $phone_number=$data['phone_number'];
            $account_name=$data['account_name'];
            $country=$data['country'];
            $currency=$data['currency'];
            $account_number=$phone_number;
    		$this->db->select('id');
    		$this->db->from('tbl_personal_account');
    		$this->db->where('user_id', $userID);
    		$this->db->where('status', '0');
    		$query=$this->db->get();
    		if($query->num_rows()>0){
                $set=array(
                    'payment_method' => $payment_method,
                    'account_number' => $account_number,
                    'account_name' => $account_name,
                    'operator' => $operator,
                    'country' => $country,
                    'country_code' => $country_code,
                    'currency' => $currency,
                );
                $this->db->where('user_id', $userID);
                $this->db->where('status', '0');
                $this->db->update('tbl_personal_account', $set);
                return 'Success';
            }else{
    			$set=$this->db->insert('tbl_personal_account', array(
		            'user_id' => $userID,
		            'accountID' => $accountID,
		            'payment_method' => $payment_method,
		            'account_number' => $account_number,
		            'account_name' => $account_name,
		            'operator' => $operator,
		            'country' => $country,
                    'country_code' => $country_code,
                    'currency' => $currency,
                    'account_status' => '1',
		            'createdDate' => date("Y-m-d H:i:s"),
		            'status' => '0'
		        ));
		        if($set){
		        	return 'Success';
		        }else{
                    return ErrorMsg($this->db->_error_message());
                }
    		}
    	}

        public function save_withdraw_request($data, $userID){
            $requestID=$data['requestID'];
            $amount=$data['amount'];

            $summary=$this->get_transaction_summary($userID);
            $balance=$summary['total_commission']-($summary['total_withdraw']+$summary['total_charge']);
            if($amount>($balance-1534)){
                die(ErrorMsg('Insufficient balance, the requested amount should not be above '.($balance-1534).' TZS'));
            }
            $this->db->select('id');
            $this->db->from('tbl_withdrawal');
            $this->db->where('requestID', $requestID);
            $this->db->where('user_id', $userID);
            $this->db->where('status', '0');
            $query=$this->db->get();
            if($query->num_rows()>0){
                $withdraw_id="";
                foreach ($query->result_array() as $rows) {
                    $withdraw_id=$rows['id'];
                }
                $set=array(
                    'amount' => $amount
                );
                $this->db->where('requestID', $requestID);
                $this->db->where('user_id', $userID);
                $this->db->where('status', '0');
                $this->db->update('tbl_withdrawal', $set);

                if($withdraw_id!=""){
                    $this->db->set('debit', $amount);
                    $this->db->where('withdraw_id', $withdraw_id);
                    $this->db->where('user_id', $userID);
                    $this->db->where('status', '0');
                    $this->db->where('transaction_type', 'withdraw');
                    $this->db->update('tbl_transaction_records');
                }
                return 'Success';
            }else{
                $set=$this->db->insert('tbl_withdrawal', array(
                    'user_id' => $userID,
                    'requestID' => $requestID,
                    'amount' => $amount,
                    'is_processed' => '1',
                    'status' => '0',
                    'createdBy' => $userID,
                    'createdDate' => date("Y-m-d H:i:s")
                ));

                if($set){
                    $withdraw_id="";
                    $this->db->select('id');
                    $this->db->from('tbl_withdrawal');
                    $this->db->where('requestID', $requestID);
                    $this->db->where('user_id', $userID);
                    $this->db->where('status', '0');
                    $query1=$this->db->get();
                    if($query1->num_rows()>0){
                        foreach ($query1->result_array() as $rows) {
                            $withdraw_id=$rows['id'];
                        }
                    }
                    if($withdraw_id!=""){
                        $this->db->insert('tbl_transaction_records', array(
                            'transaction_type' => 'withdraw',
                            'user_id' => $userID,
                            'withdraw_id' => $withdraw_id,
                            'debit' => $amount,
                            'is_complete' => '1',
                            'status' => '0',
                            'createdBy' => $userID,
                            'createdDate' => date("Y-m-d H:i:s")
                        ));

                        $this->db->insert('tbl_transaction_records', array(
                            'transaction_type' => 'charge',
                            'user_id' => $userID,
                            'withdraw_id' => $withdraw_id,
                            'debit' => 1534,
                            'is_complete' => '1',
                            'status' => '0',
                            'createdBy' => $userID,
                            'createdDate' => date("Y-m-d H:i:s")
                        ));
                        
                        if($this->db->affected_rows() > 0){
                            return 'Success';
                        }else{
                            return ErrorMsg($this->db->_error_message());
                        }
                    }else{
                        return ErrorMsg('Failed! try again or contact our support team.');
                    }
                }else{
                    return ErrorMsg($this->db->_error_message());
                }
            }
        }

    }
?>