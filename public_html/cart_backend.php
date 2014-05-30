<?php

session_start();

// Check for the 'action=' url component; only do stuff if we get it
if(isset($_GET["action"])){

	// Putting the include inside the 'action' if,
	// to prevent namespace collison from 
	// getCartContents' caller
	include("widgetmanager.php");

	// Because who doesn't like to get action
	$action = $_GET["action"];

	// If we receive a widget ID via GET url, and we're adding an item
	if(isset($_GET["id"]) && $action == "add"){

		$item = $_GET["id"];
		$widget = WidgetManager::getWidget($item);
		//TODO: adjust the quantity of widgets in cart and on pages when adding
		$count =  isset($_GET["value"]) ? $_GET["value"] : 1;

		// If the widget exists already in the user's cart
		if(isset($_SESSION["cart"][$item])){
			$_SESSION["cart"][$item] += $count;
		}else{
			$_SESSION["cart"][$item] = $count;
		}
		// The message returned to the common.js AJAX success event handler
		
		$price = $widget["price"];
		
		if(isset($_SESSION["total"])){
			$_SESSION["total"] += $price;
		}else{
			$_SESSION["total"] = $price;	
		}
		
		print("Successfully added $count " . $widget["widgetName"] . " to your cart!");
	}
	elseif(isset($_GET["id"]) && $action == "remove"){

		$item = $_GET["id"];
		$widget = WidgetManager::getWidget($item);
		
		// Check that the requested item actually exists in cart,
		// then remove it from the session array
		if(isset($_SESSION["cart"][$item])){
			unset($_SESSION["cart"][$item]);
		}
		
		//subtract this widget's price from the running total
		$price = $widget["price"];
		
		if(isset($_SESSION["total"])){
			$_SESSION["total"] -= $price;
		}
		
		
	}
	elseif(isset($_GET["id"]) && $action == "quantity" && isset($_GET["value"])){

		$item = $_GET["id"];
		$widget = WidgetManager::getWidget($item);
		$price = $widget["price"];
		
		if(isset($_SESSION["cart"][$item])){
			if(isset($_SESSION["total"])){
				//subtract appropriate price for currently stored item quantity
				$_SESSION["total"] -= $price * $_SESSION["cart"][$item];
				//add appropriate price for new item quantity
				$_SESSION["total"] += $price * $_GET["value"];
			}
			$_SESSION["cart"][$item] = $_GET["value"];
		}

	}
	else {
		print("Unknown action ".$action);
	}
}

function getCartContents(){

	// Return -1 for empty carts
	if(! isset($_SESSION["cart"])){
		return -1;
	}

	// $items is the 2D array that holds the cart contents
	$items = $_SESSION["cart"];
	$widgets = array();

	foreach($items as $id=>$quantity){
		$widget = WidgetManager::getWidget($id);
		$widget["quantity"] = $quantity;
		array_push($widgets, $widget);
	}

	return $widgets;
}

?>
