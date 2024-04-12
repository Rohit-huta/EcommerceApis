<?php require_once(APPPATH . 'views/header.php');
 echo validation_errors();
?>



<div style="margin-top: 4rem; height: 65vh;" class='ml-5'>
	<h1>Cart</h1>

	<?php 
	$total_amount = 0;
	if(!empty($cart_items)){ ?>
			<div class="row">
			<?php foreach ($cart_items as  $cart_item) { 
		
					$product_id = $cart_item['product_id'];

					$quantity = $cart_item['quantity'];
					$total_price = $cart_item['total_price'];
					$total_amount += $cart_item['total_price'];
					$product_name = '';
					$product_name = '';
				
					foreach ($product_details as $product_array) {
						foreach ($product_array as $product) {
							if ($product['product_id'] == $product_id) {
								$product_name = $product['name'];
								$product_image = $product['images'];
								// Stop searching once found
								break; // Break out of both foreach loops
							}
						}
					}
				
				?>
				<div class="card mb-3 w-50">
					<div class="row g-0">
						<div class="col-md-4">
							<img src="<?php echo base_url('uploads/' . $product_image); ?>" class="img-fluid rounded-start" alt="...">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title"><?php echo $product_name ?></h5>
								<p class="card-text">Quantity: <?php echo $quantity;?></p>
								<p class="card-text">Price: <?php echo $total_price;?></p>
							</div>
						</div>
					</div>
				</div>

			<?php } ?>
			</div>
			<form action="<?php echo base_url('/home/check_out');?>" method="post">
	<p>Total Price : <?php echo $total_amount;?></p>
		<button class="ml-5 btn btn-primary">Check Out</button>
	</form>
	<?php }
	else {?>
		<p>Oops! No Cart Items found</p>
	<?php }?>
			</div>


</div>



<!-- FOOTER -->
<?php require_once(APPPATH . 'views/footer.php');?>
