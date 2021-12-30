<?php
if(isset($estimate_details)){
	if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
		foreach ($estimate_details as $key => $estimate_detail) {
			echo '<tr>
			<td>'.next_number($count).'</td>
			<td>'.$estimate_detail['product_name'].'</td>
			<td>'.$estimate_detail['brand_name'].'</td>
			<td>'.$estimate_detail['quantity'].'</td>
			</tr>';
			$count = next_number($count);
		}
	}elseif(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_category'),'product_settings_value')== 1)){
		foreach ($estimate_details as $key => $estimate_detail) {
			echo '<tr>
			<td>'.next_number($count).'</td>
			<td>'.$estimate_detail['product_name'].'</td>
			<td>'.$estimate_detail['brand_name'].'</td>
			<td>'.$estimate_detail['category_name'].'</td>
			<td>'.$estimate_detail['quantity'].'</td>
			</tr>';
			$count = next_number($count);
		}
	}else{
		foreach ($estimate_details as $key => $estimate_detail) {
			echo '<tr>
			<td>'.next_number($count).'</td>
			<td>'.$estimate_detail['product_name'].'</td>
			<td>'.$estimate_detail['quantity'].'</td>
			</tr>';
			$count = next_number($count);
		}
	}
}else{
	echo '<tr>
	<td colspan="5">No Products Found</td>
	</tr>';
}
?>