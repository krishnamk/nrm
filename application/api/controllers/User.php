<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model','user');
	}
	
	public function login(){
		$data = json_decode(file_get_contents('php://input'), true); //input to be json so we send data to RAW DATA.
		if(!empty($data)){
			$user_available = $this->user->user_available($data);
			if($user_available){
				$user_details = $this->user->get_user_details($data);
				if($user_details['status']== 1 ){
					$return = array(
						'is_login'		=> true,
						'user_id'		=> $user_details['user_id'],
						'user_name'		=> $user_details['user_name'],
						'access_level'	=> $user_details['access_level'],
						'message'		=> 'Login Successfully'
					);
				}else{
					$return = array(
						'is_login' => false,
						'message' 	=> 'Access Denied. Please Contact Admin'
					);
				}
			}else{
				$return = array(
					'is_login' => false,
					'message' 	=> 'Invalid username/password',
				);
			}
		}else{
			$return = array(
				'is_login' => false,
				'message' 	=> 'parameters are empty.',
			);
		}
		echo json_encode($return);
	}

	public function user_list(){
		$user_id = $this->input->get('user_id');
		if($user_id){
			$user_details = $this->user->user_details($user_id);
			//echo "<pre>";print_r($user_details);exit;
			if($user_details){
				$return = array(
					'is_listed' => true,
					'message' 	=> 'User details successfully Reterived.',
					'lists' 	=> $user_details
				);
			}else{
				$return = array(
					'is_listed' => true,
					'message' 	=> 'User details reterived failed.',
				);
			}
		}else{
			$return = array(
				'is_listed' => false,
				'message' 	=> 'parameters are empty.',
			);
		}
		echo json_encode($return);
	}

	
}
/* End of file User.php */
/* Location: ./application/controllers/User.php */