<!DOCTYPE html>
<html>
<head>
	<title>ALGORITMA APRIORI</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
</head>
<body>
<div class="container"><br/>
	<center><h2 style="font-family: arial">ALGORITMA APRIORI</h2></center>
	<hr/>
	<div class="row">
		<div class="col-md-8">
			<h4>Produk</h4>
			<div class="row">
			<?php foreach ($produk as $row) : ?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img width="200" src="<?php echo base_url().'assets/images/';?>">
						<div class="caption">
							<h4><?php echo $row->produk_name;?></h4>
							<div class="row">
								<div class="col-md-7">
									<h4><?php echo number_format($row->produk_harga);?></h4>
								</div>
								<div class="col-md-5">
									<input type="number" name="quantity" id="<?php echo $row->id;?>" value="1" class="quantity form-control">
								</div>
							</div>
							<button class="add_cart btn btn-success btn-block" data-id="<?php echo $row->id;?>" data-name="<?php echo $row->produk_name;?>" data-harga="<?php echo $row->produk_harga;?>">Add To Cart</button>
						</div>
					</div>
				</div>
			<?php endforeach;?>
				
			</div>

		</div>
		<div class="col-md-4">
			<h4>Cart</h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Produk</th>
						<th>Harga</th>
						<th>Qty</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="detail_cart">

				</tbody>
				
			</table>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(){
			var id    = $(this).data("id");
			var name  = $(this).data("name");
			var harga = $(this).data("harga");
			var qty	  = $('#' + id).val();
			$.ajax({
				url : "<?php echo site_url('product/add_to_cart');?>",
				method : "POST",
				data : {id: id, name: name, harga: harga, qty: qty},
				success: function(data){
					console.log(data);
					$('#detail_cart').html(data);
				}
			});
		});

		
		$('#detail_cart').load("<?php echo site_url('product/load_cart');?>");

		
		$(document).on('click','.romove_cart',function(){
			var row_id=$(this).attr("id"); 
			$.ajax({
				url : "<?php echo site_url('product/delete_cart');?>",
				method : "POST",
				data : {row_id : row_id},
				success :function(data){
					$('#detail_cart').html(data);
				}
			});
		});
	});
</script>
</body>
</html>