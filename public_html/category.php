<?php 
include("widgetmanager.php");
include("navbar.php");

$catID = 0;
if ( isset($_GET["id"]) ){
	$catID = $_GET["id"];
}

$catName = WidgetManager::getCategoryName($catID);

$widgets = WidgetManager::getFromCategory($catID);
?>
<!DOCTYPE html>
<html>
<head>
<title>Wally&apos;s Widget World - <?php echo $catName; ?></title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="common.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="common.js"></script>
</head>
<body>
<?php print_navbar("category_page"); ?>

Okay so you asked me what sort of products are in <?php echo $catName; ?>. Well, let me tell you:
<div class="list-inline" id="products">
<?php
	foreach ($widgets as $w){
		echo '<a class="product list-group-item" href="product.php?id=' . $w["widgetID"] . '">' . $w["widgetName"] . '<span class="addtocart" widgetid="'.$w['widgetID'].'">Add To Cart</span></a>';
	}
?>
</div>
Thats most of them at least.
</body>
</html>
