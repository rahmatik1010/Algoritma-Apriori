<?php
class Product extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('Produk_model');
		$this->load->model('M_apriori');
	}

	function index(){
		$produk = $this->Produk_model->all_produk();
		$this->load->view('produk_view',['produk'=>$produk]);
	}

	function add_to_cart(){ 
		$data = array(
			'id' => $this->input->post('id'), 
			'name' => $this->input->post('name'), 
			'price' => $this->input->post('harga'), 
			'qty' => $this->input->post('qty'), 
		);
		$this->cart->insert($data);
		// print_r($this->cart->contents());
		echo $this->show_cart(); 
	}

	function show_cart(){ 
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $value) {
			$no++;
			$output .='
				<tr>
					<td>'.$value['name'].'</td>
					<td>'.number_format($value['price']).'</td>
					<td>'.$value['qty'].'</td>
					<td>'.number_format($value['subtotal']).'</td>
					<td><button type="button" id="'.$value['rowid'].'" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
			</tr>
		';
		return $output;
	}

	function load_cart(){ 
		echo $this->show_cart();
	}

	function delete_cart(){ 
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}

public function rekomendasi()
	{	
		foreach ($this->cart->contents() as $value) {
		$id[] = $value['id'];
		$name[] = $value['name'];
		}
		$prodName = implode('-', $name);

		$produk = $this->M_apriori->all_produk();
		$transaksi = count($this->M_apriori->transaksi());
		$support = $this->M_apriori->C1_produk($id);
		$iter = $this->M_apriori->iter($id); //iterasi seluruh array looping
		$detail = $this->M_apriori->C1($id);
		$detail_jumlah[] = (count($detail));
		foreach ($iter as $value) {
			sort($id);
			$hasil = $this->M_apriori->C2($id, $value->id);
			$hasil_produk = $this->M_apriori->C2_produk($id, $value->id);
			foreach ($hasil_produk as $value) {
				$name = $value->produk_name;
			}
			// print_r($hasil_produk);
			if(empty($name) || $name != $value->produk_name){
				$rekomendProd[] = array('jumlah'=> '0',
										'produk'=> $value->produk_name);
			}
			else {
				$rekomendProd[] = array('jumlah'=> count($hasil),
										'produk'=> $name );
			
			}
		
			$sum_all[]=count($hasil);
		}//die;
		arsort($rekomendProd);
		$getRekomend = array_slice($rekomendProd, 0, 8);
		$rekomend = array_slice($rekomendProd, 0, 3);
		// echo"<pre>";print_r($prodName);
		// echo"<pre>";print_r($detail_jumlah);
		// echo"<pre>";print_r($getRekomend);
		// echo"<pre>";print_r($rekomend);
		$this->load->view('checkout',['getRekomend'=>$getRekomend, 'rekomend'=>$rekomend, 'transaksi'=>$transaksi,
										'prodName'=>$prodName, 'tranSama'=>$detail_jumlah]);
	}
}