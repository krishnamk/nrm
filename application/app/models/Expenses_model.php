<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends CI_Model {

	function get_expenses_list(){
		$this->db->select('a.*,b.expense_category');
		$this->db->from('tbl_expenses a');
		$this->db->join('mst_expense_categories b','a.expense_category_id = b.expense_category_id');
		$this->db->where('a.status',1);
		$this->db->order_by('a.expense_id','desc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	} 

	function get_expense_details($expense_id){
		$this->db->select('a.*,b.expense_category_id,b.expense_category');
		$this->db->from('tbl_expenses a');
		$this->db->join('mst_expense_categories b','a.expense_category_id = b.expense_category_id'); 
		$this->db->where('a.expense_id',$expense_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return false;
		}
	}

}

/* End of file Expenses_model.php */
/* Location: ./application/models/Expenses_model.php */