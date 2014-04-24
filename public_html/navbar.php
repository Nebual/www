<?php
include("breadcrumb.php");

// Prints the navbar div + calls the breadcrumb according to the calling page
function print_navbar($calling_page){
	print "<div id='navbar'>\n";
	print "<img src='logo.png' style='{position:absolute; left:0px;}'>";
	print "<span id='head1'>Wally&apos;s Widget World</span>\n";
	print_breadcrumb($calling_page);
	print "</div>\n";
}

?>

