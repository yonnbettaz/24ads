<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->userToken = $this->session->userdata('24ads_user_idetification');
    }

    /**
     * Get business profile info by user ID
     */
    public function get_business_info($userID){
        $this->db->select('id, user_id, name, gender, business_name, business_phone, business_email, business_address, business_website, country, region, district, TIN, description, logo, avatar, status, createdDate');
        $this->db->from('tbl_business_info');
        $this->db->where('user_id', $userID);
        $this->db->where('status', '0');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }
        return array();
    }

    /**
     * Get statistics for a business
     */
    public function get_ads_stats($businessID){
        $stats = array(
            'total_ads' => 0,
            'active_ads' => 0,
            'pending_ads' => 0,
            'closed_ads' => 0,
            'denied_ads' => 0,
            'total_budget' => 0,
            'total_views' => 0,
            'total_spent' => 0,
            'remaining_budget' => 0
        );

        if(empty($businessID)){
            return $stats;
        }

        // Ads counts & budget
        $this->db->select('ads_status, budget_allocated');
        $this->db->from('tbl_ads');
        $this->db->where('business_id', $businessID);
        $this->db->where('status!=', '1');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $stats['total_ads'] = $query->num_rows();
            foreach ($query->result_array() as $row){
                $stats['total_budget'] += (float)($row['budget_allocated'] ?? 0);
                if($row['ads_status'] == '1'){
                    $stats['active_ads']++;
                }elseif($row['ads_status'] == '2'){
                    $stats['pending_ads']++;
                }elseif($row['ads_status'] == '0'){
                    $stats['closed_ads']++;
                }elseif($row['ads_status'] == '3'){
                    $stats['denied_ads']++;
                }
            }
        }

        // Clicks and spent
        $this->db->select('COUNT(tbl_clicked_ads.id) as click_count, SUM(tbl_clicked_ads.total_cash) as spent_sum');
        $this->db->from('tbl_clicked_ads');
        $this->db->join('tbl_ads', 'tbl_ads.id = tbl_clicked_ads.ads_id');
        $this->db->where('tbl_ads.business_id', $businessID);
        $this->db->where('tbl_clicked_ads.status', '0');
        $this->db->where('tbl_ads.status!=', '1');
        $queryClicks = $this->db->get();

        if($queryClicks->num_rows() > 0){
            $clickRow = $queryClicks->row_array();
            $stats['total_views'] = (int)($clickRow['click_count'] ?? 0);
            $stats['total_spent'] = (float)($clickRow['spent_sum'] ?? 0);
        }

        $stats['remaining_budget'] = max(0, $stats['total_budget'] - $stats['total_spent']);
        return $stats;
    }

    /**
     * Load ads for this business
     */
    public function load_ads($businessID, $limit = 0, $ads_status = ''){
        $result = array();
        if(empty($businessID)){
            return $result;
        }

        $this->db->select('tbl_ads.id, tbl_ads.business_id, tbl_ads.title, tbl_ads.url, tbl_ads.banner, tbl_ads.cost_per_click, tbl_ads.budget_allocated, tbl_ads.total_bonus_allocated, tbl_ads.bonus, tbl_ads.question_timer, tbl_ads.ads_status, tbl_ads.status, tbl_ads.date_uploaded, tbl_ads.contents, tbl_ads.rejected_reason, tbl_business_info.business_name');
        $this->db->from('tbl_ads');
        $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id AND tbl_business_info.status = "0"');
        $this->db->where('tbl_ads.business_id', $businessID);
        $this->db->where('tbl_ads.status!=', '1');

        if($ads_status !== '' && $ads_status !== null){
            $this->db->where('tbl_ads.ads_status', $ads_status);
        }

        $this->db->order_by('tbl_ads.date_uploaded', 'DESC');
        if($limit > 0){
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        if($query->num_rows() > 0){
            $adsList = $query->result();
            foreach($adsList as $ad){
                // Fetch metrics per ad
                $this->db->select('COUNT(id) as total_views, COALESCE(SUM(total_cash), 0) as total_spent, COALESCE(AVG(correct_answer), 0) as avg_score');
                $this->db->from('tbl_clicked_ads');
                $this->db->where('ads_id', $ad->id);
                $this->db->where('status', '0');
                $metrics = $this->db->get()->row_array();

                $ad->total_views = (int)($metrics['total_views'] ?? 0);
                $ad->total_spent = (float)($metrics['total_spent'] ?? 0);
                $ad->avg_score = round((float)($metrics['avg_score'] ?? 0), 1);

                // Fetch total questions
                $this->db->select('COUNT(id) as q_count');
                $this->db->from('tbl_questions');
                $this->db->where('ads_id', $ad->id);
                $this->db->where('status', '0');
                $qData = $this->db->get()->row_array();
                $ad->total_questions = (int)($qData['q_count'] ?? 0);

                $result[] = $ad;
            }
        }
        return $result;
    }

    /**
     * Load recent user clicks / interactions on this business's ads
     */
    public function load_ads_clicks($businessID, $limit = 10){
        $result = array();
        if(empty($businessID)){
            return $result;
        }

        $this->db->select('tbl_clicked_ads.id as click_id, tbl_clicked_ads.date_clicked, tbl_clicked_ads.total_question, tbl_clicked_ads.correct_answer, tbl_clicked_ads.total_cash, tbl_ads.id as ad_id, tbl_ads.title, tbl_ads.banner, tbl_personal_info.name as user_name, tbl_personal_info.avatar as user_avatar');
        $this->db->from('tbl_clicked_ads');
        $this->db->join('tbl_ads', 'tbl_ads.id = tbl_clicked_ads.ads_id');
        $this->db->join('tbl_personal_info', 'tbl_personal_info.user_id = tbl_clicked_ads.user_id', 'left');
        $this->db->where('tbl_ads.business_id', $businessID);
        $this->db->where('tbl_clicked_ads.status', '0');
        $this->db->where('tbl_ads.status!=', '1');
        $this->db->order_by('tbl_clicked_ads.date_clicked', 'DESC');
        if($limit > 0){
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        return $result;
    }

    /**
     * Load single ad details for business
     */
    public function load_ad_details($adID, $businessID){
        $this->db->select('tbl_ads.*, tbl_business_info.business_name');
        $this->db->from('tbl_ads');
        $this->db->join('tbl_business_info', 'tbl_business_info.id = tbl_ads.business_id');
        $this->db->where('tbl_ads.id', $adID);
        $this->db->where('tbl_ads.business_id', $businessID);
        $this->db->where('tbl_ads.status!=', '1');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }
        return array();
    }

    /**
     * Save new Ad campaign to tbl_ads and associated quiz questions to tbl_questions
     */
    public function save_ad($data, $userID, $businessID){
        $title = trim($data['title'] ?? '');
        $url = trim($data['url'] ?? '');
        $contents = trim($data['contents'] ?? '');
        $budget_allocated = (float)($data['budget_allocated'] ?? 0);
        $cost_per_click = (float)($data['cost_per_click'] ?? 0);
        $question_timer = (int)($data['question_timer'] ?? 2);
        $total_bonus_allocated = (float)($data['total_bonus_allocated'] ?? 0);
        $bonus = (float)($data['bonus'] ?? 0);

        if(empty($title)){
            return ErrorMsg('Please enter the campaign title.');
        }
        if(empty($contents)){
            return ErrorMsg('Please provide advertisement content/description.');
        }
        if($budget_allocated <= 0){
            return ErrorMsg('Please enter a valid budget amount in TZS.');
        }
        if($cost_per_click <= 0){
            return ErrorMsg('Please enter a valid reward/cost per view in TZS.');
        }
        if($cost_per_click > $budget_allocated){
            return ErrorMsg('Cost per view cannot exceed total allocated budget.');
        }

        // Upload Banner
        $bannerFile = "";
        unset($_SESSION['uploaded_file']);
        if(isset($_FILES['banner']) && !empty($_FILES['banner']['name'])){
            $upload_path = FCPATH . 'media/banner/';
            if(!is_dir($upload_path)){
                @mkdir($upload_path, 0777, true);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
            $config['max_size']      = 25600; // 25MB
            $ext = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
            $cleanTitle = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($title));
            $config['file_name']     = substr($cleanTitle, 0, 30) . '_' . date("dmY_His") . '.' . $ext;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('banner')){
                return ErrorMsg($this->upload->display_errors());
            }

            $fileData = $this->upload->data();
            $bannerFile = $fileData['file_name'];
        }else{
            return ErrorMsg('Please upload a campaign banner image.');
        }

        $createdDate = date("Y-m-d H:i:s");
        $adData = array(
            'business_id' => $businessID,
            'title' => $title,
            'url' => $url,
            'banner' => $bannerFile,
            'contents' => $contents,
            'budget_allocated' => $budget_allocated,
            'cost_per_click' => $cost_per_click,
            'total_bonus_allocated' => $total_bonus_allocated,
            'bonus' => $bonus,
            'question_timer' => $question_timer,
            'ads_status' => '2', // Pending admin approval
            'status' => '0',
            'date_uploaded' => $createdDate,
            'createdBy' => $userID
        );

        $set = $this->db->insert('tbl_ads', $adData);
        if(!$set){
            return ErrorMsg('Database error saving ad: ' . $this->db->_error_message());
        }
        $adID = $this->db->insert_id();

        // Process Quiz Questions
        if(isset($data['questions']) && is_array($data['questions'])){
            foreach($data['questions'] as $q){
                if(is_array($q) && !empty($q['text'])){
                    $qText = trim($q['text']);
                    $qAnswers = trim($q['answers'] ?? '');
                    $qCorrect = trim($q['correct'] ?? '');
                    $isBonus = (!empty($q['is_bonus']) && $q['is_bonus'] == '1') ? '1' : '0';

                    $this->db->insert('tbl_questions', array(
                        'ads_id' => $adID,
                        'question' => $qText,
                        'answers' => $qAnswers,
                        'correct_answer' => $qCorrect,
                        'is_bonus' => $isBonus,
                        'status' => '0',
                        'createdDate' => $createdDate,
                        'createdBy' => $userID
                    ));
                }
            }
        }

        return 'Success';
    }

    /**
     * Get transaction summary for business account
     */
    public function get_business_transaction_summary($businessID, $userID){
        $summary = array(
            'total_budget' => 0,
            'total_spent' => 0,
            'total_commission' => 0,
            'total_withdraw' => 0,
            'net_balance' => 0,
            'total_transactions' => 0
        );

        if(empty($businessID) && empty($userID)){
            return $summary;
        }

        // Budget from ads
        if(!empty($businessID)){
            $this->db->select('COALESCE(SUM(budget_allocated), 0) as total_budget');
            $this->db->from('tbl_ads');
            $this->db->where('business_id', $businessID);
            $this->db->where('status!=', '1');
            $budgetRow = $this->db->get()->row_array();
            $summary['total_budget'] = (float)($budgetRow['total_budget'] ?? 0);

            // Total spent rewarded to viewers
            $this->db->select('COALESCE(SUM(tbl_clicked_ads.total_cash), 0) as total_spent, COUNT(tbl_clicked_ads.id) as count_views');
            $this->db->from('tbl_clicked_ads');
            $this->db->join('tbl_ads', 'tbl_ads.id = tbl_clicked_ads.ads_id');
            $this->db->where('tbl_ads.business_id', $businessID);
            $this->db->where('tbl_clicked_ads.status', '0');
            $this->db->where('tbl_ads.status!=', '1');
            $spentRow = $this->db->get()->row_array();
            $summary['total_spent'] = (float)($spentRow['total_spent'] ?? 0);
        }

        // Transaction records count
        $this->db->select('COUNT(tbl_transaction_records.id) as total_tx');
        $this->db->from('tbl_transaction_records');
        $this->db->join('tbl_ads', 'tbl_ads.id = tbl_transaction_records.ads_id', 'left');
        if(!empty($businessID) && !empty($userID)){
            $this->db->where('(tbl_ads.business_id = ' . $this->db->escape($businessID) . ' OR tbl_transaction_records.user_id = ' . $this->db->escape($userID) . ')');
        }elseif(!empty($businessID)){
            $this->db->where('tbl_ads.business_id', $businessID);
        }elseif(!empty($userID)){
            $this->db->where('tbl_transaction_records.user_id', $userID);
        }
        $this->db->where('tbl_transaction_records.status', '0');
        $txRow = $this->db->get()->row_array();
        $summary['total_transactions'] = (int)($txRow['total_tx'] ?? 0);

        $summary['net_balance'] = max(0, $summary['total_budget'] - $summary['total_spent']);
        return $summary;
    }

    /**
     * Load transaction history for business
     */
    public function load_business_transactions($businessID, $userID, $limit = 0, $type = ''){
        $result = array();
        if(empty($businessID) && empty($userID)){
            return $result;
        }

        $this->db->select('tbl_transaction_records.id, tbl_transaction_records.transaction_type, tbl_transaction_records.credit, tbl_transaction_records.debit, tbl_transaction_records.is_complete, tbl_transaction_records.createdDate, tbl_transaction_records.ads_id, tbl_transaction_records.user_id, tbl_ads.title as ad_title, tbl_ads.banner as ad_banner, tbl_personal_info.name as recipient_name, tbl_personal_info.avatar as recipient_avatar, tbl_personal_info.phone as recipient_phone, tbl_personal_info.email as recipient_email');
        $this->db->from('tbl_transaction_records');
        $this->db->join('tbl_ads', 'tbl_ads.id = tbl_transaction_records.ads_id', 'left');
        $this->db->join('tbl_personal_info', 'tbl_personal_info.user_id = tbl_transaction_records.user_id', 'left');
        
        if(!empty($businessID) && !empty($userID)){
            $this->db->where('(tbl_ads.business_id = ' . $this->db->escape($businessID) . ' OR tbl_transaction_records.user_id = ' . $this->db->escape($userID) . ')');
        }elseif(!empty($businessID)){
            $this->db->where('tbl_ads.business_id', $businessID);
        }elseif(!empty($userID)){
            $this->db->where('tbl_transaction_records.user_id', $userID);
        }

        if(!empty($type)){
            $this->db->where('tbl_transaction_records.transaction_type', $type);
        }

        $this->db->where('tbl_transaction_records.status', '0');
        $this->db->order_by('tbl_transaction_records.createdDate', 'DESC');
        if($limit > 0){
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        return $result;
    }

    /**
     * Load single transaction details
     */
    public function load_business_transaction_details($transactionID, $businessID, $userID){
        $this->db->select('tbl_transaction_records.*, tbl_ads.title as ad_title, tbl_ads.banner as ad_banner, tbl_ads.cost_per_click, tbl_ads.budget_allocated, tbl_personal_info.name as recipient_name, tbl_personal_info.avatar as recipient_avatar, tbl_personal_info.phone as recipient_phone, tbl_personal_info.email as recipient_email');
        $this->db->from('tbl_transaction_records');
        $this->db->join('tbl_ads', 'tbl_ads.id = tbl_transaction_records.ads_id', 'left');
        $this->db->join('tbl_personal_info', 'tbl_personal_info.user_id = tbl_transaction_records.user_id', 'left');
        $this->db->where('tbl_transaction_records.id', $transactionID);
        $this->db->where('tbl_transaction_records.status', '0');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }
        return array();
    }
}
