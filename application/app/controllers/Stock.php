<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stock extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Stock_model','stock');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('logout','refresh');
		}
	}
	//Stock list
	public function stock_list(){
		if($this->input->post()){
			$data=$this->input->post();
			//echo "<pre>";print_r($data);exit;
			$data['stocks'] = $this->stock->get_stock_details($data);
			//echo "<pre>";print_r($data['stocks']);exit;
			if($data['product_id'] != ''){
				$data['products'] = convert_options_selected($this->common->gets_array('mst_products',array('status' => 1)),'product_id','product_name','PRODUCT NAME',$data['product_id']);
			}else{
				$data['products']	= convert_options($this->common->gets_array('mst_products',array('status' => 1)),'product_id','product_name','PRODUCT NAME');
			}
			if($data['product_type_id'] != ''){
				$data['product_type'] = convert_options_selected($this->common->gets_array('mst_product_type',array('status' => 1)),'product_type_id','product_type_name','PRODUCT TYPE',$data['product_type_id']);
			}else{
				$data['product_type']	= convert_options($this->common->gets_array('mst_product_type',array('status' => 1)),'product_type_id','product_type_name','PRODUCT TYPE');
			}
			if($data['option'] == 'view'){
				$this->template->build('stock/stock_list',$data);
			}elseif($data['option'] == 'print'){
				$data['company_details'] = $this->company_details($data['lists']['company_id']);
				$html = $this->load->view('stock/stock_list_pdf',$data,true);
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->WriteHTML($html);
				$pdf->Output('stock_list_pdf.pdf','I');
			}else{
				$data['lists_value'] = $this->stock->get_stock_detail_excel($data);
				$lists = $data['lists_value'];
				//echo '<pre>';print_r($lists);exit;
				$this->load->library("excel");
				$this->excel->setActiveSheetIndex(0);
				$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
				$column = 1;
				$row = 1;
				foreach ($lists[0] as $key => $value) {
					$this->excel->getActiveSheet()->SetCellValue($label[1].$row, "S.NO");
					$this->excel->getActiveSheet()->SetCellValue($label[2].$row, "PRODUCT NAME");
					$this->excel->getActiveSheet()->SetCellValue($label[3].$row, "BRAND");
					$this->excel->getActiveSheet()->SetCellValue($label[4].$row, "CATEGORY");
					$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "SUB CATEGORY");
					$this->excel->getActiveSheet()->SetCellValue($label[6].$row, "QUANTITY");
					$column = $column+1;
				}
				$row = 2;
				foreach ($lists as $key => $list) {
					//echo "<pre>";print_r($list);exit;
					$column = 1;
					foreach ($list as $key => $value) {
						$this->excel->getActiveSheet()->SetCellValue($label[1].$row, $key+1);
						$this->excel->getActiveSheet()->SetCellValue($label[2].$row, $list['PRODUCT NAME']);
						$this->excel->getActiveSheet()->SetCellValue($label[3].$row, $list['BRAND']);
						$this->excel->getActiveSheet()->SetCellValue($label[4].$row, $list['CATEGORY']);
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, $list['SUB CATEGORY']);
						$this->excel->getActiveSheet()->SetCellValue($label[6].$row, $list['QUANTITY']);
						$column = $column+1;
					}
					$row = $row+1;
				}
				$total_stock = 0;
				foreach ($lists as $key => $list) {
					$total_stock  = $total_stock+$list['QUANTITY'];
					$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "TOTAL QUANTITY:");
					$this->excel->getActiveSheet()->SetCellValue($label[6].$row, round($total_stock));
				}
				$this->excel->stream('stock_list-'.date('Y_m_d').'.xls');
			}
		}else{
			$data['products']		= convert_options($this->common->gets_array('mst_products',array('status' =>1)),'product_id','product_name','PRODUCT');
			if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_type'),'product_settings_value')== 1) {
				$data['product_type'] 	= convert_options($this->common->gets_array('mst_product_type',array('status' =>1)),'product_type_id','product_type_name','PRODUCT TYPE');
			}
			$data['stocks'] = $this->stock->get_stock_lists();
			$this->template->build('stock/stock_list',$data);
		}
	}
	function company_details($data = array()){
		$this->db->select('a.*,b.state_name');
		$this->db->from('company_details a');
		$this->db->join('mst_state b','b.state_code = a.company_state');
		if(isset($data)){
			$this->db->where('a.company_id',$data);
		}
		$this->db->where('a.company_status!=',0);
		$company_query = $this->db->get();
		if($company_query->num_rows() > 0){
			return $company_query->row_array();
		}else{
			return false;
		}
	}
		//Download Existing product details
	public function product_template_download(){
		$data['lists'] = $this->stock->get_stock_list_excel();
		$lists = $data['lists'];
		$this->load->library("excel");
		$this->excel->setActiveSheetIndex(0);
		$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
		$column = 1;
		$row = 1;
		foreach ($lists[0] as $key => $value) {
			$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $key);
			$column = $column+1;
		}
		$row = 2;
		foreach ($lists as $key => $list) {
			$column = 1;
			foreach ($list as $key => $value) {
				$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $value);
				$column = $column+1;
			}
			$row = $row+1;
		}
		$this->excel->stream('Product_list-'.date('Y_m_d').'.xls');
	}
	//Stock Sheet Update
	public function stock_sheet_update(){
		$this->template->build('stock/stock_sheet_update');
	}
	//STOCK UPLOAD
	public function stock_upload(){
		if($this->input->post()){
			$final_result = false;
			require_once APPPATH . "/third_party/excel/PHPExcel.php";
			$data 						= $this->input->post();
			$path 						= 'uploads/';
			$config['upload_path'] 		= $path;
			$config['allowed_types'] 	= 'xlsx|xls';
			$config['remove_spaces'] 	= TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('product_file')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$data = array('upload_data' => $this->upload->data());
			}
			if(empty($error)){
				if (!empty($data['upload_data']['file_name'])) {
					$import_xls_file 	= $data['upload_data']['file_name'];
					$inputFileName 		= $path . $import_xls_file;
					try {
						$object = PHPExcel_IOFactory::load($inputFileName);
						foreach($object->getWorksheetIterator() as $worksheet){
							$highestRow = $worksheet->getHighestRow();
							$highestColumn = $worksheet->getHighestColumn();
							$stock_rows = array();
							for($row=2; $row<=$highestRow; $row++) {
								$excel_row['product_id']		= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
								$excel_row['product_name']		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
								$excel_row['quantity']			= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
								//echo '<pre>';print_r($excel_row); 
								$result =$this->check_product_excel_row($excel_row);
								if($result['update_stock']){
									$final_result = true;
									$stock_id = $this->common->update('tbl_stock',$result['update_stock'],array('product_id' => $excel_row['product_id']));
									//echo "<pre>";print_r($stock_id);exit;
									$final_rows[] = $excel_row;
								}elseif($result['insert_stock']){
									$final_result = false;
									$stock_id = $this->common->insert('tbl_stock',$result['insert_stock']);
									///echo "<pre>";print_r($stock_id);exit;
									$final_rows[] = $excel_row;
								}else{
									$final_result = false;
									$excel_row['status'] = 'missing';
									$excel_row['reason'] = 'Product details miss match';
									$final_rows[] = $excel_row;
								}
							}
						}
						//echo "<pre>";print_r($final_rows);exit;
						// write in excel file and force download it
						$this->load->library("excel");
						$this->excel->setActiveSheetIndex(0);
						$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z');
						$column = 1;
						$row = 1;
						foreach ($final_rows[0] as $key => $value) {
							$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $key);
							$column = $column+1;
						}
						$row = 2;
						foreach ($final_rows as $key => $list) {
							$column = 1;
							foreach ($list as $key => $value) {
								$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $value);
								$column = $column+1;
							}
							$row = $row+1;
						}
						$this->excel->stream('PRODUCTSHEETUPLOAD-'.date('Y_m_d').'.xls');
						redirect(base_url('stock_list'));
					} catch (Exception $e) {
						$message = array(
							'result' 	=> 'failed' ,
							'message' 	=> 'Error loading file '.pathinfo($inputFileName, PATHINFO_BASENAME).' - '.$e->getMessage()
						);
					}
					if($final_result == true){
						$log = array(
							'user_id'			=> $this->session->userdata('user_id'),
							'company_id'		=> $this->session->userdata('company_id'),
							'log_category_id'	=> 11,
							'operation'			=> 'Stock Excel Uploaded Successfully',
							'operation_details'	=> 'Stock Excel Uploaded Successfully By-'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
							'logs_status'		=> 0,
							'created_on'		=> created_on(),
							'status'			=> 1
						);
						$log_id = $this->common->insert('tbl_logs',$log);
						$message = array(
							'result' 	=> 'Success' ,
							'message' 	=> "Stock Uploaded Successfully"
						);
					}else{
						$message = array(
							'result' 	=> 'Failed' ,
							'message' 	=> $error['error']
						);
					}
					$this->session->set_userdata('msg',$message);
				}else{
					$message = array(
						'result' 	=> 'failed' ,
						'message' 	=> 'Please check excel file rows'
					);
				}
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> 'failed' ,
					'message' 	=> $error['error']
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('stock_upload'));
		}else{
			$this->template->build('stock/stock_upload');
		}
	}
	private function check_product_excel_row($excel_row){
		if(($excel_row['product_id'] !='') && ($excel_row['product_name'] !='') && (isset($excel_row['quantity'] ))){
			if($this->common->exists('tbl_stock',array('product_id' => $excel_row['product_id']))){
				$stock_id = $this->common->get_particular('tbl_stock',array('product_id' => $excel_row['product_id']),'stock_id');
				if($stock_id){
					$data['update_stock'] = array(
						'product_id'			=> $excel_row['product_id'],
						'quantity'				=> $excel_row['quantity'],
						'updated_on'			=> created_on(),
						'updated_by'			=> created_by(),
						'status'				=> 1
					);
				}
			}else{
				$data['insert_stock'] = array(
					'product_id'			=> $excel_row['product_id'],
					'quantity'				=> $excel_row['quantity'],
					'created_on'			=> created_on(),
					'created_by'			=> created_by(),
					'status'				=> 1
				);
			}
			return $data;
		}else{
			return false;
		}
	}
	//Stock Inwarded
	public function stock_inward(){
		if($this->input->post()){
			$data = $this->input->post();
			$insert = array(
				'date'			=> date('Y-m-d',strtotime($data['date'])),
				'remarks'		=> $data['remarks'],
				'created_on'	=> created_on(),
				'created_by'	=> created_by(),
				'status'		=> 1
			);
			$stock_inward_id = $this->common->insert('tbl_stock_inward',$insert);
			if($stock_inward_id){
				$inward_relation = array(
					'stock_inward_id' 	=> $stock_inward_id,
					'product_id'		=> $data['product_id'],
					'quantity'			=> $data['quantity'],
					'created_on'		=> created_on(),
					'created_by'		=> created_by(),
					'status'			=> 1
				);
				$inward_relation_id = $this->common->insert('tbl_stock_inward_relations',$inward_relation);
				if($inward_relation_id){
					$current_stock = $this->common->get_particular('tbl_stock',array('product_id' => $data['product_id']),'quantity');
					$stock = array(
						'product_id'  		=> $data['product_id'],
						'quantity'    		=> $current_stock + $data['quantity'],
						'updated_on'  		=> created_on(),
						'updated_by'  		=> created_by(),
						'status'      		=> 1 
					);
					$stock_id = $this->common->update('tbl_stock',$stock,array('product_id' => $data['product_id']));
					if($stock_id){
						$stock_relation = array(
							'product_id'  		=> $data['product_id'],
							'stock_inward_id'	=> $stock_inward_id,
							'quantity'    		=> $data['quantity'],
							'created_on'  		=> created_on(),
							'created_by'  		=> created_by(),
							'status'      		=> 1 
						);
					}else{
						$message = array(
							'result' 	=> 'Failed',
							'message' 	=> 'Stock Updated Failed'
						);
						$this->session->set_userdata('msg',$message);
					}
				}
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'			=> $this->session->userdata('company_id'),
					'log_category_id'	=> 12,
					'operation'			=> 'Stock Inward Created',
					'operation_details'	=> 'Stock Inward Created By -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'stock_inward_id'	=> $stock_inward_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' 	=> 'Success',
					'message' 	=> 'Stock Inwarded Successfully'
				);
				$this->session->set_userdata('msg',$message);
			}else{
				$message = array(
					'result' 	=> 'Failed',
					'message' 	=> 'Stock Inwarded Failed'
				);
				$this->session->set_userdata('msg',$message);
			}
			redirect('stock_list');
		}else{
			$this->template->build('stock/stock_inward');
		}
	}
	//Stock Adjustments
	public function stock_adjustment(){
		if($this->input->post()){
			$data = $this->input->post();
			$stock_details = $this->common->get_array('tbl_stock',array('product_id' => $data['product_id']));
			$stock_adjustment = array(
				'date' 					=> date('Y-m-d',strtotime($data['date'])),
				'product_id'			=> $data['product_id'],
				'initial_quantity'		=> $stock_details['quantity'],
				'new_quantity'			=> $data['quantity'],
				'remarks'				=> $data['remarks'],
				'created_on'			=> created_on(),
				'created_by'			=> created_by(),
				'status'				=> 1
			);
			$stock_adjustment_id = $this->common->insert('tbl_stock_adjustment',$stock_adjustment);
			if($stock_adjustment_id){
				$stock = array(
					'quantity'		=> $data['quantity'], 
				);
				$this->common->update('tbl_stock',$stock,array('product_id' => $data['product_id']));
				$log = array(
					'user_id'			=> $this->session->userdata('user_id'),
					'company_id'			=> $this->session->userdata('company_id'),
					'log_category_id'	=> 13,
					'operation'			=> 'Stock Adjustment Created',
					'operation_details'	=> 'Stock Adjustment Created By -'.$this->common->get_particular('mst_users',array( 'user_id' => $this->session->userdata('user_id')),'name'),
					'stock_adjustment_id'=> $stock_adjustment_id,
					'logs_status'		=> 0,
					'created_on'		=> created_on(),
					'status'			=> 1
				);
				$log_id = $this->common->insert('tbl_logs',$log);
				$message = array(
					'result' => 'success',
					'message' => 'Stock Adjusted Successfully'
				);
			}else{
				$message = array(
					'result' => 'failed',
					'message' => 'Stock Adjust Failed'
				);
			}
			$this->session->set_userdata('msg',$message);
			redirect(base_url('stock_list'));
		}else{
			$this->template->build('stock/stock_adjustment');
		}
	}
	//GET PRODUCT DETAILS
	public function get_product_details(){
		$product_id = $this->input->post('product_id');
		$product_details = $this->stock->get_product_details($product_id);
		if($product_details){
			echo json_encode(array(
				'result' => 'success',
				'current_qty' => $product_details['quantity']
			));
		}else{
			echo  json_encode(array('success' => 'failed', 'message'=>'product details not found'));
		} 
	}
	public function stock_inward_outward_details($product_id){
		$data['product_name'] = $this->common->get_particular('mst_products',array('product_id' => $product_id),'product_name');
		$data['stock_details'] = $this->stock->get_stock_inward_outward_details($product_id);
		$content = $this->load->view('stock/include/stock_inward_outward_details',$data,TRUE);
		//echo "<pre>";print_r($data);exit;
		$message = array(
			'result'	=> 'success',
			'message'	=> 'reterived Successfully',
			'content' 	=> $content
		);
		echo json_encode($message);
	}
	//Stock Inwards LIST
	public function stock_inward_list(){
		$data['stock_inward'] = $this->stock->get_stock_inward_details();
		$this->template->build('stock/stock_inward_list',$data);
	}
	//Stock Adjustments LIST
	public function stock_adjustment_list(){
		$data['stock_adjustment'] = $this->common->gets_array('tbl_stock_adjustment',array('status' => 1));
		$this->template->build('stock/stock_adjustment_list',$data);
	}
}