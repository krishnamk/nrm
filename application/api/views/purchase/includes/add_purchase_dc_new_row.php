<?php 
echo '<tr> 
<td>'.next_number($count).'</td>
<td class="style="width:10px;"><input type="text" class="add_product_dc_no'.next_number($count).'" name="dc_no['.next_number($count).']" id="add_product_dc_no'.next_number($count).'" value="" data-id="'.next_number($count).'">
<input type="hidden" name="purchase_dc_relation_id['.next_number($count).']" value="0"></td>
<td style="width: 250px;"><select class="form-control add_purchase_product" name="product_id['.next_number($count).']" id="purchase_product'.next_number($count).'" data-id="'.next_number($count).'">'.products().'</select></td>
<td><input type="text" class="add_product_brand'.next_number($count).'" name="brand_name['.next_number($count).']" id="add_product_brand'.next_number($count).'" value="" data-id="'.next_number($count).'"></td>
<td><input type="text" class="add_product_quantity'.next_number($count).'" name="quantity['.next_number($count).']" id="add_product_quantity'.next_number($count).'" data-id="'.next_number($count).'" value=""></td>
<td><input type="text" class="add_product_rate'.next_number($count).'" name="rate['.next_number($count).']" id="add_product_rate'.next_number($count).'" value="" data-id="'.next_number($count).'"></td>
<td><input type="text" class="add_product_amount add_product_amount'.next_number($count).'" name="amount['.next_number($count).']" id="add_product_amount'.next_number($count).'" value="" data-id="'.next_number($count).'"></td>
<td style="width: 250px;"><select class="form-control add_purchase_tax add_purchase_tax" name="tax_id['.next_number($count).']" id="tax_id'.next_number($count).'" data-id="'.next_number($count).'">'.taxs().'</select> 
<input type="hidden" value="" name="tax_percentage['.next_number($count).']" class="tax_percentage tax_percentage'.next_number($count).'">
</td>
<td><input type="text" class="add_product_tax_value add_product_tax_value'.next_number($count).'" name="tax['.next_number($count).']" id="add_product_tax'.next_number($count).'" value="" data-id="'.next_number($count).'"></td>
<td><input type="text" class="add_product_total add_product_total'.next_number($count).'" name="total['.next_number($count).']" id="add_product_total'.next_number($count).'" value="" data-id="'.next_number($count).'"></td>
<td><a href="#" class="btn btn-danger remove_current_dc_row" id="remove_current_dc_row" data-id="'.next_number($count).'"><i class="fa fa-trash"></i></a></td>
</tr>';
?>