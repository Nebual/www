<?php
session_start();
if(isset($_GET["id"])){
	$item = $_GET["id"];
	
	if(isset($_SESSION["cart"][$item])){
		$_SESSION["cart"][$item] += 1;
	}else{
		$_SESSION["cart"][$item] = 1;
	}
	print("Successfully added item to cart!");
}

function getCartContents(){
	if(! isset($_SESSION["cart"])){
		return -1;
	}
	
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
