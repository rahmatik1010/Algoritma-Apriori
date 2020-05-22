<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_apriori extends CI_Model {
	public function iter($id){
		$qry = $this->db->select('*')
						->from('tbl_produk')
						->where_not_in('id', $id)
						->get();
		return $qry->result();
	}
	
	public function all_produk(){
		$qry = $this->db->select('*')
						->from('tbl_produk')
						->get();
		return $qry->result();
	}

	public function produk($id){
		$qry = $this->db->select('*')
						->from('tbl_produk')
						->where_not_in('id', $id)
						->limit(1)
						->get();
		return $qry->result();
	}

	public function transaksi(){
		$qry = $this->db->get('tbl_transaksi');
		return $qry->result();
	}

	public function transaksi_detail(){
		$qry = $this->db->select('*')
						->from('tbl_transaksi_detail')
						->order_by('id_produk', 'desc')
						->get();
		return $qry->result();
	}

	public function transaksi_input($id){
		$qry = $this->db->select('*')
						->from('tbl_transaksi_detail')
						->where_in('id_produk', $id)
						->order_by('id_produk', 'desc')
						->get();
		return $qry->result();
	}
	public function transaksi3($idt){
		$t = $this->transaksi();
		for($i=0; $i<count($t); $i++) {
			$tid[] = $t[$i]->id;
		}	//echo "<pre>";print_r($tid);				
		 		$qry = $this->db->select('*')
						->from('tbl_transaksi_detail')
						->where_in('id_transaksi', $tid)
						->where_in('id_produk', $idt)
						->group_by('id_produk',0)
						->get();
		// $result[] = $qry->result();}
		// if(count($result) >= count($idt))
		// {
				return $qry->result();
		
		
	}

	public function C1($id){
		$qry = $this->db->query('SELECT * FROM ( SELECT id, id_transaksi, id_produk, COUNT(*) OVER(partition by id_transaksi) as cnt FROM tbl_transaksi_detail WHERE id_produk in('.implode(',',$id).') GROUP BY id_transaksi, id_produk ) a WHERE a.cnt = '.count($id).' group by id_transaksi
			');
		return $qry->result();
		}
	

	public function C1_produk($id){
				$qry = $this->db->query(' SELECT * FROM ( SELECT tbl_transaksi_detail.id as tid, id_transaksi, id_produk, produk_name, COUNT(*) OVER(partition by id_transaksi) as cnt FROM tbl_transaksi_detail LEFT JOIN tbl_produk ON tbl_transaksi_detail.id_produk = tbl_produk.id WHERE id_produk in('.implode(',',$id).') GROUP BY id_transaksi, id_produk ) a WHERE a.cnt = '.count($id).' GROUP BY id_produk
			');
		return $qry->result();
		}

	public function C2($id, $id2){
		$id3 = count($id) + count(array($id2));
		$qry = $this->db->query('SELECT * FROM ( SELECT id, id_transaksi, id_produk, COUNT(*) OVER(partition by id_transaksi) as cnt FROM tbl_transaksi_detail WHERE id_produk in('.implode(',',$id).','.$id2.') GROUP BY id_transaksi, id_produk ) a WHERE a.cnt = '.$id3.' group by id_transaksi
			');
		return $qry->result();
		}

	public function C2_produk($id, $id2){
		$id3 = count($id) + count(array($id2));
				$qry = $this->db->query(' SELECT * FROM ( SELECT tbl_transaksi_detail.id as tid, id_transaksi, id_produk, produk_name, COUNT(*) OVER(partition by id_transaksi) as cnt FROM tbl_transaksi_detail LEFT JOIN tbl_produk ON tbl_transaksi_detail.id_produk = tbl_produk.id WHERE id_produk in('.implode(',',$id).', '.$id2.') GROUP BY id_transaksi, id_produk ) a WHERE a.cnt = '.$id3.' GROUP BY id_produk
			');
		return $qry->result();
		}
		

	public function transaksi_detail_where1($id){
		// echo $id;
		$qry = $this->db->select('*')
						->from('tbl_transaksi_detail')
						->where('id_produk', $id)
						// ->order_by('id_produk')
						->get();
		return $qry->result();
	}

}