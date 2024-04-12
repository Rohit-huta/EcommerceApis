


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Page - Product Admin Template</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="<?php echo base_url('assets/lay_css/fontawesome.min.css');?>" />
    <!-- https://fontawesome.com/ -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url('assets/lay_css/bootstrap.min.css');?>" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="<?php echo base_url('assets/lay_css/templatemo-style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lay_css/custom-css.css');?>">

    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

<body style='background-color: rgba(201, 227, 242);'>

  <?php 
	$is_logged = $this->session->tempdata("is_logged"); 
	$is_admin = $this->session->tempdata("is_admin"); 
	?>


	<form id='cartForm' action="<?php echo base_url('/home/get_cart_items');?>" method='post'>
				<input type="hidden" name='user_id' value='<?php echo $_SESSION['user_id'];?>'>
	</form>

	<div>
      <nav class="navbar navbar-expand-xl bg-primary">
	
				<div class="container-fluid h-100 d-flex justify-content-between">
					<div>
						<a class="navbar-brand" href="index.html">
							<h1 class="tm-site-title mb-0 logo">Ecommerce </h1>
						</a>
					</div>
					<div>
						<button
							class="navbar-toggler ml-auto mr-0"
							type="button"
							data-toggle="collapse"
							data-target="#navbarSupportedContent"
							aria-controls="navbarSupportedContent"
							aria-expanded="false"
							aria-label="Toggle navigation"
						>
							<i class="fas fa-bars tm-nav-icon"></i>
						</button>

						<?php if($is_logged){ ?>
						<div class="collapse navbar-collapse links" id="navbarSupportedContent">
							<ul class="navbar-nav mx-auto h-100">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url('/home')?>" '>
										<i class="fas fa-shopping-cart"></i> Products
									</a>
								</li>

								<?php if($is_admin == 0){?>
									<li class='nav-item' style='color: white;'>
										<!-- submit form function is in footer.php -->
										<a class="nav-link" onclick="submit_cart_form()" style='pointer: cursor;'>
											<i class="fa-solid fa-cart-shopping"></i> Cart
										</a>
									</li>
									<li class='nav-item' style='color: white;'>
										<!-- submit form function is in footer.php -->
										<a class="nav-link" onclick="submit_order_form()" style='pointer: cursor;'>
											<i class="fa-solid fa-cart-shopping"></i> Orders
										</a>
									</li>
								<?php } ?>

								<li>
									<a class="nav-link" href="<?php echo base_url('/home/logout')?>">
										<i class="fa-solid fa-right-from-bracket"></i> Logout
									</a>
								</li>
							</ul>
						</div>
						<?php }else{ ?>
						<ul class="navbar-nav mx-auto h-100">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url('/home/showLoginForm')?>">
										<i class="fas fa-shopping-cart"></i> Login
									</a>
								</li>
						</ul>
						<?php }?>
					</div>
				</div>

      </nav>
		</div>
		<div class='wrapper'>

