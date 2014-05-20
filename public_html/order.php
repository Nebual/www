<?php 
include("widgetmanager.php");
include("navbar.php");
include("cart_backend.php");

// Holds -1 if their cart is empty
$widgets = getCartContents();
?>

<!DOCTYPE html>
<head>
	<title>
		<?php echo WidgetManager::getSiteName(); ?> - Checkout>
	</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="common.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="common.js"></script>
</head>

<body>
<?php print_navbar("checkout_page"); ?>

<form class="form-horizontal">
	<div class="form-group">
		<label class="col-md-2 control-label">Contact Phone Number</label>
		<input type="tel" class="col-md-4" name="phone" placeholder="250 727 1234">
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label">Email Address</label>
		<input type="email" class="col-md-4" name="email" placeholder="jfraser@gmail.com">
	</div>

	<fieldset id="billing">
		<legend>Billing Information</legend>
		<div class="form-group">
			<label class="col-md-2 control-label">Name</label>
			<input type="text" class="col-md-4" name="b_name" placeholder="Josh Fraser">
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Street Address</label>
			<input type="text" class="col-md-4" name="b_address" placeholder="1 Hohoho Road">
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Country</label>
			<select class="col-md-1" name="b_country"><option value="canada">Canada</option></select>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Postal Code</label>
			<input type="text" class="col-md-4" name="b_postalcode" placeholder="V9A1A1">
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">City</label>
			<input type="text" class="col-md-4" name="b_city" placeholder="Victoria">
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Province</label>
			<select class="col-md-1" name="b_province">
				<option value="alberta">Alberta</option>
				<option value="BC" selected>BC</option>
			</select>
		</div>
	</fieldset>

	<div class="form-group">
		<div class="col-md-2"></div>
		<input type="checkbox" name="shipping_same" onclick="$('#shipping').attr('disabled', this.checked);" checked>Shipping Information same as Billing</input>
	</div>
	
	<fieldset id="shipping" disabled>
		<legend>Shipping Information</legend>
		<div class="form-group">
			<label class="col-md-2 control-label">Name</label>
			<input type="text" class="col-md-4" name="s_name" placeholder="Josh Fraser">
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Street Address</label>
			<input type="text" class="col-md-4" name="s_address" placeholder="1 Hohoho Road">
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Country</label>
			<select class="col-md-1" name="s_country"><option value="canada">Canada</option></select>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Postal Code</label>
			<input type="text" class="col-md-4" name="s_postalcode" placeholder="V9A1A1">
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">City</label>
			<input type="text" class="col-md-4" name="s_city" placeholder="Victoria">
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Province</label>
			<select class="col-md-1" name="s_province">
				<option value="alberta">Alberta</option>
				<option value="BC" selected>BC</option>
			</select>
		</div>
	</fieldset>

	<button type="submit">Submit</button>
</form>

</body>
</html>
