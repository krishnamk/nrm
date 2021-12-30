<?php  
if($dc_details){
	if(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')!= 1)){
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ 
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$tax_total = ($pre_total) * $dc_detail['tax_percent']/100;
				$total = $pre_total + $tax_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td>'.$dc_detail['tax_percent'].'</td>
				<td style="text-align : right;"><input type="text" class="add_estimate_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_estimate_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}else{
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$tax_total = ($pre_total) * $dc_detail['tax_percent']/100;
				$total = $pre_total + $tax_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td>'.$dc_detail['tax_percent'].'</td>
				<td style="text-align : right;"><input type="text" class="add_estimate_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_estimate_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_cash_discount'),'estimate_settings_value')== 1)){
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ 
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$total = $pre_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td style="text-align : right;"><input type="text" class="add_estimate_total add_estimate_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_estimate_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}else{
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$total = $pre_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td style="text-align : right;"><input type="text" class="add_estimate_total add_estimate_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_estimate_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_productwise_discount'),'estimate_settings_value')== 1)){
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$total = $pre_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td><
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($count).'" name="dc_id['.next_number($count).']" id="add_dc_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['dc_id'].'" readonly>
				<input type="hidden" class="add_estimate_dc_quantity add_estimate_dc_quantity'.next_number($count).'" name="dc_quantity['.next_number($count).']" id="add_estimate_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['quantity'].'" readonly>
				<input type="text" class="add_estimate_quantity add_estimate_quantity'.next_number($count).'" name="estimate_quantity['.next_number($count).']" id="add_estimate_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['balance_quantity'].'">
				</td>
				<td style="text-align : right;"><input type="text" class="add_estimate_rate add_estimate_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_estimate_rate'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate.'"></td>
				<td><input type="text" class="add_estimate_productwise_discount add_estimate_productwise_discount'.next_number($count).'" name="discount_percentage['.next_number($count).']" id="add_estimate_productwise_discount'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($count).'" name="after_discount_price['.next_number($count).']" id="after_discount_price'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate*$dc_detail['quantity'].'"></td>
				<td style="text-align : right;"><input type="text" class="add_estimate_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_estimate_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id['.next_number($count).']" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" style="width:15px;" data-id="'.next_number($count).'">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}else{
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$total = $pre_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td><
				<td>'.$dc_detail['brand_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($count).'" name="dc_id['.next_number($count).']" id="add_dc_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['dc_id'].'" readonly>
				<input type="hidden" class="add_estimate_dc_quantity add_estimate_dc_quantity'.next_number($count).'" name="dc_quantity['.next_number($count).']" id="add_estimate_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['quantity'].'" readonly>
				<input type="text" class="add_estimate_quantity add_estimate_quantity'.next_number($count).'" name="estimate_quantity['.next_number($count).']" id="add_estimate_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['balance_quantity'].'">
				</td>
				<td style="text-align : right;"><input type="text" class="add_estimate_rate add_estimate_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_estimate_rate'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate.'"></td>
				<td><input type="text" class="add_estimate_productwise_discount add_estimate_productwise_discount'.next_number($count).'" name="discount_percentage['.next_number($count).']" id="add_estimate_productwise_discount'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($count).'" name="after_discount_price['.next_number($count).']" id="after_discount_price'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate*$dc_detail['quantity'].'"></td>
				<td style="text-align : right;"><input type="text" class="add_estimate_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_estimate_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id['.next_number($count).']" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" style="width:15px;" data-id="'.next_number($count).'">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}elseif(($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')!= 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_discount'),'estimate_settings_value')== 1)&&($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_overall_discount'),'estimate_settings_value')== 1)){
		//echo "<pre>";print_r("10");exit;
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			//echo "<pre>";print_r("11");exit;
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$total = $pre_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td><
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($count).'" name="dc_id['.next_number($count).']" id="add_dc_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['dc_id'].'" readonly>
				<input type="hidden" class="add_estimate_dc_quantity add_estimate_dc_quantity'.next_number($count).'" name="dc_quantity['.next_number($count).']" id="add_estimate_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['quantity'].'" readonly>
				<input type="text" class="add_estimate_quantity add_estimate_quantity'.next_number($count).'" name="estimate_quantity['.next_number($count).']" id="add_estimate_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['balance_quantity'].'">
				</td>
				<td style="text-align : right;"><input type="text" class="add_estimate_rate add_estimate_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_estimate_rate'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate.'"></td>
				<td><input type="text" class="add_estimate_productwise_discount add_estimate_productwise_discount'.next_number($count).'" name="discount_percentage['.next_number($count).']" id="add_estimate_productwise_discount'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($count).'" name="after_discount_price['.next_number($count).']" id="after_discount_price'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate*$dc_detail['quantity'].'"></td>
				<td style="text-align : right;"><input type="text" class="add_estimate_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_estimate_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id['.next_number($count).']" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" style="width:15px;" data-id="'.next_number($count).'">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}else{
			//echo "<pre>";print_r("12");exit;
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$total = $pre_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td><
				<td>'.$dc_detail['brand_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($count).'" name="dc_id['.next_number($count).']" id="add_dc_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['dc_id'].'" readonly>
				<input type="hidden" class="add_estimate_dc_quantity add_estimate_dc_quantity'.next_number($count).'" name="dc_quantity['.next_number($count).']" id="add_estimate_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['quantity'].'" readonly>
				<input type="text" class="add_estimate_quantity add_estimate_quantity'.next_number($count).'" name="estimate_quantity['.next_number($count).']" id="add_estimate_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['balance_quantity'].'">
				</td>
				<td style="text-align : right;"><input type="text" class="add_estimate_rate add_estimate_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_estimate_rate'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate.'"></td>
				<td><input type="text" class="add_estimate_productwise_discount add_estimate_productwise_discount'.next_number($count).'" name="discount_percentage['.next_number($count).']" id="add_estimate_productwise_discount'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($count).'" name="after_discount_price['.next_number($count).']" id="after_discount_price'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate*$dc_detail['quantity'].'"></td>
				<td style="text-align : right;"><input type="text" class="add_estimate_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_estimate_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id['.next_number($count).']" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" style="width:15px;" data-id="'.next_number($count).'">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}else{
		//echo "<pre>";print_r("16");exit;
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			//echo "<pre>";print_r("17");exit;
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td style="text-align : right;">&#8377;'.MoneyFormatIndia($rate*$dc_detail['quantity']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}else{
			//echo "<pre>";print_r("18");exit;
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td style="text-align : right;">&#8377;'.MoneyFormatIndia($rate*$dc_detail['quantity']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="estimate_dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control estimate_dc_check_box estimate_dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}	
		}
		
	}
}else{
	echo '<tr>
	<td colspan="7">No Products Found</td>
	</tr>';
}
?>
