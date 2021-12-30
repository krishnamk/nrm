<?php
if($lists){ 
	if($this->common->get_particular('mst_estimate_settings',array('estimate_settings_name' => 'estimate_tax_included'),'estimate_settings_value')== 1){
		if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['tax_percentage'].'</td>
				<td>'.$list['total'].'</td>
				<td><a href="#" class="btn btn-danger temp_estimate_remove" data-id="'.$list['estimate_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
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
				<td>'.$list['tax_percentage'].'</td>
				<td>'.$list['total'].'</td>
				<td><a href="#" class="btn btn-danger temp_estimate_remove" data-id="'.$list['estimate_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}else{
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['tax_percentage'].'</td>
				<td>'.$list['total'].'</td>
				<td><a href="#" class="btn btn-danger temp_estimate_remove" data-id="'.$list['estimate_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
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
				<td>'.$list['rate']*$list['quantity'].'</td>
				<td><a href="#" class="btn btn-danger temp_estimate_remove" data-id="'.$list['estimate_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
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
				<td>'.$list['rate']*$list['quantity'].'</td>
				<td><a href="#" class="btn btn-danger temp_estimate_remove" data-id="'.$list['estimate_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}else{
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.$list['rate']*$list['quantity'].'</td>
				<td><a href="#" class="btn btn-danger temp_estimate_remove" data-id="'.$list['estimate_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}
	}

}else{
	echo '<tr>
	<td colspan="6">No Products Found</td>
	</tr>';
}
?>