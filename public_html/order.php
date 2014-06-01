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

<script>
// Validation JS
function isValidEmail(addr){
	    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(addr);
}

function isValidPhone(phone){
	var nums = phone.match(/\d/g).length;

	if (nums < 10){
		return false;
	}
	else{
		return true;
	}
}

function isValidPostal(country, postal){
	if (country.toLowerCase() == "canada"){
		var postal_letters = postal.match(/[a-zA-Z]/g).length;
		var postal_numbers = postal.match(/\d/g).length;

		if ((postal_letters == 3) && (postal_numbers == 3)){
			return true;
		}
		else{
			return false;
		}
	}
}

function order_validate(){
		var chk_phone = $.trim($('[name="phone"]').val());
		var chk_email = $.trim($('[name="email"]').val());

		var chk_bname = $.trim($('[name="b_name"]').val());
		var chk_baddr = $.trim($('[name="b_address"]').val());
		var chk_bcountry = $.trim($('[name="b_country"]').val());
		var chk_bpostal = $.trim($('[name="b_postalcode"]').val());
		var chk_bcity = $.trim($('[name="b_city"]').val());
		var chk_bprovince = $.trim($('[name="b_province"]').val());

		var chk_sname;
		var chk_saddr;
		var chk_scountry;
		var chk_scity;
		var chk_sprovince;

		if ($('[name="shipping_same"]').prop('checked')){
			chk_sname = chk_bname;
			chk_saddr = chk_baddr;
			chk_scountry = chk_bcountry;
			chk_spostal = chk_bpostal;
			chk_scity = chk_bcity;
			chk_sprovince = chk_bprovince;
		}
		else{
			chk_sname = $.trim($('[name="s_name"]').val());
			chk_saddr = $.trim($('[name="s_address"]').val());
			chk_scountry = $.trim($('[name="s_country"]').val());
			chk_spostal = $.trim($('[name="s_postalcode"]').val());
			chk_scity = $.trim($('[name="s_city"]').val());
			chk_sprovince = $.trim($('[name="s_province"]').val());
		}


		// Start basic validation checks
		if (!isValidEmail(chk_email)){
			alert("Please enter a valid email address.");
			return false;
		}

		else if (!isValidPhone(chk_phone)){
			alert("Please enter a valid phone number.");
			return false;
		}
		
		else if (!isValidPostal(chk_bcountry, chk_bpostal)){
			alert("Please enter a valid Postal Code for " + chk_bcountry + " .");
			return false;
		}

		else if (!isValidPostal(chk_scountry, chk_spostal)){
			alert("Please enter a valid Postal Code for " + chk_scountry + " .");
			return false;
		}

		else{
			// The validation checks went well
			return true;
		}
}
</script>

</head>

<body>
<?php print_navbar("checkout_page"); ?>

<?php
	if(isset($_SESSION["total"])){
	echo "<h1>Total: $" . $_SESSION["total"] . "</h1>";
}
?>

<form class="form-horizontal orderform" action="Payment.php" method="post">
	<fieldset id="billing">
		<legend>Contact Information</legend>
		<div class="form-group">
			<label class="col-xs-3 control-label">Contact Phone Number</label>
			<input type="tel" class="col-xs-9" name="phone" placeholder="250 555 1234">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Email Address</label>
			<input type="email" class="col-xs-9" name="email" placeholder="client@gmail.com">
		</div>
	</fieldset>

	<fieldset id="billing">
		<legend>Billing Information</legend>
		<div class="form-group">
			<label class="col-xs-3 control-label">Name</label>
			<input type="text" class="col-xs-9" name="b_name" placeholder="Josh Fraser">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Street Address</label>
			<input type="text" class="col-xs-9" name="b_address" placeholder="1 Hohoho Road">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Country</label>
			<select class="col-xs-2" name="b_country"><option value="canada">Canada</option></select>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Postal Code</label>
			<input type="text" class="col-xs-9" name="b_postalcode" placeholder="V9A1A1">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">City</label>
			<input type="text" class="col-xs-9" name="b_city" placeholder="Victoria">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Province</label>
			<select class="col-xs-2" name="b_province">
				<option value="alberta">Alberta</option>
				<option value="BC" selected>BC</option>
			</select>
		</div>
	</fieldset>

	<div class="form-group">
		<div class="col-xs-3"></div>
		<input type="checkbox" name="shipping_same" onclick="$('#shipping').attr('disabled', this.checked);" checked>Shipping Information same as Billing</input>
	</div>
	
	<fieldset id="shipping" disabled>
		<legend>Shipping Information</legend>
		<div class="form-group">
			<label class="col-xs-3 control-label">Name</label>
			<input type="text" class="col-xs-9" name="s_name" placeholder="Josh Fraser">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Street Address</label>
			<input type="text" class="col-xs-9" name="s_address" placeholder="1 Hohoho Road">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Country</label>
			<select class="col-xs-2" name="s_country"><option value="canada">Canada</option></select>
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Postal Code</label>
			<input type="text" class="col-xs-9" name="s_postalcode" placeholder="V9A1A1">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">City</label>
			<input type="text" class="col-xs-9" name="s_city" placeholder="Victoria">
		</div>
		<div class="form-group">
			<label class="col-xs-3 control-label">Province</label>
			<select class="col-xs-2" name="s_province">
				<option value="alberta">Alberta</option>
				<option value="BC" selected>BC</option>
			</select>
		</div>
	</fieldset>

	<button type="submit" onclick="return order_validate();">Place Order With PayPal</button>
</form>

</body>
</html>
