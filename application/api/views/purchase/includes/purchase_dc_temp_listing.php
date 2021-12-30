<?php 
if($purchase_dc_details){ 
	foreach ($purchase_dc_details as $key => $purchase_dc_detail) {
		echo '<tr>
		<td>'.next_number($count).'</td>
		<td class="style="width:10px;"><input type="text" class="add_product_dc_no'.next_number($count).'" name="dc_no['.next_number($count).']" id="add_product_dc_no'.next_number($count).'" value="'.$purchase_dc_no.'" data-id="'.next_number($count).'" readonly>
			<input type="hidden" name="purchase_dc_id['.next_number($count).']" value="'.$purchase_dc_detail['purchase_dc_id'].'">
			<input type="hidden" name="purchase_dc_relation_id['.next_number($count).']" value="'.$purchase_dc_detail['purchase_dc_relation_id'].'">
		</td>
		<td style="width: 250px;">'.$purchase_dc_detail['product_name'].'
		<input type="hidden"  name="product_id['.next_number($count).']" value="'.$purchase_dc_detail['product_id'].'"> 
		<input type="hidden" value="'.$purchase_dc_detail['purchase_dc_relation_id'].'" class="purchase_dc_detail purchase_dc_detail'.next_number($count).'">
		</td>
		<td>'.$purchase_dc_detail['brand_name'].'
		<input type="hidden"  name="brand_name['.next_number($count).']" value="'.$purchase_dc_detail['brand_name'].'"></td>
		<td><input type="text" class="add_product_quantity'.next_number($count).'" name="quantity['.next_number($count).']" id="add_product_quantity'.next_number($count).'" data-id="'.next_number($count).'" value="'.$purchase_dc_detail['quantity'].'" readonly></td>
		<td><input type="text" class="add_product_rate add_product_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_product_rate'.next_number($count).'" value="'.$purchase_dc_detail['rate'].'" data-id="'.next_number($count).'"></td>
		<td><input type="text" class="add_product_amount add_product_amount'.next_number($count).'" name="amount['.next_number($count).']" id="add_product_amount'.next_number($count).'" value="'.$purchase_dc_detail['amount'].'" data-id="'.next_number($count).'"></td>
		<td style="width: 250px;">
			<select class="form-control add_purchase_tax add_purchase_tax'.next_number($count).'" name="tax_id['.next_number($count).']" id="tax_id'.next_number($count).'" data-id="'.next_number($count).'" value="'.$purchase_dc_detail['tax_percentage'].'">'.taxs($purchase_dc_detail['tax_id']).'</select>
			<input type="hidden" value="'.$purchase_dc_detail['tax_percentage'].'" name="tax_percentage['.next_number($count).']" class="tax_percentage tax_percentage'.next_number($count).'">
			<input type="hidden" value="'.$purchase_dc_detail['tax_id'].'" name="tax_id_new['.next_number($count).']" class="tax_id tax_id'.next_number($count).'">
		</td>
		<td><input type="text" class="add_product_tax_value add_product_tax_value'.next_number($count).'" name="tax['.next_number($count).']" id="add_product_tax'.next_number($count).'" value="'.$purchase_dc_detail['tax_total'].'" data-id="'.next_number($count).'"></td>
		<td><input type="text" class="add_product_total add_product_total'.next_number($count).'" name="total['.next_number($count).']" id="add_product_total'.next_number($count).'" value="'.$purchase_dc_detail['total'].'" data-id="'.next_number($count).'"></td>
		<td><a href="#" class="btn btn-danger temp_purchase_remove" data-id="'.$purchase_dc_detail['purchase_dc_relation_id'].'"><i class="fa fa-trash"></i></a></td>
		</tr>';
		$count = next_number($count);
	}
}else{ 
	echo '<tr>
	<td colspan="8">No Products Found</td>
	</tr>';
}
?>