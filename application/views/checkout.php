<!DOCTYPE html>
<html>
<head>
	<title>ALGORITMA APRIORI</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
</head>
<body>
	<center><h2 style="font-family: arial">ALGORITMA APRIORI</h2></center>
	<hr/>

	
	<div class="d-md-flex h-md-10">

		<!-- First Half -->

	<!-- Second Half -->

		<div class="col-md-5 p-0 bg-white h-md-10" style="margin-top:31px; margin-left: 40px; margin-right: 100px">
		    <center><h4 style="font-family: Arial;">Analisis Apriori</h4></center>
		        <table class="table">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Transaksi(A)</th>
				      <th scope="col">Produk(B)</th>
				      <th scope="col">Support(AuB)</th>
				      <th scope="col">Support(A)</th>
				      <th scope="col">Confidence</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php
				    	foreach($getRekomend as $rekom){
					    	//$conf[] = number_format(100*$rekom['jumlah']/$tranSama[0],2)?>
						    <tr>
						      <td><?=$prodName?></td>
						      <td><?= $rekom['produk']?></td>
						      <td><?= number_format(100*$rekom['jumlah']/$transaksi,2)?>%</td>
						      <td><?= number_format(100*$tranSama[0]/$transaksi,2) ?>%</td>
						      <?php
						     	if($tranSama[0] == 0){?>
						      	<td>0.00%</td>
						      <?php }else{?>
						      	<td><?= number_format(100*$rekom['jumlah']/$tranSama[0],2)?>%</td>
						      <?php }?>
						    </tr>
					<?php }?>
					<?php //$confidence = array_slice($conf, 0, 3)?>
				  </tbody>
				</table>

		</div>
		<div class="col-md-5 p-0 bg-white h-md-10" style="margin-top:31px; margin-left: 40px; margin-right: 20px">
		    <center><h4 style="font-family: Arial;">Rekomendasi Apriori</h4></center>
		    	<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">produk</th>
				      <!-- <th scope="col">Harga</th> -->
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach($rekomend as $value){?>
				    <tr>
				      <td><?= $value['produk']?></td>
				      <!-- <td><?= $value['harga']?></td> -->
				      <td>
				    	<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
  					  </td>
				    </tr>
				    <?php }?>
				  </tbody>
				</table>
			<p>jika nilai 3 buah confidence teratas adalah 0, maka akan di rekomendasi secara default</p> 
		</div>
</body>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
</html>
