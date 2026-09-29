<?php
	if(!defined('BASEPATH')) exit('No direct script access allowed');

	function sendQuickEmail($subject, $msg, $from_title, $from_email, $to, $cc="admission@cbe.ac.tz"){
		$ci =& get_instance();
		$ci->load->config('email');
        $ci->load->library('email');

        /*email header*/
        $headers='From: $from_email \r\n';
		$headers.='Reply-To: $from_email\r\n';
		$headers.='X-Mailer: PHP/' . phpversion().'\r\n';
		$headers.= 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=iso-8859-1 \r\n';
		$headers.= "BCC: $cc";
		$headers.= "CC: $cc";
        /*end of email header*/

        /*mail body*/
		$headers = "From: $from_email\r\n" . "X-Mailer: php"; //mail headers
		if(mail($to, $subject, $msg, $headers)){
			return "sent";
		}else {
			return "Email failed";
		}
        /*end of mail body*/
        
        /*$from = $this->config->item('smtp_user');
        $to = $this->input->post('to');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }*/
	}
?>