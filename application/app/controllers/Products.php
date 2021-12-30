<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Products extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Master_model','master');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('logout','refresh');
		}
	}
	//ADD PRODUCT
	public function new_product(){
		if($this->input->post()){
			$product = $this->input->post();
			//echo "<pre>";print_r($product);exit;
			if (!empty($_FILES['product_image']['name'])) {
				$config['upload_path'] = './upload/';
				$config['file_name'] = time().$_FILES["product_image"]['name'];
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('product_image')){ 
					$filename 	=  str_replace(" ","_",$config['file_name']);
				}else{
					$this->data['error'] = array('error' => $this->upload->display_errors());
				}
			}else{
				$filename = '';
			}
			$product['product_image']	=	$filename;
			$product['created_on']	= created_on();
			$product['created_by'] = created_by();
			$product['status']		= 1;
			$product_id = $this->common->insert('mst_products',$product);
			if($product_id){
				if($product['product_opening_stock']!=""){
					$stock = array(
						'product_id	' => $product_id,
						'quantity'    => $product['product_opening_stock'],
						'created_on'  => created_on(),
						'created_by'  => created_by(),
						'status'      => 1 
					);
					$stock_id = $this->common->insert('tbl_stock',$stock);
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 16,
					'operation'			=> 'New Product Created',
					'operation_details'	=> 'New Product Created -'.$this->common->get_particular('mst_products',array( 'product_id' => $product_id),'product_name'),
					'product_id'		=> $product_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> 'Success',
					'message' 	=> 'Product Created Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> 'Failed',
					'message' 	=> 'Product Creating Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('product_list');
		}else{
			$this->template->build('products/product');
		}
	}

	//Product List
	public function product_list(){
		$data['lists'] = $this->common->gets_array('mst_products',array('status' => 1));
		//echo "<pre>";print_r($data);exit;
		$this->template->build('products/product_list',$data);
	}
	//PRODUCT EDIT
	public function product_edit($product_id){
		if($this->input->post()){
			$data = $this->input->post();
			if (!empty($_FILES['product_image']['name'])) {
				$config['upload_path'] 		= './upload/';
				$config['file_name'] 		= time().$_FILES["product_image"]['name'];
				$config['allowed_types'] 	= '*';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('product_image')){ 
					$data['product_image'] =  $config['file_name'];
				}else{
					$this->data['error'] = array('error' => $this->upload->display_errors());
				}
			}
			$data['updated_on']	= updated_on();
			$data['updated_by'] = created_by();
			$data['status']		= 1;
			$products_id = $this->common->update('mst_products',$data,array('product_id' => $product_id));
			if($products_id){
				if($data['product_opening_stock']!=""){
					$stock = array(
						'product_id	' => $product_id,
						'quantity'    => $data['product_opening_stock'],
						'updated_on'  => created_on(),
						'updated_by'  => created_by(),
						'status'      => 1 
					);
					$stock_id = $this->common->update('tbl_stock',$stock,array('product_id' => $product_id));
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'		=> $this->session->userdata('company_id'),
					'log_category_id'	=> 16,
					'operation'			=> 'Product Updated',
					'operation_details'	=> 'Product Updated Successfully-'.$this->common->get_particular('mst_products',array( 'product_id' => $product_id),'product_name'),
					'product_id'		=> $product_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> "Success",
					'message' 	=> 'Product Details Updated Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> "Failes",
					'message' 	=> 'Product Details Updated Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect ('product_list');
		}else{
			$data['products'] = $this->common->get_array('mst_products',array('product_id' => $product_id));
			//echo "<pre>";print_r($data);exit;
			$this->template->build('products/product',$data);
		}
	}
	//PRODUCT DELETE
	public function product_delete($product_id){
		$update['updated_on'] = updated_on();
		$update['updated_by'] = created_by();
		$update['status'] = 0;
		$response = $this->common->delete('mst_products',$update,array('product_id' => $product_id));
		if($response){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'			=> $this->session->userdata('company_id'),
				'log_category_id'	=> 16,
				'operation'			=> 'Product Deleted',
				'operation_details'	=> 'Product Deleted Successfully -'.$this->common->get_particular('mst_products',array( 'product_id' => $product_id),'product_name'),
				'product_id'		=> $product_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => $response['message']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('product_list'));
	}
	//PRODUCT POPUP
	public function product_popup(){
		if($this->input->post()){
			$product = $this->input->post();
			//echo "<pre>";print_r($product);exit;
			if(!empty($_FILES['product_image']['name'])){
				//upload script
				$product['product_image'] = '';
			} 
			if (!empty($_FILES['product_image']['name'])) {
				$config['upload_path'] = APPPATH.'../'.PRODUCT_IMAGE_FOLDER;
				$config['file_name'] = time().$_FILES["product_image"]['name'];
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('product_image')){
					$filename =  $config['file_name'];
				}else{
					$filename = '';
				}
			}else{
				$filename = '';
			}
			$product['created_on']	= created_on();
			$product['created_by'] = created_by();
			$product['status']		= 1;
			$product_id = $this->common->insert('mst_products',$product);
			if($product_id){
				if($product['product_opening_stock']!=""){
					$stock = array(
						'product_id	' => $product_id,
						'quantity'    => $product['product_opening_stock'],
						'created_on'  => created_on(),
						'created_by'  => created_by(),
						'status'      => 1 
					);
					$stock_id = $this->common->insert('tbl_stock',$stock);
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'			=> $this->session->userdata('company_id'),
					'log_category_id'	=> 16,
					'operation'			=> 'New Product Created',
					'operation_details'	=> 'New Product Created-'.$this->common->get_particular('mst_products',array( 'product_id' => $product_id),'product_name'),
					'product_id'		=> $product_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 		=> 'Success',
					'message' 		=> 'Product Created Successfully',
				);
				$product = $this->common->get_array('mst_products',array('product_id' => $product_id));
				$product['brand_name'] = $this->common->get_particular('mst_brands',array('brand_id' => $product['product_brand']),'brand_name');
				if($product){
					$product['product_detail']	= convert_options_selected($this->common->gets_array('mst_products'),'product_id','product_name','PRODUCT',$product['product_id']);
					$return = array(
						'result'	=>	'success',
						'message'	=>	'Product Creating Successfully',
						'product'	=>	$product
					);
				}else{
					$return = array(
						'result' => 'failed',
						'message' => 'customer details'
					);
				}
				echo json_encode($return);
			}else{
				$message = array(
					'result' 	=> 'Failed',
					'message' 	=> 'Product Creating Failed'
				);
				$this->session->set_userdata('msg',$message);
				echo json_encode($message);
			}
		}else{
			$html = $this->load->view('products/product_form',array(),true);
			echo $html;
		}
	}

	public function get_product_type_base_value(){
		$data = $this->input->post();
		$product_type_base_value = $this->common->get_particular('mst_product_type',array('product_type_id' => $data['product_type_id']),'product_type_base_value');
		echo json_encode(array('result' => 'success', 'product_type_base_value'=> $product_type_base_value));
	}
}