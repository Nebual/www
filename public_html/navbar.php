<?php
include("breadcrumb.php");
include_once("widgetmanager.php");

// Prints the navbar div + calls the breadcrumb according to the calling page
function print_navbar($calling_page){
	print "<div id='navbar'>\n";
	print "<img src='logo.png' id='logo'>";
	//print "<img src='http://".str_replace(" ","",substr(WidgetManager::getSiteName(), 13)).".jpg.to/' style='width: auto; height: 100px;'>";
	print "<span id='head1'>".WidgetManager::getSiteName()."</span>\n";
	print "<a class='button' href='shoppingcart.php'>Shopping Cart</a>";
	print_breadcrumb($calling_page);
	print "</div>\n";
}

?>

