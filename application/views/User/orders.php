<!-- HEADER -->
<?php require_once(APPPATH . 'views/header.php'); ?>


<div style="margin-top: 4rem; height: 65vh;" class='ml-5'>
	<h1>ORDERS</h1>

	<?php 

	$total_amount = 0;
	if(!empty($orders)){ ?>
			<div class="row">
			<?php foreach ($orders as $product) { 
		
					$product_id = $product['product_id'];
					$product_name =  $product['name'];
					$product_description =  $product['description'];
					$product_image = $product['images'];
					$product_price = $product['price'];
				
				
				
				?>
				<div class="card mb-3 w-50">
					<div class="row g-0">
						<div class="col-md-4">
							<img src="<?php echo base_url('uploads/' . $product_image); ?>" class="img-fluid rounded-start" alt="...">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title"><?php echo $product_name ?></h5>
								
								<p class="card-text">Price: <?php echo $product_price;?></p>
							</div>
						</div>
					</div>
				</div>

			<?php } ?>
			</div>

	<?php }
	else {?>
		<p>Oops! No Orders found</p>
	<?php }?>
			</div>


</div>




<!-- FOOTER -->
<?php require_once(APPPATH . 'views/footer.php');?>
