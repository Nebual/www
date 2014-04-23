<?php
class WidgetManager {

	//list of widgets so that we only need to load them once per page
	private static $widgets = array(
				array( "WidgetId", "CategoryID", "widgetName", "price", "weight", "size")
				, array( 0, 0, "Spartan", 2, 0.5, 1 )
				, array( 1, 0, "Red Delicious", 1.5, 0.7, 2 )
				, array( 2, 0, "Honeycrisp", 2.5, 0.4, 1 )
				, array( 3, 1, "Charles", 25000.99, 80.3, 3 )
				, array( 4, 1, "Eugene", 32000.99, 94.2, 4 )
				, array( 5, 1, "Daisy", 29000.99, 63.7, 2 )
				, array( 6, 2, "Belgium", 4.5, 0.2, 4 )
				, array( 7, 2, "Eggo", 0.75, 0.1, 1 )
			);
			
	private static $categories = null;

	//returns an array of categories where the key is the category number
	public static function getCategories($forceReload=false) {
		if (!self::$categories || $forceReload) {
			self::loadCategories();
		}
			return self::$categories;
	}
	
	//load the categories from somewhere
	private static function loadCategories(){
		self::$categories = array("Apples", "Orangutans", "Waffles");
	}
	
	//returns the name of the category with $catID
	public static function getCategoryName($catID){
		$cats = self::getCategories();
		if (isset($cats[$catID])) {
			return $cats[$catID];
		} else {
			return "Category Not Found!";
		}
	}
	
	//returns an unordered array of widgets by index that fall under a category
	public static function getFromCategory($catID) {
		$cw = array();
		foreach (self::$widgets as $w) {
			if ($w[1] == $catID) {
				array_push($cw,$w);
			}
		}
		return $cw;
	}
	
	//returns an array representation of the widget with widID
	public static function getWidget($widID){
		foreach (self::$widgets as $w) {
			if ($w[0] == $widID) {
				return $w;
			}
		}
	}
}
?>