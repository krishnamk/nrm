<?php 
if($lists){ 
	//echo "<pre>";print_r($lists);exit;
	if($this->common->get_particular('mst_sub_modules',array('sub_module_name' => 'Purchase DC'),'status')==1){
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['amount'].'</td>
				<td>'.$list['tax_percent'].'</td>
				<td>'.$list['tax_total'].'</td>
				<td>'.MoneyFormatIndia($list['total']).'</td>
				<td><a href="#" class="btn btn-danger temp_purchase_remove" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}elseif(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['category_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['amount'].'</td>
				<td>'.$list['tax_percent'].'</td>
				<td>'.$list['tax_total'].'</td>
				<td>'.MoneyFormatIndia($list['total']).'</td>
				<td><a href="#" class="btn btn-danger temp_purchase_remove" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}else{
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['amount'].'</td>
				<td>'.$list['tax_percent'].'</td>
				<td>'.$list['tax_total'].'</td>
				<td>'.MoneyFormatIndia($list['total']).'</td>
				<td><a href="#" class="btn btn-danger temp_purchase_remove" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}
	}else{
		if($this->common->get_particular('mst_purchase_settings',array('purchase_settings_name' => 'purchase_tax_included'),'purchase_settings_value')==1){
			if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
				foreach ($lists as $key => $list) {
					echo '<tr>
					<td>'.next_number($key).'</td>
					<td>'.$list['product_name'].'</td>
					<td>'.$list['brand_name'].'</td>
					<td>'.$list['quantity'].'</td>
					<td>'.$list['rate'].'</td>
					<td>'.MoneyFormatIndia($list['amount']).'</td>
					<td>'.$list['tax_percent'].'</td>
					<td>'.MoneyFormatIndia($list['tax_total']).'</td>
					<td>'.MoneyFormatIndia($list['total']).'</td>
					<td><a href="#" class="btn btn-danger temp_purchase_delete" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
					</tr>';
				}
			}elseif(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
				foreach ($lists as $key => $list) {
					echo '<tr>
					<td>'.next_number($key).'</td>
					<td>'.$list['product_name'].'</td>
					<td>'.$list['category_name'].'</td>
					<td>'.$list['quantity'].'</td>
					<td>'.$list['rate'].'</td>
					<td>'.MoneyFormatIndia($list['amount']).'</td>
					<td>'.$list['tax_percent'].'</td>
					<td>'.MoneyFormatIndia($list['tax_total']).'</td>
					<td>'.MoneyFormatIndia($list['total']).'</td>
					<td><a href="#" class="btn btn-danger temp_purchase_delete" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
					</tr>';
				}
			}else{
				foreach ($lists as $key => $list) {
					echo '<tr>
					<td>'.next_number($key).'</td>
					<td>'.$list['product_name'].'</td>
					<td>'.$list['quantity'].'</td>
					<td>'.$list['rate'].'</td>
					<td>'.MoneyFormatIndia($list['amount']).'</td>
					<td>'.$list['tax_percent'].'</td>
					<td>'.MoneyFormatIndia($list['tax_total']).'</td>
					<td>'.MoneyFormatIndia($list['total']).'</td>
					<td><a href="#" class="btn btn-danger temp_purchase_delete" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
					</tr>';
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
					<td>'.MoneyFormatIndia($list['total']).'</td>
					<td><a href="#" class="btn btn-danger temp_purchase_delete" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
					</tr>';
				}
			}elseif(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
				foreach ($lists as $key => $list) {
					echo '<tr>
					<td>'.next_number($key).'</td>
					<td>'.$list['product_name'].'</td>
					<td>'.$list['category_name'].'</td>
					<td>'.$list['quantity'].'</td>
					<td>'.$list['rate'].'</td>
					<td>'.MoneyFormatIndia($list['total']).'</td>
					<td><a href="#" class="btn btn-danger temp_purchase_delete" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
					</tr>';
				}
			}else{
				foreach ($lists as $key => $list) {
					echo '<tr>
					<td>'.next_number($key).'</td>
					<td>'.$list['product_name'].'</td>
					<td>'.$list['quantity'].'</td>
					<td>'.$list['rate'].'</td>
					<td>'.MoneyFormatIndia($list['total']).'</td>
					<td><a href="#" class="btn btn-danger temp_purchase_delete" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
					</tr>';
				}
			}
		}
	}
}else{ 
	echo '<tr>
	<td colspan="8">No Products Found</td>
	</tr>';
}
?>