<?php 
if($lists){ 
	if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_dc'),'settings_value')==1){
		foreach ($lists as $key => $list) {
			echo '<tr>
			<td>'.next_number($key).'</td>
			<td></td>
			<td>'.$list['product_name'].'</td>
			<td>'.$list['brand_name'].'</td>
			<td>'.$list['quantity'].'</td>
			<td>'.$list['rate'].'</td>
			<td>'.$list['tax_percent'].'</td>
			<td>'.$list['tax_total'].'</td>
			<td>'.sprintf("%.2f",$list['total']).'</td>
			<td><a href="#" class="btn btn-danger temp_purchase_remove" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
			</tr>';
		}
	}else{
		if($this->common->get_particular('mst_settings',array('settings_name' => 'purchase_tax_included'),'settings_value')==1){
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.sprintf("%.2f",$list['amount']).'</td>
				<td>'.$list['tax_percent'].'</td>
				<td>'.sprintf("%.2f",$list['tax_total']).'</td>
				<td>'.sprintf("%.2f",$list['total']).'</td>
				<td><a href="#" class="btn btn-danger temp_purchase_delete" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}else{
			foreach ($lists as $key => $list) {
				echo '<tr>
				<td>'.next_number($key).'</td>
				<td>'.$list['product_name'].'</td>
				<td>'.$list['brand_name'].'</td>
				<td>'.$list['quantity'].'</td>
				<td>'.$list['rate'].'</td>
				<td>'.sprintf("%.2f",$list['total']).'</td>
				<td><a href="#" class="btn btn-danger temp_purchase_delete" data-id="'.$list['purchase_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
				</tr>';
			}
		}
	}
}else{ 
	echo '<tr>
	<td colspan="8">No Products Found</td>
	</tr>';
}
?>