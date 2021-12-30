<?php
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
function product_image($image = '' , $type ="print" ){
	if($image != ''){
		$image_link = base_url('upload/'.$image);
	}else{
		$image_link = base_url('upload/no_image.jpg');
	}
	if($type == "print"){
		echo $image_link;
	}else{
		return $image_link;
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
function product($product_id = ''){
	$CI =& get_instance();
	$query = $CI->db->get('mst_products');
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
	$query = $CI->db->get('mst_products');
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
function state($state = ''){
	$CI =& get_instance();
	$query = $CI->db->get('mst_state');
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
function uom($uom_id = ''){
	$CI =& get_instance();
	$query = $CI->db->get('mst_uom');
	$options='<option selected value="">SELECT SECONDARY UNITS</option>';
	if($query->num_rows() > 0){
		$results = $query->result();
		if($uom_id!=''){
			foreach ($results as $key => $result) {
				if($result->uom_id == $uom_id){
					$options .='<option selected value="'.$result->uom_id.'">'.$result->uom_name.'</option>';
				}else{
					$options .='<option value="'.$result->uom_id.'">'.$result->uom_name.'</option>';
				}
			}
		}else{
			foreach ($results as $key => $result) {
				$options .='<option value="'.$result->uom_id.'">'.$result->uom_name.'</option>';
			}
		}
	}
	echo $options;
}
function units($unit_id = ''){
	$CI = & get_instance();
	$query = $CI->db->get('mst_units');
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
	$query = $CI->db->get('mst_sizes');
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
	$query = $CI->db->get('mst_colours');
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
	$query = $CI->db->get('mst_taxs');
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
	$query = $CI->db->get('mst_taxs');
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
	$query = $CI->db->get('mst_category');
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
	$query = $CI->db->get('mst_subcategory');
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
function tax_type($tax_type_id = ''){
	$CI = & get_instance();
	$query = $CI->db->get('mst_tax_type');
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
function payment_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">NOT RECEIVED</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PENDING</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
	);
	echo $status_array[$status];
}
function dc_status($status){
	$status_array = array(
		0 => '<span class="btn btn-danger" style="min-width: 104px;">CANCELED</span>' ,
		1 => '<span class="btn btn-warning" style="min-width: 104px;">PENDING</span>',
		2 => '<span class="btn btn-success" style="min-width: 104px;">COMPLETED</span>',
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