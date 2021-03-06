<?php 
include("widgetmanager.php");
include("navbar.php");
include("cart_backend.php");

// Holds -1 if their cart is empty
$widgets = getCartContents();
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo WidgetManager::getSiteName(); ?> - Payment Confirmation
	</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="common.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="common.js"></script>
</head>

<body>
<?php
	print_navbar("checkout_page");
	if(isset($_GET["cancel"])) { ?>
		Payment cancelled.<br>
		<a href="shoppingcart.php">Return to Cart</a>?
<?php }
	elseif(isset($_GET["success"])) {
		?>
		<div class='orderform'>
			Payment successful!<br>
			Your order is complete.<br>
			<?php
			echo "An email has been sent to " . $_SESSION["contactinfo"]["email"] . ".<br>\n" .
				"<hr>\n" .
				$_SESSION["contactinfo"]["s_name"] . "<br>\n" .  
				$_SESSION["contactinfo"]["phone"] . "<br>\n" . 
				$_SESSION["contactinfo"]["s_address"] . "<br>\n" . 
				$_SESSION["contactinfo"]["s_postalcode"] . "<br>\n" . 
				$_SESSION["contactinfo"]["s_city"] . ", " . 
				$_SESSION["contactinfo"]["s_province"] . ", " .
				$_SESSION["contactinfo"]["s_country"] . "<br>\n";
			?>
			<hr>
			<table class="table" id="cart">
				<thead>
					<th style="width: 100%;">Product Name</th>
					<th>Price</th>
					<th>Quantity</th>
				</thead>
				<?php
				foreach ($widgets as $w){
					echo "<tr>\n" .
						"<td><a href='product.php?id=" . $w['widgetID'] . "'>" . $w['widgetName'] . "</a></td>\n" .
						"<td>" . $w["price"] . "</td>\n" .
						"<td>" . $w['quantity'] . "</td>\n" .
						"</tr>\n";
				}?>
			</table>
		</div>
		<?php

		// send the email
		$message = "Thank you for placing an order with WWW. \r\n\r\nThe following will be shipped 'soon':\r\n";
		foreach($widgets as $w) {
			$message .= $w["widgetName"] . " (" . $w["widgetID"] . "): $" . $w["price"] . " x" . $w["quantity"]  . "\r\n";
		}
		$headers = "From: WWW Orders <cst2014grp1@gmail.com>\r\nReply-To: cst2014grp1@gmail.com\r\nX-Mailer: PHP/".phpversion();
		mail($_SESSION["contactinfo"]["email"], "WWW Order Confirmation", $message, $headers);
		
		unset($_SESSION["cart"]);
	}
	unset($_SESSION['paymentId']);
?>
</body>
</html>
