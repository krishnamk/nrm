<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyers_po extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Buyers_po_model','buyers_po');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}

	public function buyers_po_excel_list(){
		$data['lists'] = $this->buyers_po->get_buyers_po_excel_list();
		$this->template->build('buyers_po/buyers_po_list',$data);
	}

	public function buyers_po_excel_view($buyers_po_id){
		$data = $this->buyers_po->buyers_po_excel_view($buyers_po_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('buyers_po/buyers_po_excel_view',$data);
	}

	public function buyers_po_convert_into_quotation($buyers_po_id){
		$data = $this->buyers_po->buyers_po_excel_view($buyers_po_id);
		//echo "<pre>";print_r($data);//exit;
		$quotation_number = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'quotation_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'quotation_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
		if($data){
			$quotation = array(
				'company_id'						=>	$this->session->userdata('company_id'),
				'quotation_number'     				=>	$quotation_number,
				'quotation_date' 	  				=>	date('Y-m-d',strtotime($data['buyers_po_details']['date'])),
				'quotation_customer'   				=>	$data['buyers_po_details']['customer_id'],
				'quotation_employee'				=>	$this->session->userdata('user_id'),
				'quotation_approved'				=>	1,
				'quotation_cancel'					=>	0,
				'created_on'						=>	created_on(),
				'created_by'						=>	created_by(),
				'status'							=>	1
			);
			//echo "<pre>";print_r($quotation);//exit;
			$quotation_id = $this->common->insert('tbl_quotations',$quotation);
			if($quotation_id){
				$current_count = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'dc_prefix_count');
				$next_count = next_number($current_count);
				$this->common->update('company_details',array('dc_prefix_count' => $next_count ),array('company_id' => $this->session->userdata('company_id')));
				foreach ($data['relations'] as $key => $relation) {
					$product_detail = $this->common->get_array('mst_products',array('product_id' =>$relation['product_id']));
					$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
					$amount = $relation['product_purchase_price']*$relation['quantity'];
					$tax_total = ($amount) * $tax_percentage/100;
					if($this->common->get_particular('mst_quotation_settings',array('quotation_settings_name' => 'quotation_tax_included'),'quotation_settings_value')== 1){
						$total = $amount + $tax_total;
					}else{
						$total = $amount;
					}
					$relations = array(
						'quotation_id'			=> $quotation_id,
						'product_id'			=> $relation['product_id'],
						'product_name'			=> $relation['product_name'],
						'brand_name' 			=> $this->common->get_particular('mst_brands',array('brand_id' => $product_detail['product_brand']),'brand_name'),
						'category_name' 		=> $this->common->get_particular('mst_category',array('category_id' => $product_detail['product_category']),'category_name'),
						'subcategory_name' 		=> $this->common->get_particular('mst_subcategory',array('sub_category_id' => $product_detail['product_subcategory']),'sub_category_name'),
						'tax_name' 				=> $this->common->get_particular('mst_taxs',array('tax_id' => $product_detail['product_tax']),'tax_name'),
						'tax_percent'			=> $this->common->get_particular('mst_taxs',array('tax_id' => $product_detail['product_tax']),'tax_percentage'),
						'tax_total'				=> $tax_total,
						'quantity'				=> $relation['quantity'],
						'rate'					=> $relation['product_purchase_price'],
						'total'					=> $total,
						'created_on'			=> created_on(),
						'created_by'			=> created_by(),
						'status'				=> 1
					);
					//echo "<pre>";print_r($relations);exit;
					$quotation_relation_id = $this->common->insert('tbl_quotations_relation',$relations);
				}
				//IF DC GENERATE THEN STATUS UPDATE
				$update = array(
					'updated_on'	=> created_on(),
					'updated_by'	=> created_by(),
					'status'		=> 2,
				);
				$quotation_update_status = $this->common->update('tbl_buyers_po',$update,array('buyers_po_id' => $data['buyers_po_details']['buyers_po_id']));
				$message = array(
					'result' => 'success',
					'message' => 'Quotation generated successfully'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('quotation_view/'.$quotation_id));
			}else{
				$message = array(
					'result'	=> 'failed',
					'message'	=> 'Quotation generation failed'
				);
				$this->session->set_userdata('msg',$message);
				redirect(base_url('quotation_list'));
			}
		}
	}

	public function buyers_po_excel_print($buyers_po_id){
		$data = $this->buyers_po->buyers_po_excel_view($buyers_po_id);
		//echo "<pre>";print_r($data);exit;
		$html = $this->load->view('buyers_po/buyers_po_excel_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('BUYERS_PO_EXCEL_PRINT.pdf','I');
	}

	public function buyers_po_excel_upload(){
		if($this->input->post()){
			$data = $this->input->post();
			$date = $this->input->post('date');
			$customer_id = $this->input->post('customer_id');
			//echo "<pre>";print_r($data);exit;
			$path = 'uploads/';
			require_once APPPATH . "/third_party/excel/PHPExcel.php";
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'xlsx|xls';
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('stock_file')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$data = array('upload_data' => $this->upload->data());
			}
			//Buyers Po Added
			$buyer_po_details = array(
				'date' 			=> date('Y-m-d',strtotime($date)),
				'customer_id' 	=> $customer_id,
				'created_on' 	=> created_on(),
				'created_by' 	=> created_by(),
				'status' 		=> 1 
			);
			//echo "<pre>";print_r($buyer_po_details);exit;
			$buyers_po_id = $this->common->insert('tbl_buyers_po',$buyer_po_details);
			if(empty($error)){
				$final_result = false;
				if (!empty($data['upload_data']['file_name'])) {
					$import_xls_file = $data['upload_data']['file_name'];
				} else {
					$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;
				try {
					$object = PHPExcel_IOFactory::load($inputFileName);
					// size price
					foreach($object->getWorksheetIterator() as $worksheet){
						$highestRow = $worksheet->getHighestRow();
						$highestColumn = $worksheet->getHighestColumn();
						$stock_rows = array();
						for($row=2; $row <= $highestRow; $row++) {
							$vendor_sku				= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
							$size_name				= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
							$product_itemcode		= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
							$product_name 			= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
							$purchase_price			= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
							$quantity 				= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
							if(($size_name != '')&&($product_itemcode != '')&&($product_name != '')&&
								($quantity != "")){ 
								$size_id = $this->common->get_particular('mst_sizes',array('size_name' => $size_name),'size_id');
							if($size_id == ""){
								$size = array(
									'size_name' 		=> $size_name,
									'created_on'		=> created_on(),
									'created_by'		=> created_by(),
									'status'			=> 1
								);
								$size_id = $this->common->insert('mst_sizes',$size);
							}
							$product_id = $this->common->get_particular('mst_products',array('product_itemcode' => $product_itemcode),'product_id');
							if($product_id == ""){
								$update = array(
									'product_name' 				=> $product_name,
									'product_stylecode'			=> $vendor_sku,
									'product_itemcode' 			=> $product_itemcode,
									'product_purchase_price' 	=> $purchase_price,
									'product_size' 				=> $size_id,
									'created_on'				=> created_on(),
									'created_by'				=> created_by(),
									'status'					=> 1
								);
									//echo "<pre>";print_r($update);exit;
								$product_id = $this->common->insert('mst_products',$update);
								if($product_id){
									$stock = array(
										'product_id	' => $product_id,
										'quantity'    => $quantity,
										'created_on'  => created_on(),
										'created_by'  => created_by(),
										'status'      => 1 
									);
									$stock_id = $this->common->insert('tbl_stock',$stock);
									$log = array(
										'user_id'			=> $this->session->userdata('user_id'),
										'company_id'		=> $this->session->userdata('company_id'),
										'log_category_id'	=> 20,
										'operation'			=> 'New Product Created',
										'operation_details'	=> 'Product Excel Upload (Buyer Po) -'.$this->common->get_particular('mst_products',array( 'product_id' => $product_id),'product_name'),
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
								}
								$buyers_po_insert = array(
									'buyers_po_id'				=> $buyers_po_id,
									'product_id'				=> $product_id,
									'product_name' 				=> $product_name,
									'product_stylecode'			=> $vendor_sku,
									'product_itemcode' 			=> $product_itemcode,
									'product_purchase_price' 	=> $purchase_price,
									'product_size_id'			=> $size_id,
									'quantity'					=> $quantity,
									'size_name'					=> $size_name,
									'created_on'				=> created_on(),
									'created_by'				=> created_by(),
									'status'					=> 1
								);
								//echo "<pre>";print_r($update);exit;
								$buyers_po_relation_id = $this->common->insert('tbl_buyers_po_relation',$buyers_po_insert);
							}else{
								$buyers_po_insert = array(
									'buyers_po_id'				=> $buyers_po_id,
									'product_id'				=> $product_id,
									'product_name' 				=> $product_name,
									'product_stylecode'			=> $vendor_sku,
									'product_itemcode' 			=> $product_itemcode,
									'product_purchase_price' 	=> $purchase_price,
									'product_size_id'			=> $size_id,
									'quantity'					=> $quantity,
									'size_name'					=> $size_name,
									'created_on'				=> created_on(),
									'created_by'				=> created_by(),
									'status'					=> 1
								);
								//echo "<pre>";print_r($update);exit;
								$buyers_po_relation_id = $this->common->insert('tbl_buyers_po_relation',$buyers_po_insert);
							}
							if($buyers_po_relation_id ){
								$final_result = true;
							}
						} 
					} 
				}
				if(isset($final_result)){
					$message = array(
						'result' => 'success' ,
						'message' => 'Excel stock updated in stocks'
					);
				}else{ 
					$message = array(
						'result' => 'failed' ,
						'message' => 'Please check excel file rows'
					);
				}
			} catch (Exception $e) {
				$message = array(
					'result' => 'failed' ,
					'message' => 'Error loading file '.pathinfo($inputFileName, PATHINFO_BASENAME).' - '.$e->getMessage()
				);
			}
		}else{
			$message = array(
				'result' => 'failed' ,
				'message' => $error['error']
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('buyers_po_excel_upload'));
	}else{
		$data['customers'] 	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER');
		//echo "<pre>";print_r($data['customers']);exit;
		$this->template->build('buyers_po/excel_upload',$data);
	}
}


}