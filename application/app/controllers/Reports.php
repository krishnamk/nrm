<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Reports_model','reports');
		$this->load->model('User_model','user');
		if(!$this->session->userdata('invoice_logged_in')){
			redirect('login','refresh');
		}
	}

	public function sales_gst_reports(){
		if($this->input->post()){
			$data=$this->input->post();
			//echo "<pre>";print_r($data);//exit;
			$data['lists'] = $this->reports->get_sales_gst_details($data);
			if($data['customer_id'] != ''){
				$data['customers'] = convert_options_selected($this->common->gets_array('mst_customers',array('status' => 1,)),'customer_id','customer_name','CUSTOMER NAME',$data['customer_id']);
			}else{
				$data['customers']	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER NAME');
			}
			if($data['tax_id'] != ''){
				$data['tax'] = convert_options_selected($this->common->gets_array('mst_taxs',array('status' => 1,)),'tax_id','tax_percentage','TAX %',$data['tax_id']);
			}else{
				$data['tax'] = convert_options($this->common->gets_array('mst_taxs',array('status' => 1,)),'tax_id','tax_percentage','TAX %');
			}
			if(isset($data['company_id'])){
				$data['company_lists'] = convert_options_selected($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY',$data['company_id']);
			}else{
				$data['company_lists'] = convert_options($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY');
			}
			if($data['option'] == 'view'){
				$this->template->build('reports/sales_gst_reports',$data);
			}elseif($data['option'] == 'print'){
				$data['company_details'] = $this->company_details($data['lists']['company_id']);
				//echo "<pre>";print_r($data['company_details']);exit;
				$html = $this->load->view('reports/sales_gst',$data,true);
				$this->load->library('pdf');
				$pdf = $this->pdf->load();
				$pdf->WriteHTML($html);
				$pdf->Output('sales_gst.pdf','I');
			}else{
				$data['lists_value'] = $this->reports->get_sales_detail_excel($data);
				$lists = $data['lists_value'];
				//echo '<pre>';print_r($lists);exit;
				$this->load->library("excel");
				$this->excel->setActiveSheetIndex(0);
				$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
				$column = 1;
				$row = 1;
				foreach ($lists[0] as $key => $value) {
					$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $key);
					$this->excel->getActiveSheet()->SetCellValue($label[8].$row, "IGST");
					$this->excel->getActiveSheet()->SetCellValue($label[9].$row, "CGST");
					$this->excel->getActiveSheet()->SetCellValue($label[10].$row, "SGST");
					$column = $column+1;
				}
				$row = 2;
				foreach ($lists as $key => $list) {
					//echo "<pre>";print_r($list);exit;
					if($list['company_state'] == $list['customer_state']){ 
		                  $state = 1; //Same State 
		                  $ISGT = 0;
		                  $CGST = $list['TAX_VALUE']/2;
		                  $SGST = $list['TAX_VALUE']/2;
		              }else{ 
		                  $state = 2;//Other State
		                  $ISGT = $list['TAX_VALUE'];
		                  $CGST = 0;
		                  $SGST = 0;
		              }
		              $column = 1;
		              foreach ($list as $key => $value) {
		              	$this->excel->getActiveSheet()->SetCellValue($label[1].$row, date('d-m-Y',strtotime($list['DATE'])));
		              	$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $value);
		              	$this->excel->getActiveSheet()->SetCellValue($label[8].$row, $ISGT);
		              	$this->excel->getActiveSheet()->SetCellValue($label[9].$row, $CGST);
		              	$this->excel->getActiveSheet()->SetCellValue($label[10].$row, $SGST);
		              	$column = $column+1;
		              }
		              $row = $row+1;
		          }
		          $total_amount = 0;
		          $total_gst = 0;
		          foreach ($lists as $key => $list) {
		          	$total_amount  = $total_amount+$list['TOTAL_AMOUNT'];
		          	$total_gst     = $total_gst+$list['TAX_VALUE'];
		          	if($list['company_state'] == $list['customer_state']){ 
		                  $state = 1; //Same State 
		                  $IGST_TOTAL = 0;
		                  $CGST_TOTAL = $total_gst / 2;
		                  $SGST_TOTAL = $total_gst / 2;
		              }else{ 
		                  $state = 2;//Other State
		                  $IGST_TOTAL = $total_gst;
		                  $CGST_TOTAL = 0;
		                  $SGST_TOTAL = 0;
		              }
		              $this->excel->getActiveSheet()->SetCellValue($label[5].$row, "GRAND TOTAL :");
		              $this->excel->getActiveSheet()->SetCellValue($label[6].$row, round($total_amount));
		              $this->excel->getActiveSheet()->SetCellValue($label[7].$row, $total_gst);
		              $this->excel->getActiveSheet()->SetCellValue($label[8].$row, $IGST_TOTAL);
		              $this->excel->getActiveSheet()->SetCellValue($label[9].$row, $CGST_TOTAL);
		              $this->excel->getActiveSheet()->SetCellValue($label[10].$row, $SGST_TOTAL);
		          }
		          $this->excel->stream('sales_gst-'.date('Y_m_d').'.xls');
		      }
		  }else{
		  	$data['tax']		= convert_options($this->common->gets_array('mst_taxs',array('status' =>1)),'tax_id','tax_percentage','TAX %');
		  	$data['customers'] 	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER');
		  	$data['lists']		= $this->reports->get_sales_summary_list();
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
		  	if($this->session->userdata('access_level')==1){
		  		$data['company_lists'] =convert_options($this->get_companies_list(),'company_id','company_name','COMPANY');
		  	}elseif($this->session->userdata('access_level')==2){
		  		$data['company_lists'] = convert_options($this->get_current_user_company_list(),'company_id','company_name','COMPANY');
		  	}
			//echo "<pre>";print_r($data['lists']);exit;
		  	$this->template->build('reports/sales_gst_reports',$data);
		  }
		}
		function get_companies_list(){
			$this->db->select('*');
			$this->db->from('company_details a');
			$this->db->where('a.company_status',1);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$results = $query->result_array(); 
				return $results;
			}else{
				return false;
			}
		}
		function get_current_user_company_list(){
			$this->db->select('access_company');
			if($this->session->userdata('access_level') > 1){
				$this->db->where('user_id',$this->session->userdata('user_id'));
			}
			$query = $this->db->get('mst_users');
			if($query->num_rows() > 0){
				$companies = $query->row_array()['access_company'];
				$this->db->select('*');
				$this->db->where_in('company_id ', array_filter(explode(',',$companies)));
				$query = $this->db->get('company_details');
				if($query->num_rows() > 0){
					return $query->result_array();
				}else{
					return false;
				} 
			}else{
				return false;
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

		//PURCHASE GST FILTER
		public function purchase_gst_reports(){
			if($this->input->post()){
				$data=$this->input->post();
			//echo "<pre>";print_r($data);//exit;
				$data['lists'] = $this->reports->get_purchase_gst_details($data);
				if($data['supplier_id'] != ''){
					$data['suppliers'] = convert_options_selected($this->common->gets_array('mst_suppliers',array('status' => 1,)),'supplier_id','supplier_name','SUPPLIER NAME',$data['supplier_id']);
				}else{
					$data['suppliers']	= convert_options($this->common->gets_array('mst_suppliers',array('status' =>1)),'supplier_id','supplier_name','SUPPLIER NAME');
				}
				if($data['tax_id'] != ''){
					$data['tax'] = convert_options_selected($this->common->gets_array('mst_taxs',array('status' => 1,)),'tax_id','tax_percentage','TAX %',$data['tax_id']);
				}else{
					$data['tax'] = convert_options($this->common->gets_array('mst_taxs',array('status' => 1,)),'tax_id','tax_percentage','TAX %');
				}
				if(isset($data['company_id'])){
					$data['company_lists'] = convert_options_selected($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY',$data['company_id']);
				}else{
					$data['company_lists'] = convert_options($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY');
				}
				if($data['option'] == 'view'){
					$this->template->build('reports/purchase_gst_reports',$data);
				}elseif($data['option'] == 'print'){
					$data['company_details'] = $this->company_details($data['lists']['company_id']);
				//echo "<pre>";print_r($data['company_details']);exit;
					$html = $this->load->view('reports/purchase_gst',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('purchase_gst.pdf','I');
				}else{
					$data['lists_value'] = $this->reports->get_purchase_detail_excel($data);
					$lists = $data['lists_value'];
				//echo '<pre>';print_r($lists);exit;
					$this->load->library("excel");
					$this->excel->setActiveSheetIndex(0);
					$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
					$column = 1;
					$row = 1;
					foreach ($lists[0] as $key => $value) {
						$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $key);
						$this->excel->getActiveSheet()->SetCellValue($label[8].$row, "IGST");
						$this->excel->getActiveSheet()->SetCellValue($label[9].$row, "CGST");
						$this->excel->getActiveSheet()->SetCellValue($label[10].$row, "SGST");
						$column = $column+1;
					}
					$row = 2;
					foreach ($lists as $key => $list) {
					//echo "<pre>";print_r($list);exit;
						if($list['company_state'] == $list['supplier_state']){ 
		                  $state = 1; //Same State 
		                  $ISGT = 0;
		                  $CGST = $list['TAX_VALUE']/2;
		                  $SGST = $list['TAX_VALUE']/2;
		              }else{ 
		                  $state = 2;//Other State
		                  $ISGT = $list['TAX_VALUE'];
		                  $CGST = 0;
		                  $SGST = 0;
		              }
		              $column = 1;
		              foreach ($list as $key => $value) {
		              	$this->excel->getActiveSheet()->SetCellValue($label[1].$row, date('d-m-Y',strtotime($list['DATE'])));
		              	$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $value);
		              	$this->excel->getActiveSheet()->SetCellValue($label[8].$row, $ISGT);
		              	$this->excel->getActiveSheet()->SetCellValue($label[9].$row, $CGST);
		              	$this->excel->getActiveSheet()->SetCellValue($label[10].$row, $SGST);
		              	$column = $column+1;
		              }
		              $row = $row+1;
		          }
		          $total_amount = 0;
		          $total_gst = 0;
		          foreach ($lists as $key => $list) {
		          	$total_amount  = $total_amount+$list['TOTAL_AMOUNT'];
		          	$total_gst     = $total_gst+$list['TAX_VALUE'];
		          	if($list['company_state'] == $list['supplier_state']){ 
		                  $state = 1; //Same State 
		                  $IGST_TOTAL = 0;
		                  $CGST_TOTAL = $total_gst / 2;
		                  $SGST_TOTAL = $total_gst / 2;
		              }else{ 
		                  $state = 2;//Other State
		                  $IGST_TOTAL = $total_gst;
		                  $CGST_TOTAL = 0;
		                  $SGST_TOTAL = 0;
		              }
		              $this->excel->getActiveSheet()->SetCellValue($label[5].$row, "GRAND TOTAL :");
		              $this->excel->getActiveSheet()->SetCellValue($label[6].$row, round($total_amount));
		              $this->excel->getActiveSheet()->SetCellValue($label[7].$row, $total_gst);
		              $this->excel->getActiveSheet()->SetCellValue($label[8].$row, $IGST_TOTAL);
		              $this->excel->getActiveSheet()->SetCellValue($label[9].$row, $CGST_TOTAL);
		              $this->excel->getActiveSheet()->SetCellValue($label[10].$row, $SGST_TOTAL);
		          }
		          $this->excel->stream('purchase_gst-'.date('Y_m_d').'.xls');
		      }
		  }else{
		  	$data['tax']		= convert_options($this->common->gets_array('mst_taxs',array('status' =>1)),'tax_id','tax_percentage','TAX %');
		  	$data['suppliers'] 	= convert_options($this->common->gets_array('mst_suppliers',array('status' =>1)),'supplier_id','supplier_name','SUPPLIER');
		  	$data['lists']		= $this->reports->get_purchase_summary_list();
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
		  	if($this->session->userdata('access_level')==1){
		  		$data['company_lists'] =convert_options($this->get_companies_list(),'company_id','company_name','COMPANY');
		  	}elseif($this->session->userdata('access_level')==2){
		  		$data['company_lists'] = convert_options($this->get_current_user_company_list(),'company_id','company_name','COMPANY');
		  	}
			//echo "<pre>";print_r($data['company_lists']);exit;
		  	$this->template->build('reports/purchase_gst_reports',$data);
		  }
		}

		public function customer_report(){
			if($this->input->post()){
				$data=$this->input->post();
				//echo "<pre>";print_r($data);exit;
				if($data['customer_type']!=""){
					if($data['customer_type'] == "1"){
						$data['invoice_bills']	= $this->reports->get_customers_summary_list($data);
					}else{
						$data['estimate_bills']	= $this->reports->get_customers_estimate_summary_list($data);
					}
				}
				$data['type'] = $data['customer_type'];
				if($data['customer_type'] != ''){
					$data['customer_type'] = convert_options_selected($this->common->gets_array('mst_customer_type',array('status' => 1,)),'customer_type_id','customer_type','CUSTOMER TYPE',$data['customer_type']);
				}else{
					$data['customer_type']	= convert_options($this->common->gets_array('mst_customer_type',array('status' =>1)),'customer_type_id','customer_type','CUSTOMER TYPE');
				}
				if($data['customer_id'] != ''){
					$data['customers'] = convert_options_selected($this->common->gets_array('mst_customers',array('status' => 1,)),'customer_id','customer_name','CUSTOMER NAME',$data['customer_id']);
				}else{
					$data['customers']	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER NAME');
				}
				if(isset($data['company_id'])){
					$data['company_lists'] = convert_options_selected($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY',$data['company_id']);
				}else{
					$data['company_lists'] = convert_options($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY');
				}

				if($data['option'] == 'view'){
					$this->template->build('reports/customer_reports',$data);
				}elseif($data['option'] == 'print'){
					$data['company_details'] = $this->company_details($data['lists']['company_id']);
				    //echo "<pre>";print_r($data['company_details']);exit;
					$html = $this->load->view('reports/customer_reports_pdf',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('customer_reports.pdf','I');
				}else{
					$data['lists_value'] = $this->reports->get_customers_detail_excel($data);
					$lists = $data['lists_value'];
					//echo '<pre>';print_r($lists);exit;
					$this->load->library("excel");
					$this->excel->setActiveSheetIndex(0);
					$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
					$column = 1;
					$row = 1;
					foreach ($lists as $key => $value) {
						$this->excel->getActiveSheet()->SetCellValue($label[1].$row, "S.NO");
						$this->excel->getActiveSheet()->SetCellValue($label[2].$row, "INVOICE DATE");
						$this->excel->getActiveSheet()->SetCellValue($label[3].$row, "INVOICE NO");
						$this->excel->getActiveSheet()->SetCellValue($label[4].$row, "CUSTOMER NAME");
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "GST NUMBER");
						$this->excel->getActiveSheet()->SetCellValue($label[6].$row, "NET TOTAL");
						$this->excel->getActiveSheet()->SetCellValue($label[7].$row, "TAX");
						$this->excel->getActiveSheet()->SetCellValue($label[8].$row, "OTHER EXPENSES");
						$this->excel->getActiveSheet()->SetCellValue($label[9].$row, "TOTAL");
						$column = $column+1;
					}
					$row = 2;
					$net_total = 0;
					$tax_value = 0;
					$pre_total = 0;
					foreach ($lists as $key => $list) {
						$net_total = $list['invoice_loading_charges']+$list['invoice_transportaion_charges']+$list['invoice_other_expenses']-$list['invoice_cash_discount'];
						if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)){
							$pre_total 	   = $list['TOTAL_AMOUNT'] - $list['TAX_VALUE'];
							$tax_value     = $tax_value+$list['TAX_VALUE'];
						}else{
							$tax_value     = $tax_value+ 0; 
						}
						$column = 1;
						foreach ($list as $list_key => $value) {
							$this->excel->getActiveSheet()->SetCellValue($label[1].$row, $key+1);
							$this->excel->getActiveSheet()->SetCellValue($label[2].$row, date('d-m-Y',strtotime($list['DATE'])));
							$this->excel->getActiveSheet()->SetCellValue($label[3].$row, $list['INVOICE_NUMBER']);
							$this->excel->getActiveSheet()->SetCellValue($label[4].$row, $list['CUSTOMER_NAME']);
							$this->excel->getActiveSheet()->SetCellValue($label[5].$row, $list['CUSTOMER_GST']);
							$this->excel->getActiveSheet()->SetCellValue($label[6].$row, $pre_total);
							$this->excel->getActiveSheet()->SetCellValue($label[7].$row, $tax_value);
							$this->excel->getActiveSheet()->SetCellValue($label[8].$row, $net_total);
							$this->excel->getActiveSheet()->SetCellValue($label[9].$row, $list['TOTAL_AMOUNT']+$net_total);
							$column = $column+1;
						}
						$row = $row+1;
					}
					$total_amount = 0;
					$total_gst = 0;
					$total = 0;
					$net_total = 0;
					$pre_total = 0;
					$before_tax = 0;
					foreach ($lists as $key => $list) {
						//echo "<pre>";print_r($list);exit;
						$net_total = $list['invoice_loading_charges']+$list['invoice_transportaion_charges']+$list['invoice_other_expenses']-$list['invoice_cash_discount'];
						$pre_total = $pre_total + $net_total; 
						if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)){
							$before_tax = $list['TOTAL_AMOUNT'] - $list['TAX_VALUE'];
							$total_amount  = $total_amount+ $before_tax;
							$total_gst     = $total_gst+$list['TAX_VALUE'];
							$total = $total_amount + $total_gst;
						}else{
							$before_tax = $list['TOTAL_AMOUNT'];
							$total_amount  = $total_amount+ $before_tax;
							$total_gst     = $total_gst+ 0; 
							$total = $total_amount + $net_total;   
						}
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "GRAND TOTAL :");
						$this->excel->getActiveSheet()->SetCellValue($label[6].$row, $total_amount);
						$this->excel->getActiveSheet()->SetCellValue($label[7].$row, $total_gst);
						$this->excel->getActiveSheet()->SetCellValue($label[8].$row, $pre_total);
						$this->excel->getActiveSheet()->SetCellValue($label[9].$row, $total);
					}
					$this->excel->stream('customer_reports-'.date('Y_m_d').'.xls');
				}
			}else{
				$data['customers'] 	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER');
				$data['customer_type'] 	= convert_options($this->common->gets_array('mst_customer_type',array('status' =>1)),'customer_type_id','customer_type','CUSTOMER TYPE');
				$data['tax'] 	= convert_options($this->common->gets_array('mst_taxs',array('status' =>1)),'tax_id','tax_percentage','TAX');
				$data['invoice_bills']	= false;
				$data['estimate_bills']	= false;
				$data['lists']		= $this->reports->get_customers_summary_list();
				//COMPANY LIST IF MULTIPLE COMPANY ENABLE
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] =convert_options($this->get_companies_list(),'company_id','company_name','COMPANY');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = convert_options($this->get_current_user_company_list(),'company_id','company_name','COMPANY');
				}
				//echo "<pre>";print_r($data['lists']);exit;
				$this->template->build('reports/customer_reports',$data);
			}

		}


		public function supplier_report(){
			if($this->input->post()){
				$data=$this->input->post();
			//echo "<pre>";print_r($data);//exit;
				$data['lists'] = $this->reports->get_suppliers_summary_list($data);
				if($data['supplier_id'] != ''){
					$data['suppliers'] = convert_options_selected($this->common->gets_array('mst_suppliers',array('status' => 1,)),'supplier_id','supplier_name','SUPPLIER NAME',$data['supplier_id']);
				}else{
					$data['suppliers']	= convert_options($this->common->gets_array('mst_suppliers',array('status' =>1)),'supplier_id','supplier_name','SUPPLIER NAME');
				}
				if(isset($data['company_id'])){
					$data['company_lists'] = convert_options_selected($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY',$data['company_id']);
				}else{
					$data['company_lists'] = convert_options($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY');
				}
				if($data['option'] == 'view'){
					$this->template->build('reports/sales_gst_reports',$data);
				}elseif($data['option'] == 'print'){
					$data['company_details'] = $this->company_details($data['lists']['company_id']);
				//echo "<pre>";print_r($data['company_details']);exit;
					$html = $this->load->view('reports/supplier_reports_pdf',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('supplier_reports.pdf','I');
				}else{
					$data['lists_value'] = $this->reports->get_suppliers_detail_excel($data);
					$lists = $data['lists_value'];
					//echo '<pre>';print_r($lists);//exit;
					$this->load->library("excel");
					$this->excel->setActiveSheetIndex(0);
					$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
					$column = 1;
					$row = 1;
					foreach ($lists[0] as $key => $value) {
						$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $key);
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "NET AMOUNT");
						$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $key);
						$this->excel->getActiveSheet()->SetCellValue($label[7].$row, "TOTAL");
						$column = $column+1;
					}
					$row = 2;
					foreach ($lists as $key => $list) {
						//echo "<pre>";print_r($list);exit;
						$column = 1;
						foreach ($list as $key => $value) {
							$this->excel->getActiveSheet()->SetCellValue($label[1].$row, date('d-m-Y',strtotime($list['DATE'])));
							$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $value);
							$this->excel->getActiveSheet()->SetCellValue($label[5].$row, $list['TOTAL_AMOUNT']-$list['TAX_VALUE']);
							$this->excel->getActiveSheet()->SetCellValue($label[$column].$row, $value);
							$this->excel->getActiveSheet()->SetCellValue($label[7].$row, $list['TOTAL_AMOUNT']);
							$column = $column+1;
						}
						$row = $row+1;
					}
					$total_amount = 0;
					$total_gst = 0;
					$total = 0;
					foreach ($lists as $key => $list) {
						$total_amount  = $total_amount+$list['TOTAL_AMOUNT'];
						$total_gst     = $total_gst+$list['TAX_VALUE'];
						$total = $total_amount + $total_gst;
						$this->excel->getActiveSheet()->SetCellValue($label[4].$row, "GRAND TOTAL :");
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, $total_amount);
						$this->excel->getActiveSheet()->SetCellValue($label[6].$row, $total_gst);
						$this->excel->getActiveSheet()->SetCellValue($label[7].$row, $total);
					}
					$this->excel->stream('supplier_reports-'.date('Y_m_d').'.xls');
				}
			}else{
				$data['suppliers'] 	= convert_options($this->common->gets_array('mst_suppliers',array('status' =>1)),'supplier_id','supplier_name','SUPPLIER');
				$data['lists']		= $this->reports->get_suppliers_summary_list();
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] =convert_options($this->get_companies_list(),'company_id','company_name','COMPANY');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = convert_options($this->get_current_user_company_list(),'company_id','company_name','COMPANY');
				}
				//echo "<pre>";print_r($data['lists']);exit;
				$this->template->build('reports/supplier_reports',$data);
			}
		}

		public function sales_person_based_report(){
			if($this->input->post()){
				$data=$this->input->post();
				//echo "<pre>";print_r($data);//exit;
				$data['lists'] = $this->reports->get_sales_person_details($data);
				if($data['user_id'] != ''){
					$data['sales_persons'] = convert_options_selected($this->common->gets_array('mst_users',array('status' => 1,)),'user_id','username','SALES PERSON',$data['user_id']);
				}else{
					$data['sales_persons']	= convert_options($this->common->gets_array('mst_users',array('status' =>1)),'user_id','username','SALES PERSON');
				}
				if(isset($data['company_id'])){
					$data['company_lists'] = convert_options_selected($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY',$data['company_id']);
				}else{
					$data['company_lists'] = convert_options($this->common->gets_array('company_details',array('company_status' => 1,)),'company_id','company_name','COMPANY');
				}
				if($data['option'] == 'view'){
					$this->template->build('reports/sales_person_based_report',$data);
				}elseif($data['option'] == 'print'){
					$data['company_details'] = $this->company_details($data['lists']['company_id']);
					//echo "<pre>";print_r($data['company_details']);exit;
					$html = $this->load->view('reports/sales_person_based_report_pdf',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('sales_person_based_report_pdf.pdf','I');
				}else{
					$data['lists_value'] = $this->reports->get_sales_person_detail_excel($data);
					$lists = $data['lists_value'];
					//echo '<pre>';print_r($lists);exit;
					$this->load->library("excel");
					$this->excel->setActiveSheetIndex(0);
					$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
					$column = 1;
					$row = 1;
					foreach ($lists as $key => $value) {
						$this->excel->getActiveSheet()->SetCellValue($label[1].$row, "S.NO");
						$this->excel->getActiveSheet()->SetCellValue($label[2].$row, "INVOICE DATE");
						$this->excel->getActiveSheet()->SetCellValue($label[3].$row, "INVOICE NO");
						$this->excel->getActiveSheet()->SetCellValue($label[4].$row, "CUSTOMER NAME");
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "GST NUMBER");
						$this->excel->getActiveSheet()->SetCellValue($label[6].$row, "NET TOTAL");
						$this->excel->getActiveSheet()->SetCellValue($label[7].$row, "TAX");
						$this->excel->getActiveSheet()->SetCellValue($label[8].$row, "OTHER EXPENSES");
						$this->excel->getActiveSheet()->SetCellValue($label[9].$row, "TOTAL");
						$column = $column+1;
					}
					$row = 2;
					$net_total = 0;
					$tax_value = 0;
					foreach ($lists as $key => $list) {
						$net_total = $list['invoice_loading_charges']+$list['invoice_transportaion_charges']+$list['invoice_other_expenses']-$list['invoice_cash_discount'];
						if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)){
							$tax_value     = $tax_value+$list['TAX_VALUE'];
						}else{
							$tax_value     = $tax_value+ 0; 
						}
						$column = 1;
						foreach ($list as $list_key => $value) {
							$this->excel->getActiveSheet()->SetCellValue($label[1].$row, $key+1);
							$this->excel->getActiveSheet()->SetCellValue($label[2].$row, date('d-m-Y',strtotime($list['DATE'])));
							$this->excel->getActiveSheet()->SetCellValue($label[3].$row, $list['INVOICE_NUMBER']);
							$this->excel->getActiveSheet()->SetCellValue($label[4].$row, $list['CUSTOMER_NAME']);
							$this->excel->getActiveSheet()->SetCellValue($label[5].$row, $list['CUSTOMER_GST']);
							$this->excel->getActiveSheet()->SetCellValue($label[6].$row, $list['TOTAL_AMOUNT']);
							$this->excel->getActiveSheet()->SetCellValue($label[7].$row, $tax_value);
							$this->excel->getActiveSheet()->SetCellValue($label[8].$row, $net_total);
							$this->excel->getActiveSheet()->SetCellValue($label[9].$row, $list['TOTAL_AMOUNT']+$net_total);
							$column = $column+1;
						}
						$row = $row+1;
					}
					$total_amount = 0;
					$total_gst = 0;
					$total = 0;
					$net_total = 0;
					$pre_total = 0;
					foreach ($lists as $key => $list) {
						$net_total = $list['invoice_loading_charges']+$list['invoice_transportaion_charges']+$list['invoice_other_expenses']-$list['invoice_cash_discount'];
						$pre_total = $pre_total + $net_total; 
						$total_amount  = $total_amount+$list['TOTAL_AMOUNT'];
						if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)){
							$total_gst     = $total_gst+$list['TAX_VALUE'];
							$total = $total_amount + $total_gst;
						}else{
							$total_gst     = $total_gst+ 0; 
							$total = $total_amount + $net_total;   
						}
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "GRAND TOTAL :");
						$this->excel->getActiveSheet()->SetCellValue($label[6].$row, $total_amount);
						$this->excel->getActiveSheet()->SetCellValue($label[7].$row, $total_gst);
						$this->excel->getActiveSheet()->SetCellValue($label[8].$row, $pre_total);
						$this->excel->getActiveSheet()->SetCellValue($label[9].$row, $total);
					}
					$this->excel->stream('customer_reports-'.date('Y_m_d').'.xls');
				}
			}else{
				$data['tax']		= convert_options($this->common->gets_array('mst_taxs',array('status' =>1)),'tax_id','tax_percentage','TAX %');
				$data['sales_persons'] 	= convert_options($this->common->gets_array('mst_users',array('status' =>1)),'user_id','username','SALES PERSON');
				$data['lists']		= $this->reports->get_sales_person_summary_list();
			//COMPANY LIST IF MULTIPLE COMPANY ENABLE
				if($this->session->userdata('access_level')==1){
					$data['company_lists'] =convert_options($this->get_companies_list(),'company_id','company_name','COMPANY');
				}elseif($this->session->userdata('access_level')==2){
					$data['company_lists'] = convert_options($this->get_current_user_company_list(),'company_id','company_name','COMPANY');
				}
			//echo "<pre>";print_r($data['company_lists']);exit;
				$this->template->build('reports/sales_person_based_report',$data);
			}
		}

		public function product_report(){
			if($this->input->post()){
				$data=$this->input->post();
				$data['lists'] = $this->reports->get_products_summary_list($data);
				//echo "<pre>";print_r($data['lists']);exit;
				if($data['customer_id'] != ''){
					$data['customers'] = convert_options_selected($this->common->gets_array('mst_customers',array('status' => 1,)),'customer_id','customer_name','CUSTOMER NAME',$data['customer_id']);
				}else{
					$data['customers']	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER NAME');
				}
				if($data['option'] == 'view'){
					$this->template->build('reports/product_reports',$data);
				}elseif($data['option'] == 'print'){
					$data['company_details'] = $this->company_details($data['lists']['company_id']);
					//echo "<pre>";print_r($data['company_details']);exit;
					$html = $this->load->view('reports/product_reports_pdf',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('product_reports_pdf.pdf','I');
				}else{
					$data['lists_value'] = $this->reports->get_product_detail_excel($data);
					$lists = $data['lists_value'];
					//echo '<pre>';print_r($lists);exit;
					$this->load->library("excel");
					$this->excel->setActiveSheetIndex(0);
					$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
					$column = 1;
					$row = 1;
					foreach ($lists as $key => $value) {
						$this->excel->getActiveSheet()->SetCellValue($label[1].$row, "S.NO");
						$this->excel->getActiveSheet()->SetCellValue($label[2].$row, "CUSTOMER NAME");
						$this->excel->getActiveSheet()->SetCellValue($label[3].$row, "PRODUCT NAME");
						$this->excel->getActiveSheet()->SetCellValue($label[4].$row, "QUANTITY SOLD");
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "AVERAGE PRICE");
						$this->excel->getActiveSheet()->SetCellValue($label[6].$row, "TOTAL AMOUNT");
						$column = $column+1;
					}
					$row = 2;
					$amount = 0;
					foreach ($lists as $key => $list) {
						//echo "<pre>";print_r($list);exit;
						$column = 1;
						foreach ($list as $listkey => $value) {
		              	//echo "<pre>";print_r($value);exit;
							$amount = $list['rate'] * $list['quantity'];
							$this->excel->getActiveSheet()->SetCellValue($label[1].$row, $key+1);
							$this->excel->getActiveSheet()->SetCellValue($label[2].$row, $list['customer_name']);
							$this->excel->getActiveSheet()->SetCellValue($label[3].$row, $list['product_name']);
							$this->excel->getActiveSheet()->SetCellValue($label[4].$row, $list['quantity']);
							$this->excel->getActiveSheet()->SetCellValue($label[5].$row, $list['rate']);
							$this->excel->getActiveSheet()->SetCellValue($label[6].$row, $amount);
							$column = $column+1;
						}
						$row = $row+1;
					}
					$total_amount = 0;
					$total_gst = 0;
					foreach ($lists as $key => $list) {
						$net_amount  = $total_amount+($list['rate']);
						$amount = $list['rate'] * $list['quantity'];
						$total_amount = $amount + $total_amount;
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "GRAND TOTAL :");
						$this->excel->getActiveSheet()->SetCellValue($label[6].$row, round($total_amount));
					}
					$this->excel->stream('product_reports-'.date('Y_m_d').'.xls');
				}
			}else{
				$data['customers'] 	= convert_options($this->common->gets_array('mst_customers',array('status' =>1)),'customer_id','customer_name','CUSTOMER');
				$data['lists']		= $this->reports->get_products_summary_list();
				//echo "<pre>";print_r($data['lists']);exit;
				$this->template->build('reports/product_reports',$data);
			}
		}

		public function hsncode_report(){
			if($this->input->post()){
				$data=$this->input->post();
				//echo "<pre>";print_r($data);exit;
				$data['lists'] = $this->reports->get_hsncode_summary_list($data);
				//echo "<pre>";print_r($data['lists']);exit;
				if($data['product_id'] != ''){
					$data['hsncode'] = convert_options_selected($this->common->gets_array('mst_products',array('status' => 1,)),'product_id','product_hsncode','HSNCODE',$data['product_id']);
				}else{
					$data['hsncode']	= convert_options($this->common->gets_array('mst_products',array('status' =>1)),'product_id','product_hsncode','HSNCODE');
				}
				if($data['option'] == 'view'){
					$this->template->build('reports/hsncode_reports',$data);
				}elseif($data['option'] == 'print'){
					$data['company_details'] = $this->company_details($data['lists']['company_id']);
					//echo "<pre>";print_r($data['company_details']);exit;
					$html = $this->load->view('reports/hsncode_reports_pdf',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('hsncode_reports_pdf.pdf','I');
				}else{
					$data['lists_value'] = $this->reports->get_hsncode_detail_excel($data);
					$lists = $data['lists_value'];
					//echo '<pre>';print_r($lists);exit;
					$this->load->library("excel");
					$this->excel->setActiveSheetIndex(0);
					$label = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z',27=>'AA',28=>'AB',29=>'AC',30=>'AD',31=>'AE',32=>'AF',33 => 'AG');
					$column = 1;
					$row = 1;
					foreach ($lists as $key => $value) {
						$this->excel->getActiveSheet()->SetCellValue($label[1].$row, "S.NO");
						$this->excel->getActiveSheet()->SetCellValue($label[2].$row, "PRODUCT NAME");
						$this->excel->getActiveSheet()->SetCellValue($label[3].$row, "QUANTITY SOLD");
						$this->excel->getActiveSheet()->SetCellValue($label[4].$row, "AVERAGE PRICE");
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, "TOTAL AMOUNT");
						$column = $column+1;
					}
					$row = 2;
					$amount = 0;
					foreach ($lists as $key => $list) {
						//echo "<pre>";print_r($list);exit;
						$column = 1;
						foreach ($list as $listkey => $value) {
		              	//echo "<pre>";print_r($value);exit;
							$amount = $list['rate'] * $list['quantity'];
							$this->excel->getActiveSheet()->SetCellValue($label[1].$row, $key+1);
							$this->excel->getActiveSheet()->SetCellValue($label[2].$row, $list['product_name']);
							$this->excel->getActiveSheet()->SetCellValue($label[3].$row, $list['quantity']);
							$this->excel->getActiveSheet()->SetCellValue($label[4].$row, $list['rate']);
							$this->excel->getActiveSheet()->SetCellValue($label[5].$row, $amount);
							$column = $column+1;
						}
						$row = $row+1;
					}
					$total_amount = 0;
					$total_gst = 0;
					foreach ($lists as $key => $list) {
						$net_amount  = $total_amount+($list['rate']);
						$amount = $list['rate'] * $list['quantity'];
						$total_amount = $amount + $total_amount;
						$this->excel->getActiveSheet()->SetCellValue($label[4].$row, "GRAND TOTAL :");
						$this->excel->getActiveSheet()->SetCellValue($label[5].$row, round($total_amount));
					}
					$this->excel->stream('hsncode_reports-'.date('Y_m_d').'.xls');
				}
			}else{
				$data['hsncode'] 	= convert_options($this->common->gets_array('mst_products',array('status' =>1)),'product_id','product_hsncode','HSNCODE');
				$data['lists']		= $this->reports->get_hsncode_summary_list();
				//echo "<pre>";print_r($data['lists']);exit;
				$this->template->build('reports/hsncode_reports',$data);
			}
		}

		//SALES RECEIPT REPORT 
		public function receipt_reports(){
			if($this->input->post()){
				$data = $this->input->post();
				//echo "<pre>";print_r($data);exit;
				$data['report_type'] = "customer";
				if(isset($data['customer_id'])){
					$data['customer_name'] = $this->common->get_particular('mst_customers',array('customer_id' => $data['customer_id']),'customer_name');
				}
				if($data['customer_type']!=""){
					if($data['customer_type'] == "1"){
						$data['bills']			= $this->reports->get_invoice_payments($data);
						$data['receipts'] 		= $this->reports->get_receipts($data);
					}else{
						$data['receipts'] 		= $this->reports->get_receipts($data);
						$data['estimate_bills']	= $this->reports->get_estimate_payments($data);
					}
				}else{
					$data['receipts'] 		= $this->reports->get_receipts($data);
					$data['bills']			= $this->reports->get_invoice_payments($data);
					$data['estimate_bills']	= $this->reports->get_estimate_payments($data);
				}
				//echo "<pre>";print_r($data);exit;
				$data['bill_payments']	= $this->reports->get_invoice_bill_payments($data);
				$data['journals']		= $this->reports->get_journals($data);
				$data['opening_balance']= $this->reports->get_receipt_opening_balance($data);
				//echo "<pre>";print_r($data);exit;
				if($data['option'] == 'view'){
					$this->template->build('reports/receipt_reports',$data);
				}else{
					$html = $this->load->view('reports/receipts_reports_print',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('receipt_reports.pdf','I');
				}
			}else{
				$data['bills'] 			= false;
				$data['estimate_bills']	= false;
				$data['bill_payments']	= false;
				$data['receipts'] 		= false;
				$data['opening_balance']= false;
				$data['journals']		= false;
				$this->template->build('reports/receipt_reports',$data);
			}
		}

		//PAYMENT RECEIPT REPORT
		public function payment_reports(){
			if($this->input->post()){
				$data = $this->input->post();
				$data['report_type'] = "supplier";
				if($data['supplier_id']){
					$data['supplier_name'] = $this->common->get_particular('mst_suppliers',array('supplier_id' => $data['supplier_id']),'supplier_name');
				}
				$data['payments'] 				= $this->reports->get_payments($data);
				$data['purchase_bills']			= $this->reports->get_purchase_payments($data);
				$data['purchase_bill_payments']	= $this->reports->get_purchase_bill_payments($data);
				$data['journals']				= $this->reports->get_journals($data);
				$data['opening_balance']		= $this->reports->get_payment_opening_balance($data);
				//echo "<pre>";print_r($data);exit;
				if($data['option'] == 'view'){
					$this->template->build('reports/payment_reports',$data);
				}else{
					$html = $this->load->view('reports/payment_reports_print',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('payment_reports.pdf','I');
				}
			}else{
				$data['payments'] 		= false;
				$data['bills'] 			= false;
				$data['bill_payments']	= false;
				$data['opening_balance']= false;
				$data['journals']		= false;
				$this->template->build('reports/payment_reports',$data);
			}
		}

		public function day_report(){
			if($this->input->post()){
				$data = $this->input->post();
				//echo "<pre>";print_r($data);//exit;
				$data['sales'] = $this->reports->get_day_sales_report($data);
				$data['purchases'] = $this->reports->get_day_purchase_report($data);
				if($data['payment_type'] == "cash"){
					$data['expenses'] = $this->reports->get_day_expense_report($data);
				}else{
					$data['expenses'] = $this->reports->get_day_expense_report($data);
				}
				$data['payments'] = $this->reports->get_day_payment_report($data);
				$data['purchase_payments'] = $this->reports->get_day_purchase_payment_report($data);
				// previous sales start
				$data['previous_sales'] = $this->reports->get_day_previous_sales_report($data);
				$data['previous_purchases'] = 
				$this->reports->get_day_previous_purchase_report($data);
				if($data['payment_type'] == "cash"){
					$data['previous_expenses'] = 
					$this->reports->get_day_previous_expense_report($data);
				}else{
					$data['previous_expenses'] = $this->reports->get_day_previous_expense_report($data);
				}
				$data['previous_payments'] = $this->reports->get_day_previous_payment_report($data);
				$data['previous_purchase_payments'] = 
				$this->reports->get_day_previous_purchase_payment_report($data);
				//echo "<pre>";print_r($data);exit;
				if($data['option'] == 'view'){
					$this->template->build('reports/day_report',$data);
				}else{
					$html = $this->load->view('reports/day_report_print',$data,true);
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->WriteHTML($html);
					$pdf->Output('sales_reports.pdf','I');
				}
			}else{
				$data['sales'] = false;
				$data['purchases'] = false;
				//$data['journals'] = false;
				$data['expenses'] = false;
				$data['payments'] = false;
				$data['purchase_payments'] = false;
				$data['previous_purchases'] = false;
				$data['previous_expenses'] = false;
				$data['previous_journals_customer'] = false;
				$data['previous_sales'] = false;
				$data['previous_payments'] = false;
				$data['previous_purchase_payments'] = false;
				$data['previous_journals_supplier'] = false;
				$this->template->build('reports/day_report',$data);
			}
		}
	}