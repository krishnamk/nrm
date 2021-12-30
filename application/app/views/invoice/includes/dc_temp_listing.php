<?php  
if($dc_details){
	if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)){
		//echo "<pre>";print_r("1");exit;
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
				<td style="text-align : right;"><input type="text" class="add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
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
				<td style="text-align : right;"><input type="text" class="add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_cash_discount'),'invoice_settings_value')== 1)){
		//echo "<pre>";print_r("2");exit;
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
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
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
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){
		//echo "<pre>";print_r("3");exit;
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){ 
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$tax_total = ($pre_total) * $dc_detail['tax_percent']/100;
				$total = $pre_total + $tax_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td><
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($count).'" name="dc_id['.next_number($count).']" id="add_dc_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($count).'" name="dc_quantity['.next_number($count).']" id="add_invoice_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($count).'" name="invoice_quantity['.next_number($count).']" id="add_invoice_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['balance_quantity'].'">
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_invoice_rate'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate.'"></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($count).'" name="discount_percentage['.next_number($count).']" id="add_invoice_productwise_discount'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($count).'" name="after_discount_price['.next_number($count).']" id="after_discount_price'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate*$dc_detail['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($count).'" name="tax_percentage['.next_number($count).']" id="add_invoice_tax_value'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['tax_percent'].'">
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($count).'" name="tax_total['.next_number($count).']" id="add_invoice_tax_total'.next_number($count).'" data-id="'.next_number($count).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id['.next_number($count).']" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" style="width:15px;" data-id="'.next_number($count).'">
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
				<td>'.$dc_detail['product_name'].'</td><
				<td>'.$dc_detail['brand_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($count).'" name="dc_id['.next_number($count).']" id="add_dc_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($count).'" name="dc_quantity['.next_number($count).']" id="add_invoice_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($count).'" name="invoice_quantity['.next_number($count).']" id="add_invoice_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['balance_quantity'].'">
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_invoice_rate'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate.'"></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($count).'" name="discount_percentage['.next_number($count).']" id="add_invoice_productwise_discount'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($count).'" name="after_discount_price['.next_number($count).']" id="after_discount_price'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate*$dc_detail['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($count).'" name="tax_percentage['.next_number($count).']" id="add_invoice_tax_value'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['tax_percent'].'">
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($count).'" name="tax_total['.next_number($count).']" id="add_invoice_tax_total'.next_number($count).'" data-id="'.next_number($count).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id['.next_number($count).']" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" style="width:15px;" data-id="'.next_number($count).'">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){
		//echo "<pre>";print_r("4");//exit;
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				$tax_total = ($pre_total) * $dc_detail['tax_percent']/100;
				$total = $pre_total + $tax_total;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td><
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($count).'" name="dc_id['.next_number($count).']" id="add_dc_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($count).'" name="dc_quantity['.next_number($count).']" id="add_invoice_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($count).'" name="invoice_quantity['.next_number($count).']" id="add_invoice_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['balance_quantity'].'">
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_invoice_rate'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate.'"></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($count).'" name="discount_percentage['.next_number($count).']" id="add_invoice_productwise_discount'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($count).'" name="after_discount_price['.next_number($count).']" id="after_discount_price'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate*$dc_detail['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($count).'" name="tax_percentage['.next_number($count).']" id="add_invoice_tax_value'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['tax_percent'].'">
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($count).'" name="tax_total['.next_number($count).']" id="add_invoice_tax_total'.next_number($count).'" data-id="'.next_number($count).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id['.next_number($count).']" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" style="width:15px;" data-id="'.next_number($count).'">
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
				<td>'.$dc_detail['product_name'].'</td><
				<td>'.$dc_detail['brand_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($count).'" name="dc_id['.next_number($count).']" id="add_dc_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($count).'" name="dc_quantity['.next_number($count).']" id="add_invoice_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($count).'" name="invoice_quantity['.next_number($count).']" id="add_invoice_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['balance_quantity'].'">
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_invoice_rate'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate.'"></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($count).'" name="discount_percentage['.next_number($count).']" id="add_invoice_productwise_discount'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($count).'" name="after_discount_price['.next_number($count).']" id="after_discount_price'.next_number($count).'" data-id="'.next_number($count).'" value="'.$rate*$dc_detail['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($count).'" name="tax_percentage['.next_number($count).']" id="add_invoice_tax_value'.next_number($count).'" data-id="'.next_number($count).'" value="'.$dc_detail['tax_percent'].'">
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($count).'" name="tax_total['.next_number($count).']" id="add_invoice_tax_total'.next_number($count).'" data-id="'.next_number($count).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id['.next_number($count).']" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" style="width:15px;" data-id="'.next_number($count).'">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')!= 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_cash_discount'),'invoice_settings_value')== 1)){
		//echo "<pre>";print_r("5");exit;
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$pre_total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}else{
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				$pre_total = $dc_detail['quantity'] * $rate;
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($count).'" name="final_total['.next_number($count).']" id="add_invoice_total'.next_number($count).'" data-id="'.next_number($count).'" value="'.$pre_total.'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}
		
	}else{
		//echo "<pre>";print_r("6");exit;
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['category_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td style="text-align : right;">'.MoneyFormatIndia($rate*$dc_detail['quantity']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
				</td>
				</tr>';
				$count = next_number($count);
			}
		}else{
			foreach ($dc_details as $key => $dc_detail) {
				$rate = $this->common->get_particular('mst_products',array('product_id' => $dc_detail['product_id']),'product_mrp');
				echo '<tr>
				<td>'.next_number($count).'</td>
				<td>'.$dc_detail['product_name'].'</td>
				<td>'.$dc_detail['brand_name'].'</td>
				<td>'.$dc_detail['quantity'].'</td>
				<td>'.$rate.'</td>
				<td style="text-align : right;">'.MoneyFormatIndia($rate*$dc_detail['quantity']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="checkbox" name="dc_relation_id[]" id="dc_check_box" value='.$dc_detail['dc_relation_id'].' class="form-control dc_check_box dc_check_box'.next_number($count).'" data-id="'.next_number($count).'" style="width:15px;">
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
