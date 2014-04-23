<?php 
include("widgetmanager.php");
include("../auth.inc");
$catID = 0;
if ( isset($_GET["id"]) ){
	$catID = $_GET["id"];
}
WidgetManager::dbConnect($dbName, $dbPass);

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
</head>
<body>
<h1>Wally&apos;s Widget World</h1>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active"><a href="category.php?id=<?php echo $catID; ?>"><?php echo $catName; ?></a></li>
</ol>
Okay so you asked me what sort of products are in <?php echo $catName; ?>. Well, let me tell you:
<div class="list-inline" id="products">
<?php
	foreach ($widgets as $w){
		echo '<a class="product list-group-item" href="product.php?id=' . $w["widgetID"] . '">' . $w["widgetName"] . '</a>';
	}
?>
</div>
Thats most of them at least.
</body>
</html>
