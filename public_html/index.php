<?PHP

// Putting sections in heredoc chunks for now
$header = <<<EOT
<!DOCTYPE html>
<html>
<head>
<title>Wally&#39;s Widget World - Product Categories</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="common.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

EOT;

$body = <<<EOT
<body>
<h1>Wally&#39;s Widget World</h1>
<ol class="breadcrumb">
  <li class="active"><a href="index.php">Home</a></li>
</ol>
Man have we ever got Widget Categories!
<div class="list-group" id="categories">
	<a class="category list-group-item" href="category.php?id=1">Category A</a>
	<a class="category list-group-item" href="category.php?id=2">Category B</a>
</div>
</body>
</html>
EOT;

print $header . $body;

?>
