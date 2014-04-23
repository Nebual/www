<?php 
include("widgetmanager.php");

$widID = 0;
if ( isset($_GET["id"]) ){
	$widID = $_GET["id"];
}
$widget = WidgetManager::getWidget($widID);
$catName = WidgetManager::getCategoryName($widget[1]);



?>
<!DOCTYPE html>
<html>
<head>
<title>Wally&apos;s Widget World - <?php echo $widget[2]; ?></title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="common.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<h1>Wally&apos;s Widget World</h1>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="category.php?id=<?php echo $widget[1]; ?>"><?php echo $catName; ?></a></li>
  <li class="active"><a href="product.php?id=<?php echo $widget[0]; ?>"><?php echo $widget[2]; ?></a></li>
</ol>
What I gotta tell you about a product too? Okay well heres what we&apos;ve parsed so far:
<table class="table table-bordered" id="productinfo">
	<tr><th>Model</th><td><?php echo $widget[2]; ?></td></tr>
	<tr><th>Price</th><td><?php echo "$".number_format($widget[3],2,".",","); ?></td></tr>
</table>
That should settle most questions.
</body>
</html>

