<?php
function asDollars($value) {
	if ($value<0) return "-".asDollars(-$value);
	return number_format($value, 2);
}
function message(){
	$CI =& get_instance();
	if(!empty($CI->session->userdata('msg'))){
		if($CI->session->userdata('msg')['result']== 'failed'){
			echo "<p class='alert alert-danger'>".$CI->session->userdata('msg')['message']."</p>";
		}elseif($CI->session->userdata('msg')['result']== 'warning'){
			echo "<p class='alert alert-warning'>".$CI->session->userdata('msg')['message']."</p>";
		}else{
			echo "<p class='alert alert-success'>".$CI->session->userdata('msg')['message']."</p>";
		}
		echo "<script> Notify('Thank You! All of your information saved successfully.', 'bottom-right', '5000', 'blue', 'fa-check', true); </script>";
//
		$CI->session->unset_userdata('msg');
	}
}
function return_message($message){
	if($message['result']== 'failed'){
		$list = "<p class='alert alert-danger'>".$message['message']."</p>";
	}elseif($message['result']== 'warning'){
		$list = "<p class='alert alert-warning'>".$message['message']."</p>";
	}else{
		$list = "<p class='alert alert-success'>".$message['message']."</p>";
	}
	return $list;
}
function payment_type($payment_type){
	if($payment_type == 'net_banking'){
		$type = "NET BANKING";
	}elseif ($payment_type == 'cheque') {
		$type = "CHEQUE";
	}elseif ($payment_type == 'upi_id') {
		$type = "UPI ID";
	}else{
		$type ="CASH";
	}
	return $type;
}

