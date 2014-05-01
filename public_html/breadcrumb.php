<?PHP

// Returns the HTML for the breadcrumb in string format
function print_breadcrumb($calling_page){

	global $catName, $widget, $catID;
	$bc_html = "<ol class='breadcrumb'>\n";
	$bc_close = "</ol>\n";
	$bc_index = "<li><a href='index.php'>Home</a></li>\n";
	$bc_cat_cat = "<li><a href='category.php?id=" . $catID . "'>" .
		"$catName</a></li>\n";
	$bc_prod_cat = "<li><a href='category.php?id=" . $widget["categoryID"] . "'>" .
		"$catName</a></li>\n";
	$bc_prod = "<li><a href='product.php?id=" . $widget["widgetID"] . "'>" . 
		$widget["widgetName"] . "</a></li>\n";
	$bc_cart = "<li><a href='shoppingcart.php'>Shopping Cart</a></li>";

	/* Append breadcrumb strings into the printed HTML string:
	 * If the index calls this, return just the Home link.
	 * If the category page calls this, return Home and catName.
	 * If the product page calls this, return Home, catName, and widgetName. */
	if ($calling_page == "index_page"){
		$bc_html .= $bc_index;
	}
	elseif ($calling_page == "category_page"){
		$bc_html .= $bc_index . $bc_cat_cat;
	}
	elseif ($calling_page == "product_page"){
		$bc_html .= $bc_index . $bc_prod_cat . $bc_prod;
	}
	elseif ($calling_page == "shoppingcart_page"){
		$bc_html .= $bc_index . $bc_cart;
	}
	else {
		print "Error: invalid parameter for breadcrumb.php(print_breadcrumb())";
	}

	$bc_html .= $bc_close;
	print $bc_html;
}
?>
