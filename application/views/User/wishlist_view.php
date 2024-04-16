<!-- HEADER -->
<?php require_once(APPPATH . 'views/header.php'); ?>
<?php $user_id = $this->session->tempdata('user_id');?>


<div class='ml-5' style="margin-top: 4rem;">
	<h1 class=''>WISHLIST</h1>
	<?php  if(!empty($products)){ ?>
		<div class="row mt-5">
			<?php foreach ($products as $product) { ?>
				<form id='add_to_wishlist_form' action="<?php echo base_url('/home/add_to_wishlist');?>" method='post'>
					<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				</form>
				<div class="col-md-3 mb-4">
					<div class="card col-gap-4" style="width: 18rem; min-height: 600px;">
						<div class="card-img-container" style="height: 300px; overflow: hidden;">
							<img class="card-img-top" src="<?php echo base_url('uploads/' . $product['images']); ?>" alt="Product Image" style='object-fit: contain; height: 100%;'>
						</div>
						<div class="card-body">
							<div class='d-flex justify-content-between'>
								<h5 class="card-title"><?php echo $product['name']; ?></h5>

					<!-- ADD to WISHLIST -->
								<a onclick="add_to_wishlist_form()" style='cursor: pointer;'>
								 <?php if (!$this->session->flashdata('message')) { ?>
									<i class="fa-regular fa-heart"></i>
								<?php } else{?>
									<i class="fa-solid fa-heart"></i>
									<?php }?>
								</a>
				
							</div>

							<p class="card-text"><?php echo $product['description']; ?></p>
							<p>Price <?php echo $product['price'];?></p>
							<form method="post" action="<?php echo base_url('/home/add_to_cart'); ?>">
								<!-- Quantity -->
								<div class='d-flex align-items-center'>
									<p class="card-text mb-0 mr-2">Quantity: </p>
									<input type="text" name='quantity' style='height:26px;' >
								</div>
								<input type="hidden" name="price" value="<?php echo $product['price']; ?>">
								<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
								<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
								<button type="submit" class="btn bg-info mt-2">Add To Cart</button>
							</form>
							<a href="#" class="btn btn-primary mt-2">Buy Now</a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

	<?php }
	else {?>
		<p>No Products Found</p>
	<?php }?>
			</div>
</div>




<!-- FOOTER -->
<?php require_once(APPPATH . 'views/footer.php');?>