function created_on($format ='Y-m-d H:i:s'){
	return date($format);
}
function created_by(){
	$CI = &get_instance();
	return $CI->session->userdata('user_id');
}
function updated_on($format ='Y-m-d H:i:s'){
	return date($format);
}
function empty_datetime(){
	return '0000-00-00 00:00:00';
}
// function product_image($image = '' , $type ="print" ){
// 	if($image != ''){
// 		$image_link = base_url('upload/'.$image);
// 	}else{
// 		$image_link = base_url('upload/no_image.jpg');
// 	}
// 	if($type == "print"){
// 		echo $image_link;
// 	}else{
// 		return $image_link;
// 	}
// }
function product_image($image = ''){
	if($image != ''){
		echo base_url('upload/'.$image);
	}else{
		echo base_url('upload/no_image.jpg');
	}
}
function custom_implode($first,$second,$implode_value='-'){
	return $first.''.$implode_value.''.$second;
}
function next_number($number){
	$number = $number+1;
	return $number;
}
function convert_options($results,$value,$label,$option='',$additonallabelinfo=''){
	$options = '<option value=""> SELECT '.$option.'</option>';
	if($results){
		foreach ($results as $key => $result) {
			if($additonallabelinfo!=''){
				$options .= '<option value="'.$result[$value].'">'.$result[$label].'('.$result[$additonallabelinfo].')</options>';
			}else{
				$options .= '<option value="'.$result[$value].'">'.$result[$label].'</options>';
			}
		}
	}
	return $options;
}
function convert_options_selected($results,$value,$label,$option,$selected=''){
	$options = '<option value=""> SELECT '.$option.'</option>';
	if($results){
		foreach ($results as $key => $result) {
			$select = '';
			if($selected == $result[$value]){
				$select = 'selected';
			}
			$options .= '<option '.$select.' value="'.$result[$value].'">'.$result[$label].'</options>';
		}
	}
	return $options;
}
function company($company_id = ''){
	$CI = & get_instance();
	$CI->db->from('company_details');
	$CI->db->where('company_status!=',0);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT COMPANY</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($company_id!=""){
			foreach ($results as $key => $result) {
				if($result->company_id == $company_id){
					$options .= '<option selected value="'.$result->company_id.'">
					'.$result->company_name.'</option>';
				}else{
					$options .= '<option value="'.$result->company_id.'">'.$result->company_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->company_id.'">'.$result->company_name.'</option>';
			}
		}
	}
	echo $options;
}
function branch($branch_id = ''){
	$CI = & get_instance();
	$query = $CI->db->get('mst_branches');
	$options = '<option selected value="">SELECT BRANCH</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($branch_id!=""){
			foreach ($results as $key => $result) {
				if($result->branch_id == $branch_id){
					$options .= '<option selected value="'.$result->branch_id.'">
					'.$result->branch_name.'-'.$result->branch_location.'</option>';
				}else{
					$options .= '<option value="'.$result->branch_id.'">'.$result->branch_name.'-'.$result->branch_location.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->branch_id.'">'.$result->branch_name.'-'.$result->branch_location.'</option>';
			}
		}
	}
	echo $options;
}
function access_name($access_name_id = ''){
	$CI = & get_instance();
	$query = $CI->db->get('mst_access_names');
	$options = '<option selected value="">SELECT ACCESS NAME</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($access_name_id!=""){
			foreach ($results as $key => $result) {
				if($result->access_name_id == $access_name_id){
					$options .= '<option selected value="'.$result->access_name_id.'">
					'.$result->access_name.'</option>';
				}else{
					$options .= '<option value="'.$result->access_name_id.'">'.$result->access_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->access_name_id.'">'.$result->access_name.'</option>';
			}
		}
	}
	echo $options;
}
function product($product_id = ''){
	$CI =& get_instance();
	$CI->db->from('mst_products');
	$CI->db->where('product_type_base_value',1);
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options='<option selected value="">SELECT PRODUCT</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($product_id!=''){
			foreach ($results as $key => $result) {
				if($result->product_id == $product_id){
					$options .='<option selected value="'.$result->product_id.'">'.$result->product_name.'</option>';
				}else{
					$options .='<option value="'.$result->product_id.'">'.$result->product_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .='<option value="'.$result->product_id.'">'.$result->product_name.'</option>';
			}
		}
	}
	echo $options;
}
function purchase_product($product_id = ''){
	$CI =& get_instance();
	$CI->db->from('mst_products');
	$CI->db->where('product_type_base_value!=',1);
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options='<option selected value="">SELECT PRODUCT</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($product_id!=''){
			foreach ($results as $key => $result) {
				if($result->product_id == $product_id){
					$options .='<option selected value="'.$result->product_id.'">'.$result->product_name.'</option>';
				}else{
					$options .='<option value="'.$result->product_id.'">'.$result->product_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .='<option value="'.$result->product_id.'">'.$result->product_name.'</option>';
			}
		}
	}
	echo $options;
}
function products($product_id = ''){
	$CI =& get_instance();
	$CI->db->from('mst_products');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options='<option selected value="">SELECT PRODUCT</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($product_id!=''){
			foreach ($results as $key => $result) {
				if($result->product_id == $product_id){
					$options .='<option selected value="'.$result->product_id.'">'.$result->product_name.'</option>';
				}else{
					$options .='<option value="'.$result->product_id.'">'.$result->product_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .='<option value="'.$result->product_id.'">'.$result->product_name.'</option>';
			}
		}
	}
	return $options;
}
function product_type($product_type_id = ''){
	$CI =& get_instance();
	$CI->db->from('mst_product_type');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options='<option selected value="">SELECT PRODUCT TYPE</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($product_type_id!=''){
			foreach ($results as $key => $result) {
				if($result->product_type_id == $product_type_id){
					$options .='<option selected value="'.$result->product_type_id.'">'.$result->product_type_name.'</option>';
				}else{
					$options .='<option value="'.$result->product_type_id.'">'.$result->product_type_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .='<option value="'.$result->product_type_id.'">'.$result->product_type_name.'</option>';
			}
		}
	}
	echo $options;
}
function state($state = ''){
	$CI =& get_instance();
	$CI->db->from('mst_state');
	$query = $CI->db->get();
	$options='<option selected value="">SELECT STATE</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($state!=''){
			foreach ($results as $key => $result) {
				if($result->state_code == $state){
					$options .='<option selected value="'.$result->state_code.'">'.$result->state_name.'</option>';
				}else{
					$options .='<option value="'.$result->state_code.'">'.$result->state_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .='<option value="'.$result->state_code.'">'.$result->state_name.'</option>';
			}
		}
	}
	echo $options;
}

