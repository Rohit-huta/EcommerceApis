<?php require_once(APPPATH . 'views/header.php');
 echo validation_errors();
?>
		<!-- form_validation errors -->
		<?php echo validation_errors(); 
		$categories = $this->session->tempdata('categories');
		?>

		<!-- image uploding errors -->
		<?php 

			if ($this->session->flashdata('message')) {
			// Display error message
				echo $this->session->flashdata('message');
			}
		?>

<div class='container'>
	<h1 class='mt-5'>Add Product</h1>
	<form action="<?php echo base_url('/product/add_product'); ?>" 
		  method='POST' 
		  enctype="multipart/form-data"
		  class='mt-4'
		  >


		<!-- Product name -->
		<div class="mt-3">
			<label for="product_name">Product Name: </label>
			<input type="text" name='product_name'>
			<?php echo form_error('product_name', '<div class="text-danger">', '</div>'); ?>
		</div>

		<!-- Description -->
		<div class="form-group mt-3">
			<label for="description">Description: </label>
			<input type="text" name='description'>
			<?php echo form_error('description', '<div class="text-danger">', '</div>'); ?>
		</div>

<!-- price -->
		<div class="form-group mt-3">
			<label for="price">Price: </label>
			<input type="number" name='price'>
			<?php echo form_error('price', '<div class="text-danger">', '</div>'); ?>
		</div>
<!-- Categories  -->
		<div class="form-group mt-3">
			<label for="brand">Category:</label>
				<select id="brand" name="brand">
				<!-- <option value="volvo">Volvo</option> -->
				<?php foreach($categories as $category) {?>
					<option value="<?php echo $category['name']?>"><?php echo $category['name']?></option>
				<?php }?>
			</select>
			<?php echo form_error('brand', '<div class="text-danger">', '</div>'); ?>

		</div>

<!-- Availability  -->
		<div class="form-group mt-3">
			<label for="avalability">Avalaibility: </label>
			<input type="text" name='avalability'>
		</div>

<!-- Availability  -->
		<div class="form-group mt-3">
			<label for="image">Image: </label>
			<input type="file" name="productImage">
		</div>

		<input type='hidden' name='product_id' value='<?php echo $id?>'/>


		<button type='submit' class='btn btn-primary mt-4' name='submit'>Submit</button>
	</form>

</div>
	
<?php require_once(APPPATH . 'views/footer.php');?>
