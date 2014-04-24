<?PHP
include("widgetmanager.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Wally&apos;s Widget World - Product Categories</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="common.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>
<?php print_navbar("index_page"); ?>
Man have we ever got Widget Categories!
<div class="list-group" id="categories">

<?php
//load the categories from the database
$categories = WidgetManager::getCategories();

foreach ($categories as $catid => $catname) {
	print '<a class="category list-group-item" href="category.php?id='.$catid.'">'.$catname.'</a>';
}
?>
</div>
</body>
</html>

