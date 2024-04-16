<?php require_once(APPPATH . 'views/header.php');
 echo validation_errors();
?>


<?php
if ($this->session->flashdata('success')) {
    echo $this->session->flashdata('success');
}
if ($this->session->flashdata('deleteProduct')) {
    echo $this->session->flashdata('deleteProduct');
}
?>

	<h1 class='ml-4 mt-5'>Welcome <?php echo $this->session->userdata('name') ?></h1>
	<br>

	<div class="container mt-5">
   
       
     

<?php if(!empty($products)){ ?>
	<div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
            <div class="tm-product-table-container" style='border-radius: 20px;'>
				<table class="table table-hover tm-table-small tm-product-table bg-info rounded-pill">
					<thead class='bg-info'>
						<tr>
							<th scope="col">&nbsp;</th>
							<th scope="col">PRODUCT NAME</th>
							<th scope="col">PRICE</th>
				
							<th scope="col">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($products as $product) {?>
							<tr style='background-color: #327ba8;'>
								<th scope="row"><input type="checkbox" /></th>
								<td class="tm-product-name"><?php echo $product['name']; ?></td>
								<td><?php echo $product['price']; ?></td>
								<!-- DELETE -->
								<td>
									<a class="tm-product-delete-link" onclick="submitDeleteForm()" style="cursor: pointer;">
										<i class="far fa-trash-alt tm-product-delete-icon"></i>
									</a>
									<form method="post" id='deleteForm' action="<?php echo base_url('/product/deleteProduct'); ?>">
										<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
									</form>
								</td>

								<!-- UPDATE -->
								<td>
									<a class="tm-product-delete-link cursor" onclick="submitUpdateForm()" style="cursor: pointer;">
									<i class="fa-solid fa-pen tm-product-delete-icon"></i>
									</a>
									<form method="post" id='updateForm' action="<?php echo base_url('/product/updateProduct'); ?>">
										<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
									</form>
								</td>
							</tr>
						<?php } //product each ?>
					

<?php } //if products
else {?>
	<p>No Products Found</p>
<?php }?>


			</table>
			
		</div>
		<a href="<?php echo base_url('/product');?>" class="btn btn-primary btn-block text-uppercase mb-3">
			Add new product
		</a>
</div>
</div>

<?php require_once(APPPATH . 'views/footer.php');?>
