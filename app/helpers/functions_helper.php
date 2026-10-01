<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function recordTrails($table, $tableKey, $desc, $username=''){
        try {
            $ci =& get_instance();
            $ci->load->database();
            $actionDate=date('d-m-Y H:i:s');
            $data = array(
                'action_table' => $table,
                'primary_key_table' => $tableKey,
                'description' => $desc,
                'action_by' => $username,
                'action_date' => $actionDate
            );
            if ($ci->db->table_exists('z_audit_trails')) {
                $ci->db->insert('z_audit_trails', $data);
            }
        } catch (\Throwable $e) {
            log_message('error', 'recordTrails error: ' . $e->getMessage());
        }
    }

    function isTokenValid(){
        $token=$_SESSION['24ads_user_idetification'];
        $query=mysqli_query($GLOBALS['con'], "SELECT token FROM tbl_users WHERE token='$token'") or mysqli_error($GLOBALS['con']);
        if(mysqli_num_rows($query) > 0){
            return true;
        }else{
            return false;
        }
    }

    function getUserID($token){
        $user_id="";
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('id');
        $ci->db->where('token',$token);
        $ci->db->where('status', '0');
        $query = $ci->db->get('tbl_users');

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $data) {
                $user_id=$data['id'];
            }
        }
        return $user_id;
    }

    function getAdminUserID($token){
        $user_id="";
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('id');
        $ci->db->where('token',$token);
        $ci->db->where('status', '0');
        $query = $ci->db->get('tbl_admin');

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $data) {
                $user_id=$data['id'];
            }
        }
        return $user_id;
    }

    function getUserAvatar($userID){
        $user="default.png";
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('avatar');
        $ci->db->where('user_id',$userID);
        $query = $ci->db->get('tbl_user_info');

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $data) {
                if($data['avatar']!=""){
                    $user=$data['avatar'];
                }
            }
        }
        return $user;
    }

    function getAdminAvatar($userID){
        $user="default.png";
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('avatar');
        $ci->db->where('user_id',$userID);
        $query = $ci->db->get('tbl_admin');

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $data) {
                if($data['avatar']!=""){
                    $user=$data['avatar'];
                }
            }
        }
        return $user;
    }

    function loadCategories($category){
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('id');
        $ci->db->select('name');
        $ci->db->where('status', '0');
        $query = $ci->db->get('tbl_shop_category');

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $data) {
                if($category==$data['id']){
                    echo '<option value="'.$data['id'].'" selected>'.ucwords($data['name']).'</option>';
                }else{
                    echo '<option value="'.$data['id'].'">'.ucwords($data['name']).'</option>';
                }
            }
        }
    }

    function getCategoryName($category){
        $name="";
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('name');
        $ci->db->where('id',$category);
        $query = $ci->db->get('tbl_shop_category');

        if($query->num_rows() > 0){
            foreach ($query->result_array() as $data) {
                $name=$data['name'];
            }
        }
        return $name;
    }

    function generateRequestID(){
        $requestID=getRandomNumber(6);
        $valid=false;
        $ci =& get_instance();
        $ci->load->database();        
        while(!$valid){
            $ci->db->select('id');
            $ci->db->where('requestID', $requestID);
            $query = $ci->db->get('tbl_withdrawal');
            if($query->num_rows()==0){
                $valid=true;
            }else{
                $requestID=getRandomNumber(6);
            }
        }
        return $requestID;
    }

    function generateAccountID($type){
        $accountID=getRandomNumber(6);
        $valid=false;
        $ci =& get_instance();
        $ci->load->database();        
        while(!$valid){
            $ci->db->select('id');
            $ci->db->where('accountID', $accountID);
            if($type=='business'){
                $query = $ci->db->get('tbl_business_account');
            }else{
                $query = $ci->db->get('tbl_personal_account');
            }
            if($query->num_rows()==0){
                $valid=true;
            }else{
                $accountID=getRandomNumber(6);
            }
        }
        return $accountID;
    }

    function new_pageView($page){
        $ci =& get_instance();
        $ci->load->database();
        $counter=1;
        $page=trim($page);
        $ci->db->select('id, counter');
        $ci->db->from('site_views');
        $ci->db->where('page', $page);
        $ci->db->where('status', '0');
        
        $query = $ci->db->get();          
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $data) {
                $counter=$data['counter']+1;
                $ci->db->set('counter', $counter);
                $ci->db->where('status', '0');
                $ci->db->where('page', $page);
                $ci->db->update('site_views');
            }
        }else{
            $ci->db->insert('site_views', array(
                'page' => $page,
                'counter' => $counter,
                'status' => '0'
            ));
        }
        $browser=getUserBrowser();
        $ip_address=get_client_ip();
        $createdDate=date("d-m-Y h:i A");
        new_browser($browser);
        $ci->db->insert('site_views_meta', array(
            'page' => $page,
            'ip_address' => $ip_address,
            'browser' => $browser,
            'createdDate' => $createdDate,
            'status' => '0'
        ));
    }

    function new_browser($browser){
        $ci =& get_instance();
        $ci->load->database();
        $counter=1;
        $browser=trim($browser);
        $ci->db->select('id');
        $ci->db->from('site_browsers');
        $ci->db->where('browser', $browser);
        $ci->db->where('status', '0');
        
        $query = $ci->db->get();
        if($query->num_rows() > 0){
            
        }else{
            $ci->db->insert('site_browsers', array(
                'browser' => $browser,
                'status' => '0'
            ));
        }
    }

    function getUserBrowser(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $name = 'NA';
        if (preg_match('/MSIE/i', $agent) && !preg_match('/Opera/i', $agent)) {
            $name = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $agent)) {
            $name = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $agent)) {
            $name = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $agent)) {
            $name = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $agent)) {
            $name = 'Opera';
        } elseif (preg_match('/Netscape/i', $agent)) {
            $name = 'Netscape';
        } else{
            $name = 'Unknown';
        }
        return $name;
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function numberFormat($value){
        $val="";
        if($value!="" && is_numeric($value)){
            $val=number_format($value);
        }
        return $val;
    }

    function isLoggedIn(){
        if(isset($_SESSION['24ads_user_idetification']) && $_SESSION['24ads_user_idetification']!=""){
            return true;
        }else{
            return false;
        }
    }

?>