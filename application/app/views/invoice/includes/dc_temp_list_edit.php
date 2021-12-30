<?php 
if($lists){
	if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')!= 1)){
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['tax_percent'].'</td>
				<td style="text-align : right;">&#8377;'.MoneyFormatIndia($list['total']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id[]" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}elseif(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['category_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['tax_percent'].'</td>
				<td style="text-align : right;">'.MoneyFormatIndia($list['total']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id[]" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}else{
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['tax_percent'].'</td>
				<td style="text-align : right;">'.MoneyFormatIndia($list['total']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id[]" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}
	}elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_productwise_discount'),'invoice_settings_value')== 1)){
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($key).'" name="dc_id['.next_number($key).']" id="add_dc_id'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($key).'" name="dc_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($key).'" name="invoice_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($key).'" name="rate['.next_number($key).']" id="add_invoice_rate'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate'].'" readonly></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($key).'" name="discount_percentage['.next_number($key).']" id="add_invoice_productwise_discount'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['discount_percentage'].'"></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($key).'" name="after_discount_price['.next_number($key).']" id="after_discount_price'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate']*$list['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($key).'" name="tax_percentage['.next_number($key).']" id="add_invoice_tax_value'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['tax_percent'].'" readonly>
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($key).'" name="tax_total['.next_number($key).']" id="add_invoice_tax_total'.next_number($key).'" data-id="'.next_number($key).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($key).'" name="final_total['.next_number($key).']" id="add_invoice_total'.next_number($key).'" data-id="'.next_number($key).'" value="'.MoneyFormatIndia($list['total']).'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id['.next_number($key).']" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" style="width:15px;" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}elseif(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['category_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($key).'" name="dc_id['.next_number($key).']" id="add_dc_id'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($key).'" name="dc_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($key).'" name="invoice_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($key).'" name="rate['.next_number($key).']" id="add_invoice_rate'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate'].'" readonly></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($key).'" name="discount_percentage['.next_number($key).']" id="add_invoice_productwise_discount'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['discount_percentage'].'"></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($key).'" name="after_discount_price['.next_number($key).']" id="after_discount_price'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate']*$list['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($key).'" name="tax_percentage['.next_number($key).']" id="add_invoice_tax_value'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['tax_percent'].'" readonly>
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($key).'" name="tax_total['.next_number($key).']" id="add_invoice_tax_total'.next_number($key).'" data-id="'.next_number($key).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($key).'" name="final_total['.next_number($key).']" id="add_invoice_total'.next_number($key).'" data-id="'.next_number($key).'" value="'.MoneyFormatIndia($list['total']).'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id['.next_number($key).']" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" style="width:15px;" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}else{
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($key).'" name="dc_id['.next_number($key).']" id="add_dc_id'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($key).'" name="dc_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($key).'" name="invoice_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($key).'" name="rate['.next_number($key).']" id="add_invoice_rate'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate'].'" readonly></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($key).'" name="discount_percentage['.next_number($key).']" id="add_invoice_productwise_discount'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['discount_percentage'].'"></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($key).'" name="after_discount_price['.next_number($key).']" id="after_discount_price'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate']*$list['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($key).'" name="tax_percentage['.next_number($key).']" id="add_invoice_tax_value'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['tax_percent'].'" readonly>
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($key).'" name="tax_total['.next_number($key).']" id="add_invoice_tax_total'.next_number($key).'" data-id="'.next_number($key).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($key).'" name="final_total['.next_number($key).']" id="add_invoice_total'.next_number($key).'" data-id="'.next_number($key).'" value="'.MoneyFormatIndia($list['total']).'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id['.next_number($key).']" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" style="width:15px;" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}
	}elseif(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_discount'),'invoice_settings_value')== 1)&&($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_overall_discount'),'invoice_settings_value')== 1)){
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($key).'" name="dc_id['.next_number($key).']" id="add_dc_id'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($key).'" name="dc_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($key).'" name="invoice_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($key).'" name="rate['.next_number($key).']" id="add_invoice_rate'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate'].'" readonly></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($key).'" name="discount_percentage['.next_number($key).']" id="add_invoice_productwise_discount'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['discount_percentage'].'"></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($key).'" name="after_discount_price['.next_number($key).']" id="after_discount_price'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate']*$list['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($key).'" name="tax_percentage['.next_number($key).']" id="add_invoice_tax_value'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['tax_percent'].'" readonly>
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($key).'" name="tax_total['.next_number($key).']" id="add_invoice_tax_total'.next_number($key).'" data-id="'.next_number($key).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($key).'" name="final_total['.next_number($key).']" id="add_invoice_total'.next_number($key).'" data-id="'.next_number($key).'" value="'.MoneyFormatIndia($list['total']).'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id['.next_number($key).']" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" style="width:15px;" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}elseif(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['category_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($key).'" name="dc_id['.next_number($key).']" id="add_dc_id'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($key).'" name="dc_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($key).'" name="invoice_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($key).'" name="rate['.next_number($key).']" id="add_invoice_rate'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate'].'" readonly></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($key).'" name="discount_percentage['.next_number($key).']" id="add_invoice_productwise_discount'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['discount_percentage'].'"></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($key).'" name="after_discount_price['.next_number($key).']" id="after_discount_price'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate']*$list['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($key).'" name="tax_percentage['.next_number($key).']" id="add_invoice_tax_value'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['tax_percent'].'" readonly>
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($key).'" name="tax_total['.next_number($key).']" id="add_invoice_tax_total'.next_number($key).'" data-id="'.next_number($key).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($key).'" name="final_total['.next_number($key).']" id="add_invoice_total'.next_number($key).'" data-id="'.next_number($key).'" value="'.MoneyFormatIndia($list['total']).'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id['.next_number($key).']" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" style="width:15px;" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}else{
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td style="text-align : right;">
				<input type="hidden" class="add_dc_id'.next_number($key).'" name="dc_id['.next_number($key).']" id="add_dc_id'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['dc_id'].'" readonly>
				<input type="hidden" class="add_invoice_dc_quantity add_invoice_dc_quantity'.next_number($key).'" name="dc_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				<input type="text" class="add_invoice_quantity add_invoice_quantity'.next_number($key).'" name="invoice_quantity['.next_number($key).']" id="add_invoice_quantity'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['quantity'].'" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_rate add_invoice_rate'.next_number($key).'" name="rate['.next_number($key).']" id="add_invoice_rate'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate'].'" readonly></td>
				<td><input type="text" class="add_invoice_productwise_discount add_invoice_productwise_discount'.next_number($key).'" name="discount_percentage['.next_number($key).']" id="add_invoice_productwise_discount'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['discount_percentage'].'"></td>
				<td><input type="text" class="after_discount_price after_discount_price'.next_number($key).'" name="after_discount_price['.next_number($key).']" id="after_discount_price'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['rate']*$list['quantity'].'"></td>
				<td><input type="text" class="add_invoice_tax_value add_invoice_tax_value'.next_number($key).'" name="tax_percentage['.next_number($key).']" id="add_invoice_tax_value'.next_number($key).'" data-id="'.next_number($key).'" value="'.$list['tax_percent'].'" readonly>
				<input type="hidden" class="add_invoice_tax_total add_invoice_tax_total'.next_number($key).'" name="tax_total['.next_number($key).']" id="add_invoice_tax_total'.next_number($key).'" data-id="'.next_number($key).'" value="" readonly>
				</td>
				<td style="text-align : right;"><input type="text" class="add_invoice_total add_invoice_total'.next_number($key).'" name="final_total['.next_number($key).']" id="add_invoice_total'.next_number($key).'" data-id="'.next_number($key).'" value="'.MoneyFormatIndia($list['total']).'" readonly></td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id['.next_number($key).']" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" style="width:15px;" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}
	}else{
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td style="text-align : right;">'.MoneyFormatIndia($list['rate']*$list['quantity']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id[]" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}elseif(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['category_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td style="text-align : right;">'.MoneyFormatIndia($list['rate']*$list['quantity']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id[]" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}else{
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td style="text-align : right;">'.MoneyFormatIndia($list['rate']*$list['quantity']).'</td>
				<td style="border: 1px solid #dee2e6;text-align:center;">
				<input type="hidden" name="dc_relation_id[]" id="dc_check_box" class="form-control dc_check_box_edit dc_check_box_edit'.next_number($key).'" data-id="'.next_number($key).'" value='.$list['dc_relation_id'].' >
				</td>
				</tr>';
				$key = next_number($key);
			}
		}
	}
}else{
	echo '<tr>
	<td colspan="7">No Products Found</td>
	</tr>';
}
?>
