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
		<?php echo WidgetManager::getSiteName(); ?> - <?php echo $catName; ?>
	</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="common.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="common.js"></script>
</head>

<body>

<?php print_navbar("shoppingcart_page"); ?>

Your cart's contents:
<div class="list-inline" id="products">
<?php
if($widgets == -1){
	echo 'Nothing to display.';
}else{
	foreach ($widgets as $w){
		echo '<div class="product list-group-item" href="product.php?id=' . $w["widgetID"] . '">' . $w["widgetName"] . ' (' . $w["quantity"] . ')';
		echo '<span class="button removefromcart" widgetid="' . $w["widgetID"] . '">Remove</span></div>';
	}
	echo '<br><a class="button" href="order.php">Place Order</a>';
}
?>
</div>
</body>
</html>

