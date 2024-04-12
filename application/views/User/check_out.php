<?php require_once(APPPATH . 'views/header.php');
 echo validation_errors();
?>
<form action="<?php echo base_url('/home/procced_to_payment')?>" method='post'>
	<input type="text" name='address'>
	<button class='btn btn-primary'>Proceed to payment</button>
</form>

<!-- FOOTER -->
<?php require_once(APPPATH . 'views/footer.php');?>
