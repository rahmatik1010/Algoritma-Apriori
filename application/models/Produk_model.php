<?php
class Produk_model extends CI_Model{

	function all_produk(){
		$qry = $this->db->get('tbl_produk');
		return $qry->result();
	}
	
}