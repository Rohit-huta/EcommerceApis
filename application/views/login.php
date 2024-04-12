<?php require_once(APPPATH . 'views/header.php');

?>
	
<div class='container' style='height:70vh;'>
	<h1 class='mt-4'>Login</h1>
	<form action="<?php echo base_url('/home/login')?>" method='POST' >
		<!-- First name -->
		<div class="form-group mt-3">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email"  name='email' placeholder="Enter email">
			<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>

		</div>

		<!-- Last Name -->
		<div class="form-group mt-3">
			<label for="password">Password</label>
			<input type="password"  class="form-control" id="password" name='password' placeholder="Enter password">
			<?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>

		</div>
		<button type='submit' class='btn btn-primary mt-4' name='submit'>Login</button>
	</form>

</div>
<?php require_once(APPPATH . 'views/footer.php');?>
