<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stock_model extends CI_Model{
	function get_product_details($product_id){
		$this->db->select('b.quantity');
		$this->db->from('mst_products a');
		$this->db->join('tbl_stock b','b.product_id = a.product_id');
		$this->db->where('a.product_id',$product_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}
	function get_stock_lists(){
		if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_type'),'product_settings_value')== 1) {
			$this->db->select('*');
			$this->db->from('mst_products a');
			$this->db->join('mst_product_type b','b.product_type_id = a.product_type');
		}else{
			$this->db->select('a.product_id,a.product_name,a.product_image');
			$this->db->from('mst_products a');
		}
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$products = $query->result_array();
			//echo "<pre>";print_r($products);exit;
			foreach ($products as $product_key => $product) {
				if($product['product_brand']!="0"){
					$this->db->select('a.brand_id,a.brand_name');
					$this->db->from('mst_brands a');
					$this->db->where('a.brand_id',$product['product_brand']);
					$product_query = $this->db->get();
					if($product_query->num_rows() > 0){
						$products[$product_key]['brand_name'] = $product_query->row('brand_name');
						$products[$product_key]['brand_id'] = $product_query->row('brand_id');
					}
				}else{
					$products[$product_key]['brand_name'] = "";
					$products[$product_key]['brand_id'] = "";
				}
				if($product['product_category']!="0"){
					$this->db->select('a.category_id,a.category_name');
					$this->db->from('mst_category a');
					$this->db->where('a.category_id',$product['product_category']);
					$category_query = $this->db->get();
					if($category_query->num_rows() > 0){
						$products[$product_key]['category_name'] = $category_query->row('category_name');
						$products[$product_key]['category_id'] = $category_query->row('category_id');
					}
				}else{
					$products[$product_key]['category_name'] = "";
					$products[$product_key]['category_id'] = "";
				}
				if($product['product_category']!="0"){
					$this->db->select('a.sub_category_id,a.sub_category_name');
					$this->db->from('mst_subcategory a');
					$this->db->where('a.sub_category_id',$product['product_subcategory']);
					$subcategory_query = $this->db->get();
					if($subcategory_query->num_rows() > 0){
						$products[$product_key]['sub_category_name'] = $subcategory_query->row('sub_category_name');
						$products[$product_key]['sub_category_id'] = $subcategory_query->row('sub_category_id');
					}
				}else{
					$products[$product_key]['sub_category_name'] = "";
					$products[$product_key]['sub_category_id'] = "";
				}
				$this->db->select('a.stock_id,a.quantity');
				$this->db->from('tbl_stock a');
				$this->db->where('a.product_id',$product['product_id']);
				$stock_query = $this->db->get();
				if($stock_query->num_rows() > 0){
					$products[$product_key]['stock_id'] = $stock_query->row('stock_id');
					$products[$product_key]['quantity'] = $stock_query->row('quantity');
				}else{
					$products[$product_key]['stock_id'] = '';
					$products[$product_key]['quantity'] = 0;
				}
			}
			return $products;
		}
		else{
			return false;
		}
	}
	function get_stock_details($data = array()){
		if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_type'),'product_settings_value')== 1) {
			$this->db->select('*');
			$this->db->from('mst_products a');
			$this->db->join('mst_product_type b','b.product_type_id = a.product_type');
		}else{
			$this->db->select('a.product_id,a.product_name,a.product_image');
			$this->db->from('mst_products a');
		}
		if(!empty($data)){
			if($data['product_id']!=""){
				$this->db->where('a.product_id',$data['product_id']);
			}
			if($data['product_type_id']!=""){
				$this->db->where('b.product_type_id',$data['product_type_id']);
			}
		}
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$products = $query->result_array();
			//echo "<pre>";print_r($products);exit;
			foreach ($products as $product_key => $product) {
				if($product['product_brand']!="0"){
					$this->db->select('a.brand_id,a.brand_name');
					$this->db->from('mst_brands a');
					$this->db->where('a.brand_id',$product['product_brand']);
					$product_query = $this->db->get();
					if($product_query->num_rows() > 0){
						$products[$product_key]['brand_name'] = $product_query->row('brand_name');
						$products[$product_key]['brand_id'] = $product_query->row('brand_id');
					}
				}else{
					$products[$product_key]['brand_name'] = "";
					$products[$product_key]['brand_id'] = "";
				}
				if($product['product_category']!="0"){
					$this->db->select('a.category_id,a.category_name');
					$this->db->from('mst_category a');
					$this->db->where('a.category_id',$product['product_category']);
					$category_query = $this->db->get();
					if($category_query->num_rows() > 0){
						$products[$product_key]['category_name'] = $category_query->row('category_name');
						$products[$product_key]['category_id'] = $category_query->row('category_id');
					}
				}else{
					$products[$product_key]['category_name'] = "";
					$products[$product_key]['category_id'] = "";
				}
				if($product['product_category']!="0"){
					$this->db->select('a.sub_category_id,a.sub_category_name');
					$this->db->from('mst_subcategory a');
					$this->db->where('a.sub_category_id',$product['product_subcategory']);
					$subcategory_query = $this->db->get();
					if($subcategory_query->num_rows() > 0){
						$products[$product_key]['sub_category_name'] = $subcategory_query->row('sub_category_name');
						$products[$product_key]['sub_category_id'] = $subcategory_query->row('sub_category_id');
					}
				}else{
					$products[$product_key]['sub_category_name'] = "";
					$products[$product_key]['sub_category_id'] = "";
				}
				$this->db->select('a.stock_id,a.quantity');
				$this->db->from('tbl_stock a');
				$this->db->where('a.product_id',$product['product_id']);
				$stock_query = $this->db->get();
				if($stock_query->num_rows() > 0){
					$products[$product_key]['stock_id'] = $stock_query->row('stock_id');
					$products[$product_key]['quantity'] = $stock_query->row('quantity');
				}else{
					$products[$product_key]['stock_id'] = '';
					$products[$product_key]['quantity'] = 0;
				}
			}
			return $products;
		}
		else{
			return false;
		}
	}
	function get_stock_detail_excel($data = array()){
		if($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_type'),'product_settings_value')== 1) {
			$this->db->select('a.product_id,a.product_name as PRODUCT NAME,a.product_brand,a.product_category,a.product_subcategory');
			$this->db->from('mst_products a');
			$this->db->join('mst_product_type b','b.product_type_id = a.product_type');
		}else{
			$this->db->select('a.product_id,a.product_name,a.product_image');
			$this->db->from('mst_products a');
		}
		if(!empty($data)){
			if($data['product_id']!=""){
				$this->db->where('a.product_id',$data['product_id']);
			}
			if($data['product_type_id']!=""){
				$this->db->where('b.product_type_id',$data['product_type_id']);
			}
		}
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$products = $query->result_array();
			//echo "<pre>";print_r($products);exit;
			foreach ($products as $product_key => $product) {
				if($product['product_brand']!="0"){
					$this->db->select('a.brand_name');
					$this->db->from('mst_brands a');
					$this->db->where('a.brand_id',$product['product_brand']);
					$product_query = $this->db->get();
					if($product_query->num_rows() > 0){
						$products[$product_key]['BRAND'] = $product_query->row('brand_name');
					}
				}else{
					$products[$product_key]['BRAND'] = "-";
				}
				if($product['product_category']!="0"){
					$this->db->select('a.category_name');
					$this->db->from('mst_category a');
					$this->db->where('a.category_id',$product['product_category']);
					$category_query = $this->db->get();
					if($category_query->num_rows() > 0){
						$products[$product_key]['CATEGORY'] = $category_query->row('category_name');
					}
				}else{
					$products[$product_key]['CATEGORY'] = "-";
				}
				if($product['product_subcategory']!="0"){
					$this->db->select('a.sub_category_name');
					$this->db->from('mst_subcategory a');
					$this->db->where('a.sub_category_id',$product['product_subcategory']);
					$subcategory_query = $this->db->get();
					if($subcategory_query->num_rows() > 0){
						$products[$product_key]['SUB CATEGORY'] = $subcategory_query->row('sub_category_name');
					}
				}else{
					$products[$product_key]['SUB CATEGORY'] = "-";
				}
				$this->db->select('a.quantity');
				$this->db->from('tbl_stock a');
				$this->db->where('a.product_id',$product['product_id']);
				$stock_query = $this->db->get();
				if($stock_query->num_rows() > 0){
					$products[$product_key]['QUANTITY'] = $stock_query->row('quantity');
				}else{
					$products[$product_key]['QUANTITY'] = 0;
				}
			}
			return $products;
		}else{
			return false;
		}
	}
	function get_stock_list_excel(){
		$this->db->select('a.product_id,a.product_name');
		$this->db->from('mst_products a');
		$this->db->where('a.status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$products = $query->result_array();
			foreach ($products as $stock_key => $product) {
				$this->db->select('a.quantity');
				$this->db->from('tbl_stock a');
				$this->db->where('a.product_id',$product['product_id']);
				$stock_query = $this->db->get();
				if($stock_query->num_rows() > 0){
					$products[$stock_key]['quantity'] = $stock_query->row('quantity');
				}else{
					$products[$stock_key]['quantity'] = 0;
				}
			}
			return $products;
		}
		else{
			return false;
		}
	}
	function get_stock_inward_outward_details($product_id){
		$this->db->select('c.date,d.quantity as inward_qty');
		$this->db->from('mst_products a');
		$this->db->join('tbl_stock b','b.product_id = a.product_id');
		$this->db->join('tbl_stock_inward_relations d','a.product_id = d.product_id');
		$this->db->join('tbl_stock_inward c','c.stock_inward_id = d.stock_inward_id');
		$this->db->where('a.product_id',$product_id);
		$this->db->where('b.product_id',$product_id);
		$this->db->where('d.product_id',$product_id);
		$this->db->where('d.status',1);
		$this->db->order_by('c.date',"desc");
		$this->db->limit('5');
		$inward_query = $this->db->get();
		if($inward_query->num_rows() > 0){
			$result['stock_inward'] = $inward_query->result_array();
		}else{
			$result['stock_inward'] = false;
		}
		$this->db->select('c.date,c.new_quantity as adjustment_qty');
		$this->db->from('mst_products a');
		$this->db->join('tbl_stock b','b.product_id = a.product_id');
		$this->db->join('tbl_stock_adjustment c','c.product_id = b.product_id');
		$this->db->where('a.product_id',$product_id);
		$this->db->where('b.product_id',$product_id);
		$this->db->where('c.product_id',$product_id);
		$this->db->order_by('c.date',"desc");
		$this->db->limit('5');
		$adjustment_query = $this->db->get();
		if($adjustment_query->num_rows() > 0){
			$result['stock_adjustment'] = $adjustment_query->result_array();
		}else{
			$result['stock_adjustment'] = false;
		}
		return $result;
	}
	function get_stock_inward_details(){
		$this->db->select('*');
		$this->db->from('tbl_stock_inward a');
		$this->db->join('tbl_stock_inward_relations b','a.stock_inward_id=b.stock_inward_id');
		$this->db->where('a.status',1);
		$this->db->where('b.status',1);
		$this->db->order_by('a.date',"desc");
		$inward_query = $this->db->get();
		if($inward_query->num_rows() > 0){
			$result = $inward_query->result_array();
		}else{
			$result = false;
		}
		return $result;
	}
}
