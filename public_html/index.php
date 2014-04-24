<?PHP
include("widgetmanager.php");

// Putting sections in heredoc chunks for now
$header = <<<EOT
<!DOCTYPE html>
<html>
<head>
<title>Wally&apos;s Widget World - Product Categories</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="common.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

EOT;

$body = <<<EOT
<body>
<h1>Wally&apos;s Widget World YAY TEST COMMIT 3</h1>
<ol class="breadcrumb">
  <li class="active"><a href="index.php">Home</a></li>
</ol>
Man have we ever got Widget Categories!
<div class="list-group" id="categories">
EOT;

//load the categories from the database
$categories = WidgetManager::getCategories();

foreach ($categories as $catid => $catname) {
	$body .= '<a class="category list-group-item" href="category.php?id='.$catid.'">'.$catname.'</a>';
}

$body .= <<<EOT
</div>
</body>
</html>
EOT;

print $header . $body;

?>
