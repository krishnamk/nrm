<?php
class Sms {
	protected $CI;
	public function __construct(){
		$this->CI =& get_instance();
	}
	public function PromotionalSMS($mobile_numbers = array(),$message_content = "") {
		if(!empty($mobile_numbers)){
			foreach ($mobile_numbers as $key => $mobile_number) {
				if(substr($mobile_number,0,3) != "+91"){
					$mobile_numbers[$key] = "+91".$mobile_number;
				}
			}
		}
		$mobile = implode(',',$mobile_numbers);
		$message_content = urlencode($message_content);
		/*$url = 'http://promotion.ctrlnext.com/api/push.json?authkey='.$this->CI->config->item('promo_sms_api_key').'&mobileno='.$mobile.'&text='.$message_content.'&sender='.$this->CI->config->item('promo_sms_sender_id').'&route=1';*/
		$url = 'http://promotion.ctrlnext.com/api/push.json?apikey=5f86f3a5985fd&route=promo_dnd&sender=SRTCAR&mobileno=9600575803&text=HII';
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Cookie: __cfduid=d4558323a2bc09dae680a3c8983cbb5b71597819220; PHPSESSID=lgfhrc856cdjf1ksfc1pq11190"
			),
		));
		$response = curl_exec($curl);
		echo '<pre>';print_r($response);exit;
		curl_close($curl);
		return $response;
	}
	public function TransactionSms($mobile_numbers = array(),$message_content = "") {
		if(!empty($mobile_numbers)){
			foreach ($mobile_numbers as $key => $mobile_number) {
				if(substr($mobile_number,0,3) != "+91"){
					$mobile_numbers[$key] = "+91".$mobile_number;
				}
			}
		}
		$mobile = implode(',',$mobile_numbers);
		$message_content = urlencode($message_content);
		$url = 'http://sms.ctrlnext.com/api/sendhttp.php?authkey='.$this->CI->config->item('sms_api_key').'&mobiles='.$mobile.'&message='.$message_content.'&sender='.$this->CI->config->item('sms_sender_id').'&route=4';
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Cookie: __cfduid=d4558323a2bc09dae680a3c8983cbb5b71597819220; PHPSESSID=lgfhrc856cdjf1ksfc1pq11190"
			),
		));
		$response = curl_exec($curl);

		/*echo '<pre>';print_r($response);exit;*/
		curl_close($curl);
		return $response;
	}
	public function OtpSms($mobile_number = "",$message_content = "", $otp = "") {
		if($otp == ""){
			$otp = rand(1000,9999);
		}
		if(substr($mobile_number,0,3) != "+91"){
			$mobile_number = "+91".$mobile_number;
		}
		if($message_content == ""){
			$message_content = "Your verification code is ".$otp;
		}
		$message_content = urlencode($message_content);
		$url = 'http://sms.ctrlnext.com/api/otp.php?authkey='.$this->CI->config->item('sms_api_key').'&mobile='.$mobile_number.'&message='.$message_content.'&sender='.$this->CI->config->item('sms_sender_id').'&otp='.$otp;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Cookie: __cfduid=d4558323a2bc09dae680a3c8983cbb5b71597819220; PHPSESSID=lgfhrc856cdjf1ksfc1pq11190"
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	public function VerifyOtpSms($mobile_number = "",$otp = "") {
		 if(substr($mobile_number,0,3) != "+91"){
			$mobile_number = "+91".$mobile_number;
		} 
		$url = 'http://sms.ctrlnext.com/api/verifyRequestOTP.php?authkey='.$this->CI->config->item('sms_api_key').'&mobile='.$mobile_number.'&otp='.$otp;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Cookie: __cfduid=d4558323a2bc09dae680a3c8983cbb5b71597819220; PHPSESSID=lgfhrc856cdjf1ksfc1pq11190"
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	public function ResendOtpSms($mobile_number = "",$retrytype = "text") {
		 if(substr($mobile_number,0,3) != "+91"){
			$mobile_number = "+91".$mobile_number;
		} 
		$url = 'http://sms.ctrlnext.com/api/retryotp.php?authkey='.$this->CI->config->item('sms_api_key').'&mobile='.$mobile_number.'&retrytype='.$retrytype;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Cookie: __cfduid=d4558323a2bc09dae680a3c8983cbb5b71597819220; PHPSESSID=lgfhrc856cdjf1ksfc1pq11190"
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
}
?>