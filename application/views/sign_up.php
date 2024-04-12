<?php require_once(APPPATH . 'views/header.php');
 echo validation_errors();
?>



	<div class='container'>
		<h1 class='mt-5'>Sign up | User</h1>
		<!-- <form action="">
			<label for="email">Email:</label>
			<input type="text" id='email' name='email'>
			<br>
			<label for="password">Password:</label>
			<input type="password" id='password' name='password'>
			<br>
			<button type='submit'>Submit</button>
		</form> -->

		<form class='' action='<?php echo base_url('/home/register');?>' method='post'>
			<!-- First name -->
			<div class="form-group mt-3">
				<label for="first_name">First Name</label>
				<input type="text" class="form-control" id="first_name"  name='first_name' placeholder="Enter First Name">
			</div>

			<!-- Last Name -->
			<div class="form-group mt-3">
				<label for="last_name">Last Name</label>
				<input type="text"  class="form-control" id="last_name" name='last_name' placeholder="Enter Last Name">
			</div>
			
			<!-- Address -->
			<div class="form-group  mt-3">
				<label for="address">Address</label>
				<input type="text" class="form-control" id="address" name='address' placeholder="Address">
			</div>
			

			<!-- Mobile -->
			<div class="form-group  mt-3">
				<label for="mobile">Mobile</label>
				<input type="text" class="form-control" id="mobile" name='mobile' placeholder="mobile">
			</div>

			<!-- Email -->
			<div class="form-group  mt-3">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name='email' placeholder="email">
			</div>

			<!-- Password -->
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name='password' placeholder="Password">
			</div>

			<button type="submit" class="btn btn-primary mt-4">Submit</button>
		</form>
		<?php if( isset($register_status) && $register_status == true){ ?>
			<p>Registered Successful</p>
		<?php } ?>

		<p>Already Registered? <a href="<?php echo base_url('/home/showLoginForm'); ?>">Login</a> </p> 
	</div>


<?php require_once(APPPATH . 'views/footer.php');?>
