<?php 
include("widgetmanager.php");
include("../auth.inc");

$widID = 0;
if ( isset($_GET["id"]) ){
	$widID = $_GET["id"];
}

WidgetManager::dbConnect($dbName, $dbPass);
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
</head>
<body>
<h1>Wally&apos;s Widget World</h1>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="category.php?id=<?php echo $widget["categoryID"]; ?>"><?php echo $catName; ?></a></li>
  <li class="active"><a href="product.php?id=<?php echo $widget["widgetID"]; ?>"><?php echo $widget["widgetName"]; ?></a></li>
</ol>
What I gotta tell you about a product too? Okay well heres what we&apos;ve parsed so far:
<table class="table table-bordered" id="productinfo">
	<tr><th>Model</th><td><?php echo $widget["widgetName"]; ?></td></tr>
	<tr><th>Price</th><td><?php echo "$".number_format($widget["price"],2,".",","); ?></td></tr>
</table>
That should settle most questions.
</body>
</html>

