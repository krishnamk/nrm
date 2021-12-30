<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_dc extends CI_Controller { 
	public function __construct(){
		parent::__construct();
		$this->load->model('Purchase_dc_model','purchase_dc');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}
	//PRODUCT DETAILS
	public function get_product_details(){
		$data = $this->input->post();
		$data['product_detail'] = $this->common->get_array('mst_products',array('product_id' => $data['product_id'] ));
		$data['product_description'] = $data['product_detail']['product_description'];
		if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1){
			$data['brand_name'] = $this->common->get_particular('mst_brands',array('brand_id' => $data['product_detail']['product_brand'] ),'brand_name');
		}else{
			$data['brand_name'] = "";
		}
		$data['result'] = "success";
		echo json_encode($data);
	}
	public function purchase_dc_list(){
		$data['lists'] = $this->purchase_dc->get_purchase_dc_lists();
		//echo '<pre>';print_r($data);exit;
		$this->template->build('purchase_dc/purchase_dc_list',$data);
	}
	public function purchase_dc(){
		if($this->input->post()){
			$data = $this->input->post();
			//echo '<pre>';print_r($data);//exit;
			$temp_products = $this->purchase_dc->get_temp_listings();
			if($temp_products){
				$new_purchase_dc = array(
					'purchase_dc_number'			=> $data['purchase_dc_number'],
					'company_id'					=> $data['company_id'],
					'purchase_dc_date'				=> $data['purchase_dc_date'],
					'purchase_dc_supplier'			=> $data['purchase_dc_supplier'],
					'purchase_dc_ref_no'			=> $data['purchase_dc_ref_no'],
					'purchase_dc_no'				=> $data['purchase_dc_no'],
					'created_on'					=> created_on(),
					'created_by'					=> created_by(),
					'dc_status'						=> 1,
					'status'						=> 1
				);
				//echo "<pre>";print_r($new_purchase_dc);//exit;
				$purchase_dc_id = $this->common->insert('tbl_purchase_dc',$new_purchase_dc);
				if($purchase_dc_id){
					$current_count = $this->common->get_particular('company_details',array('company_id' => $data['company_id']),'purchase_dc_prefix_count');
					$next_count = next_number($current_count);
					$this->common->update('company_details',array('purchase_dc_prefix_count' => $next_count ),array('company_id' => $data['company_id']));
					$inward_new = array(
						'date'				=> date('Y-m-d'),
						'company_id'		=> $data['company_id'],
						'remarks'			=> 'Purchase DC Entry '.$data['purchase_dc_number'],
						'created_on'		=> created_on(),
						'created_by'		=> created_by(),
						'status'			=> 1
					);
					$stock_inward_id  = $this->common->insert('tbl_stock_inward',$inward_new);
					foreach ($temp_products as $key => $product) {
						//DEFAULT TAX CALCULATION BASED ON PURCHASE PRICE
						$product_detail = $this->common->get_array('mst_products',array('product_id' =>$product['product_id']));
						$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
						$amount = $product_detail['product_purchase_price']*$product['quantity'];
						$tax_total = ($amount) * $tax_percentage/100;
						$total = $amount + $tax_total;
						$relation = array(
							'purchase_dc_id'		=> $purchase_dc_id,
							'product_id'			=> $product['product_id'],
							'product_name'			=> $product['product_name'],
							'brand_id'				=> $product['product_brand'],
							'brand_name'			=> $product['brand_name'],
							'quantity'				=> $product['quantity'],
							'rate'					=> $product_detail['product_purchase_price'],
							'amount'				=> $amount,
							'tax_id'				=> $product_detail['product_tax'],
							'tax_percentage'		=> $tax_percentage,
							'tax_total'				=> $tax_total,
							'total'				    => $total,
							'created_on'			=> created_on(),
							'created_by'			=> created_by(),
							'status'				=> 1
						);
						//echo "<pre>";print_r($relation);exit;
						$purchase_dc_relation_id = $this->common->insert('tbl_purchase_dc_relations',$relation);
						if($data['product_stock_add']=='1'){
							if($stock_inward_id){
								$inward_relation = array(
									'stock_inward_id' 		=> $stock_inward_id,
									'purchase_dc_id' 		=> $purchase_dc_id,
									'product_id'			=> $product['product_id'],
									'quantity'				=> $product['quantity'],
									'created_on'			=> created_on(),
									'created_by'			=> created_by(),
									'status'				=> 1
								);
								$stock_inward_relation_id  = $this->common->insert('tbl_stock_inward_relations',$inward_relation);
								if($stock_inward_relation_id){
									$stock_details = $this->common->get_array('tbl_stock',array('product_id' => $product['product_id']));
								//echo "<pre>";print_r($stock_details);exit;
									if($stock_details!=""){
										$stock = array(
											'product_id'		=> $product['product_id'],
											'company_id'		=> $data['company_id'],
											'quantity'			=> $stock_details['quantity']+$product['quantity'],
											'created_on'		=> created_on(),
											'created_by'		=> created_by(),
											'status'			=> 1
										);
										$stock_id = $this->common->update('tbl_stock',$stock,array('stock_id' => $stock_details['stock_id']));
									}
								}
							}
						}
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 6,
						'operation'			=> 'Purchase Dc Created',
						'operation_details'	=> 'Purchase Dc Created For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_dc_supplier']),'supplier_name'),
						'purchase_dc_id'	=> $purchase_dc_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$message = array(
						'result' => 'success',
						'message' => 'Purchase Added Successfully'
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('purchase_dc_view/'.$purchase_dc_id));
				}else{
					$message = array(
						'result'	=> 'failed',
						'message'	=> 'Purchase Adding Failed'
					);
					$this->session->set_userdata('msg',$message);
				}
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Products are empty'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect(base_url('purchase_dc'));
		}else{
			$this->common->truncate('tbl_purchase_dc_relation_temp');
			$data['purchase_dc_number'] = $this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_dc_prefix_value').''.str_pad($this->common->get_particular('company_details',array('company_id' => $this->session->userdata('company_id')),'purchase_dc_prefix_count'),$this->common->get_particular('mst_settings',array('settings_name' => 'estimate_number_of_zeros' ),'settings_value'), '0', STR_PAD_LEFT);
			$data['suppliers'] = convert_options($this->common->gets_array('mst_suppliers',array('status' => 1)),'supplier_id','supplier_name','SUPPLIER');
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
			if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] = array_column($this->user->get_company_list(), 'company_name');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = array_column($this->user->get_current_user_companies(), 'company_name');
				}
			}
			$this->template->build('purchase_dc/purchase_dc',$data);
		}
	}
	public function purchase_dc_edit($purchase_dc_id){
		if($this->input->post()){
			$data = $this->input->post();
			echo '<pre>';print_r($data);//exit;
			$temp_products = $this->purchase_dc->get_temp_listings();
			echo '<pre>';print_r($temp_products);//exit;
			if($temp_products){
				$purchase_dc = array(
					'purchase_dc_number'			=> $data['purchase_dc_number'],
					'company_id'					=> $data['company_id'],
					'purchase_dc_date'				=> $data['purchase_dc_date'],
					'purchase_dc_supplier'			=> $data['purchase_dc_supplier'],
					'purchase_dc_ref_no'			=> $data['purchase_dc_ref_no'],
					'purchase_dc_no'				=> $data['purchase_dc_no'],
					'updated_on'					=> created_on(),
					'updated_by'					=> created_by(),
					'dc_status'						=> 1,
					'status'						=> 1
				);
				echo "<pre>";print_r($purchase_dc);//exit;
				$purchase_dc_id = $this->common->update('tbl_purchase_dc',$purchase_dc,array('purchase_dc_id' => $purchase_dc_id));
				if($purchase_dc_id){
					$this->common->update('tbl_purchase_dc_relations',array('status' => 0),array('purchase_dc_id' => $purchase_dc_id));
					//$purchase_dc_total = 0;
					//Get stock inward Id
					$get_stock_inward_id = $this->common->get_particular('tbl_stock_inward_relations',array('purchase_dc_id' => $purchase_dc_id),'stock_inward_id');
					$inward_update = array(
						'date'				=> date('Y-m-d'),
						'company_id'		=> $data['company_id'],
						'remarks'			=> 'Purchase DC Entry '.$data['purchase_dc_number'],
						'updated_on'		=> created_on(),
						'updated_by'		=> created_by(),
						'status'			=> 1
					);
					//echo "<pre>";print_r($inward_update);exit;
					$stock_inward_id  = $this->common->update('tbl_stock_inward',$inward_update,array('stock_inward_id' => $get_stock_inward_id));
					foreach ($temp_products as $key => $product) {
						//DEFAULT TAX CALCULATION BASED ON PURCHASE PRICE
						$product_detail = $this->common->get_array('mst_products',array('product_id' =>$product['product_id']));
						$tax_percentage = $this->common->get_particular('mst_taxs', array('tax_id' => $product_detail['product_tax']),'tax_percentage');
						$amount = $product_detail['product_purchase_price']*$product['quantity'];
						$tax_total = ($amount) * $tax_percentage/100;
						$total = $amount + $tax_total;
						$relation = array(
							'purchase_dc_id'		=> $purchase_dc_id,
							'product_id'			=> $product['product_id'],
							'product_name'			=> $product['product_name'],
							'brand_id'				=> $product['product_brand'],
							'brand_name'			=> $product['brand_name'],
							'quantity'				=> $product['quantity'],
							'rate'					=> $product_detail['product_purchase_price'],
							'amount'				=> $amount,
							'tax_id'				=> $product_detail['product_tax'],
							'tax_percentage'		=> $tax_percentage,
							'tax_total'				=> $tax_total,
							'total'				    => $total,
							'created_on'			=> created_on(),
							'created_by'			=> created_by(),
							'status'				=> 1
						);
						//echo "<pre>";print_r($relation);exit;
						$purchase_dc_relation_id = $this->common->insert('tbl_purchase_dc_relations',$relation);
						if($data['product_stock_add']=='1'){
							if($stock_inward_id){
								$inward_relation_id = $this->common->get_particular('tbl_stock_inward_relations',array('purchase_dc_id' => $purchase_dc_id,'product_id' => $product['product_id']),'stock_inward_relation_id');
								$current_stock_qty = $this->common->get_particular('tbl_stock_inward_relations',array('stock_inward_relation_id' => $inward_relation_id),'quantity');
								//echo '<pre>';print_r($inward_relation_id);exit;
								$this->common->update('tbl_stock_inward_relations',array('status' => 0),array('stock_inward_relation_id' => $inward_relation_id));
								//GET INWARD QTY
								$stock_detail = $this->common->get_array('tbl_stock',array('product_id' => $product['product_id']));
								if($current_stock_qty!=""){
									$current_stock = array(
										'product_id'	=> $product['product_id'],
										'company_id'	=> $data['company_id'],
										'quantity'		=> $stock_detail['quantity']-$current_stock_qty,
										'created_on'	=> created_on(),
										'created_by'	=> created_by(),
										'status'		=> 1
									);
									//echo '<pre>';print_r($current_stock);exit;
									$current_stock_id = $this->common->update('tbl_stock',$current_stock,array('product_id' => $product['product_id']));
								}
								$inward_relation = array(
									'stock_inward_id' 		=> $stock_inward_id,
									'purchase_dc_id' 		=> $purchase_dc_id,
									'product_id'			=> $product['product_id'],
									'quantity'				=> $product['quantity'],
									'created_on'			=> created_on(),
									'created_by'			=> created_by(),
									'status'				=> 1
								);
								$stock_inward_relation_id  = $this->common->insert('tbl_stock_inward_relations',$inward_relation);
								if($stock_inward_relation_id){
									$stock_details = $this->common->get_array('tbl_stock',array('product_id' => $product['product_id']));
										//echo "<pre>";print_r($stock_details);exit;
									if($stock_details!=""){
										$stock = array(
											'product_id'	=> $product['product_id'],
											'company_id'	=> $data['company_id'],
											'quantity'		=> $stock_details['quantity']+$product['quantity'],
											'created_on'	=> created_on(),
											'created_by'	=> created_by(),
											'status'		=> 1
										);
										//echo '<pre>';print_r($stock);exit;
										$stock_id = $this->common->update('tbl_stock',$stock,array('stock_id' => $stock_details['stock_id']));
									}
								}
							}
						}
					}
					$log = array(
						'user_id'			=> $this->session->userdata('user_id'),
						'company_id'		=> $data['company_id'],
						'log_category_id'	=> 6,
						'operation'			=> 'Purchase Dc Updated',
						'operation_details'	=> 'Purchase Dc Updated For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_dc_supplier']),'supplier_name'),
						'purchase_dc_id'	=> $purchase_dc_id,
						'logs_status'		=> 0,
						'created_on'		=> created_on(),
						'status'			=> 1
					);
					$log_id = $this->common->insert('tbl_logs',$log);
					$message = array(
						'result' => 'success',
						'message' => 'Purchase Added Successfully'
					);
					$this->session->set_userdata('msg',$message);
					redirect(base_url('purchase_dc_view/'.$purchase_dc_id));
				}else{
					$message = array(
						'result'	=> 'failed',
						'message'	=> 'Purchase Adding Failed'
					);
					$this->session->set_userdata('msg',$message);
				}
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Products are empty'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect(base_url('purchase_dc'));
		}else{
			$data = $this->purchase_dc->get_purchase_dc_details($purchase_dc_id);
			$this->common->truncate('tbl_purchase_dc_relation_temp');
			$this->add_temp_dc($data['relations']);
			$data['temp_products'] = $this->get_dc_temp_listings();
			$data['purchase_dc_number'] = $data['purchase_dc_details']['purchase_dc_number'];
			$data['suppliers'] = convert_options_selected($this->common->gets_array('mst_suppliers',array('status' => 1)),'supplier_id','supplier_name','SUPPLIER',$data['purchase_dc_details']['purchase_dc_supplier']);
			$data['company_lists'] 	= convert_options_selected($this->common->gets_array('company_details',array('company_status' =>1,'company_id' => $data['purchase_dc_details']['company_id'])),'company_id','company_name','COMPANY',$data['purchase_dc_details']['company_id']);
			$this->template->build('purchase_dc/purchase_dc',$data);
		}
	}
	private function add_temp_dc($rows){
		$this->common->truncate('tbl_purchase_dc_relation_temp');
		foreach ($rows as $key => $row) {
			$temp_dc = array(
				'purchase_dc_relation_id'	=> $row['purchase_dc_relation_id'],
				'product_id'				=> $row['product_id'],
				'quantity'					=> $row['quantity'],
				'created_on'				=> created_on(),
				'created_by'				=> created_by(),
				'status'					=> 1
			);
			$insert_id = $this->common->insert('tbl_purchase_dc_relation_temp',$temp_dc);
		}
	}
	private function get_dc_temp_listings(){
		$results = $this->purchase_dc->get_temp_listings();
		//echo '<pre>';print_r($results);exit;
		$lists = '';
		if($results){
			foreach ($results as $key => $result) {
				$lists .='<tr>
				<th scope="row">'.next_number($key).'</th>
				<td>'.$result['product_name'].'</td>
				<td>'.$result['product_description'].'</td>
				<td>'.$result['brand_name'].'</td>
				<td>'.$result['quantity'].'</td>
				<td><a href="#" class="btn btn-danger temp_purchase_dc_remove" data-id="'.$result['purchase_dc_relation_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}else{
			$lists .='<tr>
			<td colspan="5">NO PRODUCTS ADDED</td>
			</tr>';
		} 
		return $lists;
	}
	public function add_temprory_purchase_dc(){
		$data = $this->input->post();
		//echo '<pre>';print_r($data);exit;
		$new_purchase_dc_temp = array(
			'product_id'			=> $data['product_id'],
			'quantity'				=> $data['purchase_dc_quantity'],
			'created_on'			=> created_on(),
			'created_by'			=> created_by(),
			'status'				=> 1
		);
		//echo "<pre>";print_r($new_purchase_dc_temp);exit;
		$purchase_dc_relation_temp_id = $this->common->insert('tbl_purchase_dc_relation_temp',$new_purchase_dc_temp);
		if($purchase_dc_relation_temp_id){
			$message = array(
				'result'	=> 'success',
				'message'	=> 'Purchase DC Product Added Successfully'
			);
		}else{
			$message = array(
				'result'	=> 'failed',
				'message'	=> 'Purchase DC Product Adding Failed'
			);
		}
		$message['listings'] = $this->temp_listing();
		$message['display_message'] = return_message($message);
		echo json_encode($message);
	}
	private function temp_listing(){
		$data['lists'] = $this->purchase_dc->get_temp_listings();
		//echo "<pre>";print_r($data);exit;
		$content = $this->load->view('purchase_dc/includes/temp_listing', $data, TRUE);
		return $content;
	}
	//REMOVE TEMPRORY PURCHASE ORDER
	public function remove_temp_purchase_dc(){
		$purchase_dc_temp_id = $this->input->post('purchase_dc_temp_id');
		if($purchase_dc_temp_id!=''){
			$temp_details = $this->common->get_array('tbl_purchase_dc_relation_temp',array('purchase_dc_relation_temp_id' => $purchase_dc_temp_id ));
			$remove = $this->common->remove('tbl_purchase_dc_relation_temp',array('purchase_dc_relation_temp_id' => $purchase_dc_temp_id ));
			if($remove){
				$message = array(
					'result' 	=> 'success',
					'message' 	=> 'Product removed from invoice successfully',
				);
			}else{
				$message = array(
					'result' 	=> 'failed',
					'message' 	=> 'Product remove from invoice failed',
				);
			}
		}else{
			$message = array(
				'result' 	=> 'failed',
				'message' 	=> 'parameter empty',
			);
		}
		$message['listings'] = $this->temp_listing();
		$message['display_message'] = return_message($message);
		echo json_encode($message);
	}
	public function purchase_dc_view($purchase_dc_id){
		$data = $this->purchase_dc->get_purchase_dc_details($purchase_dc_id);
		//echo "<pre>";print_r($data);exit;
		$this->template->build('purchase_dc/purchase_dc_view',$data);
	}
	public function purchase_dc_print($purchase_dc_id){
		$data = $this->purchase_dc->get_purchase_dc_details($purchase_dc_id);
		//echo "<pre>";print_r($data);exit;
		$html = $this->load->view('purchase_dc/purchase_dc_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('PURCHASE_DC_PRINT.pdf','I');
	}
	public function purchase_dc_download($purchase_dc_id){
		$data = $this->purchase_dc->get_purchase_dc_details($purchase_dc_id);
		//echo "<pre>";print_r($data);exit;
		$html = $this->load->view('purchase_dc/purchase_dc_print',$data,true);
		$this->load->library('pdf');
		$pdf = $this->pdf->load();
		$pdf->WriteHTML($html);
		$pdf->Output('PURCHASE_DC_PRINT.pdf','D');
	}
	public function purchase_dc_remove($purchase_dc_id){
		$update_array = array(
			'status' => 0
		);
		$update_result = $this->common->update('tbl_purchase_dc',$update_array,array('purchase_dc_id' => $purchase_dc_id));
		if($update_result){
			$log = array(
				'user_id'			=> $this->session->userdata('user_id'),
				'company_id'			=> $this->session->userdata('company_id'),
				'log_category_id'	=> 6,
				'operation'			=> 'Purchase Dc Deleted',
				'operation_details'	=> 'Purchase Dc Deleted For -'.$this->common->get_particular('mst_suppliers',array( 'supplier_id' => $data['purchase_dc_supplier']),'supplier_name'),
				'purchase_dc_id'	=> $purchase_dc_id,
				'logs_status'		=> 0,
				'created_on'		=> created_on(),
				'status'			=> 1
			);
			$log_id = $this->common->insert('tbl_logs',$log);
			$message = array(
				'result' => 'success',
				'message' => 'Purchase Dc Removed Successfully'
			);
		}else{
			$message = array(
				'result' => 'failed',
				'message' => 'Purchase DC Remove Failed'
			);
		}
		$this->session->set_userdata('msg',$message);
		redirect(base_url('purchase_dc_list'));
	}
}
/* End of file Purchase_dc.php */
/* Location: ./application/controllers/Purchase_dc.php */