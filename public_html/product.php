<?php 
include("widgetmanager.php");
include("navbar.php");

$widID = 0;
if ( isset($_GET["id"]) ){
	$widID = $_GET["id"];
}

$widget = WidgetManager::getWidget($widID);
$catName = WidgetManager::getCategoryName($widget["categoryID"]);
?>

<!DOCTYPE html>
<html>
<head>
<title>Wally&apos;s Widget World - <?php echo $widget["widgetName"]; ?></title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="common.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="common.js"></script>
</head>

<body>
<?php print_navbar("product_page"); ?>
What I gotta tell you about a product too? Okay well heres what we&apos;ve parsed so far:
<table class="table table-bordered" id="productinfo">
	<tr><th>Model</th><td><?php echo $widget["widgetName"]; ?></td></tr>
	<tr><th>Price</th><td><?php echo "$".number_format($widget["price"],2,".",","); ?><span class="addtocart" widgetid="<?php echo $widID;?>">Add To Cart</span></td></tr>
</table>
That should settle most questions.
</body>
</html>

