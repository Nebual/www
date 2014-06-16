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
		<?php echo WidgetManager::getSiteName(); ?> - Shopping Cart
	</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="common.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="common.js"></script>
</head>

<body>

<?php print_navbar("shoppingcart_page"); ?>

Your cart's contents:
<?php
if($widgets == -1){
	echo 'Nothing to display.';
}else{?>
<table class="table" id="cart">
	<thead>
		<th style="width: 100%;">Product Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th></th>
		<th></th>
	</thead>
	<?php
	foreach ($widgets as $w){
		echo "<tr>\n" .
			"<td><a href='product.php?id=" . $w['widgetID'] . "'>" . $w['widgetName'] . "</a></td>\n" .
			"<td>" . $w["price"] . "</td>\n" .
			"<td><input class='quantity' type='number' widgetid='".$w['widgetID']."' value='" . $w['quantity'] . "'/></td>\n" .
			"<td><span class='button updatecart' widgetid='" . $w['widgetID'] . "'>Update</span></td>\n" .
			"<td><span class='button removefromcart' widgetid='" . $w['widgetID'] . "'>Remove</span></td>\n" .
			"</tr>\n";
	}?>
	</table>
	<br><a class="button" href="order.php">Place Order</a>
<?php
}
?>
</body>
</html>

