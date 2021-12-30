<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_return extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Purchase_model','purchase');
	}
	
	//PURCHASE RETURN VIEW
	public function purchase_return_view(){
		$data = $this->input->get();
		if(!empty($data)){
			$purchase_return_details=$this->purchase->get_purchase_return_details($data['purchase_return_id']);
			if($purchase_return_details){
				$return_value = array(
					'is_reterived' 	=> true,
					'message'		=>	'Purchase Return View Retrieved',
					'data'			=>	$purchase_return_details
				);
			}else{
				$return_value = array(
					'is_reterived' 	=> false,
					'message'		=>	'Purchase Return View Retrieved Failed',
				);
			}
		}else{
			$return_value = array(
				'is_reterived' => false,
				'message' 	=> 'parameters are empty.',
			);
		}
		echo json_encode($return_value);
	}
	//PURCHASE RETURN LIST
	public function purchase_return_list(){
		$per_page_limit = 10;
		$page = $this->input->get('page');
		$total_rows = $this->common->count('tbl_purchase_return','status!=0');
		$current_page = isset($page) ? $page : 1;
		if($total_rows!=""){
			if($total_rows>10){
				if($current_page==1){
					$start = $current_page;
				}else{
					$start = (($current_page-1) * $per_page_limit)+1;
				}
				if($current_page * $per_page_limit > $total_rows){
					$end = $total_rows;
				}else{
					$end = $current_page * $per_page_limit;
				}
				$data['pagination_des'] = "Showing ".($start)." to ".($end)." from ". $total_rows." results";
			}else{
				$start = $current_page;
				$data['pagination_des'] = "Showing ".($start)." to ".($total_rows)." from ". $total_rows." results";
			}
			$data = $this->purchase->get_purchase_return_lists($per_page_limit,$start-1);
			if($data){
				$return_value = array (
					'is_reterived' => true,
					'message'      => 'Purchase Return List successfully Reterived',
					'data'         =>  $data
				);
			}else{
				$return_value = array(
					'is_reterived' => false,
					'message'      => 'Purchase Return List reterived failed');
			}
		}else{
			$return_value = array(
				'is_reterived' => false,
				'message'      => 'Purchase Return List Empty');
		}
		echo json_encode($return_value);
	}
}