function units($unit_id = ''){
	$CI = & get_instance();
	$CI->db->from('mst_units');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT UNITS</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($unit_id!=""){
			foreach ($results as $key => $result) {
				if($result->unit_id == $unit_id){
					$options .= '<option selected value="'.$result->unit_id.'">'.$result->unit_name.'</option>';
				}else{
					$options .= '<option value="'.$result->unit_id.'">'.$result->unit_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->unit_id.'">'.$result->unit_name.'</option>';
			}
		}
	}
	echo $options;
}
function size($size_id = ''){
	$CI = & get_instance();
	$CI->db->from('mst_sizes');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT SIZE</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($size_id!=""){
			foreach ($results as $key => $result) {
				if($result->size_id == $size_id){
					$options .= '<option selected value="'.$result->size_id.'">'.$result->size_name.'</option>';
				}else{
					$options .= '<option value="'.$result->size_id.'">'.$result->size_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->size_id.'">'.$result->size_name.'</option>';
			}
		}
	}
	echo $options;
}
function colours($colour_id = ''){
	$CI = & get_instance();
	$CI->db->from('mst_colours');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT COLOUR</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($colour_id!=""){
			foreach ($results as $key => $result) {
				if($result->colour_id == $colour_id){
					$options .= '<option selected value="'.$result->colour_id.'">'.$result->colour_name.'</option>';
				}else{
					$options .= '<option value="'.$result->colour_id.'">'.$result->colour_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->colour_id.'">'.$result->colour_name.'</option>';
			}
		}
	}
	echo $options;
}
function tax($tax_id = ''){
	$CI = & get_instance();
	$CI->db->from('mst_taxs');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT TAX</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($tax_id!=""){
			foreach ($results as $key => $result) {
				if($result->tax_id == $tax_id){
					$options .= '<option selected value="'.$result->tax_id.'">'.$result->tax_percentage.'</option>';
				}else{
					$options .= '<option value="'.$result->tax_id.'">'.$result->tax_percentage.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->tax_id.'">'.$result->tax_percentage.'</option>';
			}
		}
	}
	echo $options;
}
function taxs($tax_id = ''){
	$CI = & get_instance();
	$CI->db->from('mst_taxs');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT TAX</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($tax_id!=""){
			foreach ($results as $key => $result) {
				if($result->tax_id == $tax_id){
					$options .= '<option selected value="'.$result->tax_id.'">'.$result->tax_percentage.'%</option>';
				}else{
					$options .= '<option value="'.$result->tax_id.'">'.$result->tax_percentage.'%</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->tax_id.'">'.$result->tax_percentage.'%</option>';
			}
		}
	}
	return $options;
}
function brand($brand_id = ''){
	$CI = &get_instance();
	$CI->db->select('*');
	$CI->db->from('mst_brands a');
	$CI->db->where('a.status',1);
	$query = $CI->db->get();
	$options = '<option value="">SELECT BRAND</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		foreach ($results as $key => $result) {
			if($brand_id!=''){
				if($brand_id == $result->brand_id){
					$selected='selected';
				}else{
					$selected='';
				}
			}else{
				$selected='';
			}
			$options .= '<option '.$selected.' value="'.$result->brand_id.'">'.$result->brand_name.'</option>';
		}
	}
	echo $options;
}
function category($category_id = ''){
	$CI = & get_instance();
	$CI->db->from('mst_category');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT CATEGORY</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($category_id!=""){
			foreach ($results as $key => $result) {
				if($result->category_id == $category_id){
					$options .= '<option selected value="'.$result->category_id.'">'.$result->category_name.'</option>';
				}else{
					$options .= '<option value="'.$result->category_id.'">'.$result->category_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->category_id.'">'.$result->category_name.'</option>';
			}
		}
	}
	echo $options;
}
function sub_category($sub_category_id = ''){
	$CI = & get_instance();
	$CI->db->from('mst_subcategory');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT SUB CATEGORY</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($sub_category_id!=""){
			foreach ($results as $key => $result) {
				if($result->sub_category_id == $sub_category_id){
					$options .= '<option selected value="'.$result->sub_category_id.'">'.$result->sub_category_name.'</option>';
				}else{
					$options .= '<option value="'.$result->sub_category_id.'">'.$result->sub_category_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->sub_category_id.'">'.$result->sub_category_name.'</option>';
			}
		}
	}
	echo $options;
}
function secondary_unit($secondary_unit_id = ''){
	$CI =& get_instance();
	$CI->db->from('mst_secondary_units');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options='<option selected value="">SELECT SECONDARY UNITS</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($secondary_unit_id!=''){
			foreach ($results as $key => $result) {
				if($result->secondary_unit_id == $secondary_unit_id){
					$options .='<option selected value="'.$result->secondary_unit_id.'">'.$result->secondary_unit_name.'</option>';
				}else{
					$options .='<option value="'.$result->secondary_unit_id.'">'.$result->secondary_unit_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .='<option value="'.$result->secondary_unit_id.'">'.$result->secondary_unit_name.'</option>';
			}
		}
	}
	echo $options;
}
function tax_type($tax_type_id = ''){
	$CI = & get_instance();
	$CI->db->from('mst_tax_type');
	$CI->db->where('status',1);
	$query = $CI->db->get();
	$options = '<option selected value="">SELECT TAX TYPE</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($tax_type_id!=""){
			foreach ($results as $key => $result) {
				if($result->tax_type_id == $tax_type_id){
					$options .= '<option selected value="'.$result->tax_type_id.'">'.$result->tax_type.'</option>';
				}else{
					$options .= '<option value="'.$result->tax_type_id.'">'.$result->tax_type.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .= '<option value="'.$result->tax_type_id.'">'.$result->tax_type.'</option>';
			}
		}
	}
	echo $options;
}
function suppliers($supplier_id = ''){
	$CI =& get_instance();
	$CI->db->where('status',1);
	$CI->db->order_by('supplier_name','asc');
	$query = $CI->db->get('mst_suppliers');
	$options='<option value="">SELECT SUPPLIER</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		foreach ($results as $key => $result) {
			$selected = '';
			if($supplier_id!=''){
				if($result->supplier_id == $supplier_id){
					$selected = 'selected';
				}
			}
			$options .='<option '.$selected.' value="'.$result->supplier_id.'">'.$result->supplier_name.'-'.$result->supplier_mobile.'</option>';
		}
	}
	echo $options;
}
function return_suppliers($supplier_id = ''){
	$CI =& get_instance();
	$CI->db->where('status',1);
	$CI->db->order_by('supplier_name','asc');
	$query = $CI->db->get('mst_suppliers');
	$options='<option value="">SELECT SUPPLIER</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		foreach ($results as $key => $result) {
			$selected = '';
			if($supplier_id!=''){
				if($result->supplier_id == $supplier_id){
					$selected = 'selected';
				}
			}
			$options .='<option '.$selected.' value="'.$result->supplier_id.'">'.$result->supplier_name.'-'.$result->supplier_mobile.'</option>';
		}
	}
	return $options;
}
function customers($customer_id = ''){
	$CI =& get_instance();
	$CI->db->where('status',1);
	$CI->db->order_by('customer_name','asc');
	$query = $CI->db->get('mst_customers');
	$options='<option value="">SELECT CUSTOMER</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		foreach ($results as $key => $result) {
			$selected = '';
			if($customer_id!=''){
				if($result->customer_id == $customer_id){
					$selected = 'selected';
				}
			}
			$options .='<option '.$selected.' value="'.$result->customer_id.'">'.$result->customer_name.'-'.$result->customer_phone.'</option>';
		}
	}
	echo $options;
}
function return_customers($customer_id = ''){
	$CI =& get_instance();
	$CI->db->where('status',1);
	$CI->db->order_by('customer_name','asc');
	$query = $CI->db->get('mst_customers');
	$options='<option value="">SELECT CUSTOMER</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		foreach ($results as $key => $result) {
			$selected = '';
			if($customer_id!=''){
				if($result->customer_id == $customer_id){
					$selected = 'selected';
				}
			}
			$options .='<option '.$selected.' value="'.$result->customer_id.'">'.$result->customer_name.'-'.$result->customer_phone.'</option>';
		}
	}
	return $options;
}
function customer_type($customer_type_id = ''){
	$CI =& get_instance();
	$CI->db->where('status',1);
	$query = $CI->db->get('mst_customer_type');
	$options='<option value="">SELECT SALES TYPE</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		foreach ($results as $key => $result) {
			$selected = '';
			if($customer_type_id!=''){
				if($result->customer_type_id == $customer_type_id){
					$selected = 'selected';
				}
			}
			$options .='<option '.$selected.' value="'.$result->customer_type_id.'">'.$result->customer_type.'</option>';
		}
	}
	echo $options;
}
function users($user_id = ''){
	$CI =& get_instance();
	$CI->db->where('status',1);
	$CI->db->order_by('name','asc');
	$query = $CI->db->get('mst_users');
	$options='<option value="">SELECT PERSON</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		foreach ($results as $key => $result) {
			$selected = '';
			if($user_id!=''){
				if($result->user_id == $user_id){
					$selected = 'selected';
				}
			}
			$options .='<option '.$selected.' value="'.$result->user_id.'">'.$result->name.'</option>';
		}
	}
	echo $options;
}
function buyers_po_excel_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">CANCELLED</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PENDING</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
	);
	echo $status_array[$status];
}
function payment_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">NOT RECEIVED</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PENDING</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
	);
	echo $status_array[$status];
}
function purchase_payment_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">NOT PAID</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PENDING</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
	);
	echo $status_array[$status];
}
function auto_dc_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">PENDING</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PARTIALLY COMPLETED</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
	);
	echo $status_array[$status];
}
function return_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">PENDING</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PARTIALLY COMPLETED</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
	);
	echo $status_array[$status];
}
function dc_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">CANCELLED</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PENDING</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
	);
	echo $status_array[$status];
}
function invoice_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">CANCELLED</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PENDING</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
	);
	echo $status_array[$status];
}
function quotation_status($status){
	$status_array = array(
		0 => '<span class="btn btn-info" style="min-width: 104px;">PENDING</span>' ,
		1 => '<span class="btn btn-danger" style="min-width: 104px;">CANCELLED</span>',
		2 => '<span class="btn btn-danger" style="min-width: 104px;">DELETED</span>',
	);
	echo $status_array[$status];
}
function quotation_dc_status($status){
	$status_array = array(
		0 => '<span class="btn btn-info" style="min-width: 104px;">PENDING</span>' ,
		1 => '<span class="btn btn-danger" style="min-width: 104px;">QUOTATION CANCELLED</span>',
		2 => '<span class="btn btn-danger" style="min-width: 104px;">DELETED</span>',
	);
	echo $status_array[$status];
}
function estimate_status($status){
	$status_array = array(
		0 => '<span class="btn btn-info" style="min-width: 104px;">PENDING</span>' ,
		1 => '<span class="btn btn-danger" style="min-width: 104px;">CANCELLED</span>',
		2 => '<span class="btn btn-danger" style="min-width: 104px;">DELETED</span>',
	);
	echo $status_array[$status];
}
function estimate_dc_status($status){
	$status_array = array(
		0 => '<span class="btn btn-info" style="min-width: 104px;">PENDING</span>' ,
		1 => '<span class="btn btn-danger" style="min-width: 104px;">ESTIMATE CANCELLED</span>',
		2 => '<span class="btn btn-danger" style="min-width: 104px;">DELETED</span>',
	);
	echo $status_array[$status];
}
function expense_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">UNPAID</span>' ,
		1 => '<span class="btn btn-success" style="min-width: 104px;">PAID</span>',
	);
	echo $status_array[$status];
}
function transport_mode_options($select=''){
	$transport_modes = array(array('mode' => 'BY ROAD','default'=> 0 ),array('mode' => 'BY TRAIN','default'=> 0 ),array('mode' => 'BY AIR','default'=> 0 ),array('mode' => 'BY HAND','default'=> 0 ),array('mode' => 'BY COURIER','default'=> 0 ));
	$option_list='<option value ="">SELECT TRANSPORT MODE</option>';
	foreach ($transport_modes as $key => $transport_mode) {
		if($select !=''){
			if($select == $transport_mode['mode']){
				$selected ='selected';
			}else{
				$selected ='';
			}
		}else{
			if($transport_mode['default'] == 1){
				$selected ='selected';
			}else{
				$selected ='';
			}
		}
		$option_list .='<option '.$selected.' value="'.$transport_mode['mode'].'">'.$transport_mode['mode'].'</option>';
	}
	return $option_list;
}
function convert_number_to_words($number) {
	$no = round($number);
	$point = round($number - $no, 2) * 100;
	$hundred = null;
	$digits_1 = strlen($no);
	$i = 0;
	$str = array();
	$words = array(
		'0' => '',
		'1' => 'One',
		'2' => 'Two',
		'3' => 'Three',
		'4' => 'Four',
		'5' => 'Five',
		'6' => 'Six',
		'7' => 'Seven',
		'8' => 'Eight',
		'9' => 'Nine',
		'10' => 'Ten',
		'11' => 'Eleven',
		'12' => 'Twelve',
		'13' => 'Thirteen',
		'14' => 'Fourteen',
		'15' => 'Fifteen',
		'16' => 'Sixteen',
		'17' => 'Seventeen',
		'18' => 'Eighteen',
		'19' => 'Nineteen',
		'20' => 'Twenty',
		'30' => 'Thirty',
		'40' => 'Forty',
		'50' => 'Fifty',
		'60' => 'Sixty',
		'70' => 'Seventy',
		'80' => 'Eighty',
		'90' => 'Ninety'
	);
	$digits = array(
		'',
		'Hundred',
		'Thousand',
		'Lakh',
		'Crore'
	);
	while ($i < $digits_1) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += ($divider == 10) ? 1 : 2;
		if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
			$str [] = ($number < 21) ? $words[$number] .
			" " . $digits[$counter] . $plural . " " . $hundred
			:
			$words[floor($number / 10) * 10]
			. " " . $words[$number % 10] . " "
			. $digits[$counter] . $plural . " " . $hundred;
		} else $str[] = null;
	}
	$str = array_reverse($str);
	$result = implode('', $str);
	$points = ($point) ?
	"." . $words[$point / 10] . " " .
	$words[$point = $point % 10] : '';
	return $result . "Rupees  ";
}
function check_checked($current,$selected){
	if($current == $selected){
		echo "checked";
	}
}
function decimal_digit_maintainer($value){
	$value_array = explode('.',$value);
	if(isset($value_array[1])){
		$value_array[1] =  str_pad($value_array[1],AFTER_DESIMAL_DIGITS,'0',STR_PAD_RIGHT);
	}
	return implode('.',$value_array);
}
function digit_maintainer($value,$total_digits = 2){
	$value_array = explode('.',$value);
	if(isset($value_array[1])){
		$value_array[1] =  substr(str_pad($value_array[1],$total_digits,'0',STR_PAD_RIGHT), 0, $total_digits);
	}else{
		$value_array[1] = '00';
	}
	return implode('.',$value_array);
}
function MoneyFormatIndia($num) { 
	$minus = "";
	if(substr($num, 0, 1) == '-'){
		$minus = "-";
		$num = ltrim($num, '-');
	}
	$explrestunits = "";
	$amount = explode(".",$num);
	$num = $amount[0];
	if(strlen($num) > 3) {
		$lastthree = substr($num, strlen($num)-3, strlen($num));
		$restunits = substr($num, 0, strlen($num)-3);
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
        	if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
              } else {
              	$explrestunits .= $expunit[$i].",";
              }
            }
            $thecash = $explrestunits.$lastthree;
          } else {
          	$thecash = $num;
          }
          if(isset($amount[1])){
          	$amount[0] = $thecash;
          	$thecash = implode('.',$amount);
          }
          
    return digit_maintainer($minus.$thecash); // writes the final format where $currency is the currency symbol.
  }
  function multi_select($options,$name_field,$value_field,$selected_values){
  	$select_options = "";
  	if($options){
  		$select_array = array_filter(explode(',', $selected_values));
  		foreach ($options as $key => $option) {
  			$current_select = "";
  			if(!empty($select_array)){
  				if(in_array($option[$value_field],$select_array)){
  					$current_select = "selected";
  				}
  				$select_options .= '<option '.$current_select.' value="'.$option[$value_field].'">'.$option[$name_field].'</option>';
  			}else{
  				$select_options .= '<option value="'.$option[$value_field].'">'.$option[$name_field].'</option>';
  			}
  		}
  	}
  	return $select_options;
  }
  function get_latest_logs($limit = 5){
  	$CI = &get_instance();
  	$CI->db->select('a.*,b.log_category_name,c.name as created_by');
  	$CI->db->from('tbl_logs a');
  	$CI->db->join('tbl_log_category b','a.log_category_id = b.log_category_id');
  	$CI->db->join('mst_users c','a.user_id = c.user_id');
  	$CI->db->where('a.logs_status',0);
  	if($CI->session->userdata('access_level') > 1){
  		$CI->db->where('a.user_id',$CI->session->userdata('user_id'));
  	}
  	$CI->db->where('a.status',1);
  	$CI->db->order_by('a.log_id','desc');
  	$CI->db->limit($limit);
  	$query = $CI->db->get();
  	if($query->num_rows() > 0){
  		return $query->result_array();
  	}else{
  		return false;
  	}
  }
  function get_product_latest_logs($limit = 5){
  	$CI = &get_instance();
  	$CI->db->select('a.*,b.log_category_name,c.name as created_by');
  	$CI->db->from('tbl_logs a');
  	$CI->db->join('tbl_log_category b','a.log_category_id = b.log_category_id');
  	$CI->db->join('mst_users c','a.user_id = c.user_id');
  	$CI->db->where('a.logs_status',0);
  	$CI->db->where('a.log_category_id',20);
  	if($CI->session->userdata('access_level') > 1){
  		$CI->db->where('a.user_id',$CI->session->userdata('user_id'));
  	}
  	$CI->db->where('a.status',1);
  	$CI->db->order_by('a.log_id','desc');
  	$CI->db->limit($limit);
  	$query = $CI->db->get();
  	if($query->num_rows() > 0){
  		return $query->result_array();
  	}else{
  		return false;
  	}
  }
  function menu_list(){
  	$CI =& get_instance();
  	$CI->db->where('module_status',1);
  	$CI->db->order_by('module_order','asc');
  	$menus = $CI->db->get('mst_modules');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		foreach ($results as $key => $result) {
  			$CI->db->where('module_id',$result['module_id']);
  			$CI->db->where('status',1);
			//$CI->db->order_by('module_order');
  			$submenus = $CI->db->get('mst_sub_modules');
  			if($submenus->num_rows() > 0){
  				$results[$key]['submenus'] = $submenus->result_array();
  			}else{
  				$results[$key]['submenus'] = false;
  			}
  		}
  		return $results;
  	}else{
  		return false;
  	}
  }
  function module_list(){
  	$CI =& get_instance();
  	$CI->db->where('module_status',1);
  	$menus = $CI->db->get('mst_modules');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		foreach ($results as $key => $result) {
  			$CI->db->where('module_id',$result['module_id']);
  			$submenus = $CI->db->get('mst_sub_modules');
  			if($submenus->num_rows() > 0){
  				$results[$key]['submenus'] = $submenus->result_array();
  			}else{
  				$results[$key]['submenus'] = false;
  			}
  		}
		//echo "<pre>";print_r($results);exit;
  		return $results;
  	}else{
  		return false;
  	}
  }
  function module($module_id = ''){
  	$CI = & get_instance();
  	$query = $CI->db->get('mst_modules');
  	$options = '<option selected value="">SELECT MODULE</option>';
  	if($query->num_rows() > 0){
  		$results = $query->result();
  		if($module_id!=""){
  			foreach ($results as $key => $result) {
  				if($result->module_id == $module_id){
  					$options .= '<option selected value="'.$result->module_id.'">
  					'.$result->module_name.'</option>';
  				}else{
  					$options .= '<option value="'.$result->module_id.'">'.$result->module_name.'</option>';
  				}
  			}
  		}else{
  			foreach ($results as $key => $result) {
  				$options .= '<option value="'.$result->module_id.'">'.$result->module_name.'</option>';
  			}
  		}
  	}
  	echo $options;
  }
  function access_level_options($access_level_id = ''){
  	$CI = &get_instance();
  	$CI->db->select('*');
  	$CI->db->from('mst_access_levels a');
  	$CI->db->where('a.status',1);
  	$query = $CI->db->get();
  	$options = '<option value="">SELECT ACCESS NAME</option>';
  	if($query->num_rows() > 0){
  		$results = $query->result();
  		foreach ($results as $key => $result) {
  			if($access_level_id!=''){
  				if($access_level_id == $result->access_level_id){
  					$selected='selected';
  				}else{
  					$selected='';
  				}
  			}else{
  				$selected='';
  			}
  			$options .= '<option '.$selected.' value="'.$result->access_level_id.'">'.$result->access_level_name.'</option>';
  		}
  	}
  	echo $options;
  }
  function get_module_list(){
  	$CI =& get_instance();
	//$CI->db->where('module_status',1);
  	$menus = $CI->db->get('mst_modules');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		foreach ($results as $key => $result) {
  			$CI->db->where('module_id',$result['module_id']);
  			$submenus = $CI->db->get('mst_sub_modules');
  			if($submenus->num_rows() > 0){
  				$results[$key]['submenus'] = $submenus->result_array();
  			}else{
  				$results[$key]['submenus'] = false;
  			}
  		}
		//echo "<pre>";print_r($results);exit;
  		return $results;
  	}else{
  		return false;
  	}
  }
  function get_general_list(){
  	$CI =& get_instance();
  	$menus = $CI->db->get('mst_general_settings');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		return $results;
  	}else{
  		return false;
  	}
  }
  function get_invoice_settings_list(){
  	$CI =& get_instance();
  	$menus = $CI->db->get('mst_invoice_settings');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		return $results;
  	}else{
  		return false;
  	}
  }
  function get_estimate_settings_list(){
  	$CI =& get_instance();
  	$menus = $CI->db->get('mst_estimate_settings');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		return $results;
  	}else{
  		return false;
  	}
  }
  function get_quotation_settings_list(){
  	$CI =& get_instance();
  	$menus = $CI->db->get('mst_quotation_settings');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		return $results;
  	}else{
  		return false;
  	}
  }
  function get_purchase_settings_list(){
  	$CI =& get_instance();
  	$menus = $CI->db->get('mst_purchase_settings');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		return $results;
  	}else{
  		return false;
  	}
  }
  function get_product_settings_list(){
  	$CI =& get_instance();
  	$menus = $CI->db->get('mst_product_settings');
  	if($menus->num_rows() > 0){
  		$results = $menus->result_array();
  		return $results;
  	}else{
  		return false;
  	}
  }


