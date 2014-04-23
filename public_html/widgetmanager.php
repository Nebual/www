<?php
class WidgetManager {
	private static $LinkID = null;
	
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
	
	private static function dbConnect(){
		if(self::$LinkID){
			return;
		}
		
		// Connect to the MySQL server.
		self::$LinkID = mysql_connect("localhost", "c199grp01", "hunter2");

		// Die if no connect
		if (!self::$LinkID) {
		  die('Could not connect: ' . mysql_error());
		}

		// Choose the DB
		mysql_select_db("c199grp01", self::$LinkID);	
	}		

	//returns an array of categories where the key is the category number
	public static function getCategories($forceReload=false) {
		if (!self::$categories || $forceReload) {
			self::loadCategories();
		}
		return self::$categories;
	}
	
	//load the categories from somewhere
	private static function loadCategories(){
		self::dbConnect();
				
		$cats = array();
		$query = "SELECT * FROM category;";
		$result = mysql_query( $query, self::$LinkID);
		echo mysql_error(self::$LinkID);
			
		while ($row=mysql_fetch_row($result)) {
			$cats[$row[0]] = $row[1];
		}
					
		self::$categories = $cats;
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
		self::dbConnect();
		
		$catID = (int) $catID;
		$query = "SELECT * FROM widget WHERE categoryID = $catID;";
		$result = mysql_query( $query, self::$LinkID);
		echo mysql_error(self::$LinkID);
				
		$cw = array();
		while ($row=mysql_fetch_row($result)) {
			array_push($cw, $row);
		}
		return $cw;
	}
	
	//returns an array representation of the widget with widID
	public static function getWidget($widID){
		self::dbConnect();
		$widID = (int) $widID;
		$query = "SELECT * FROM widget WHERE widgetID = $widID;";
		$result = mysql_query( $query, self::$LinkID);
		echo mysql_error(self::$LinkID);
				
		$row=mysql_fetch_row($result);
		
		if($row){
			return $row;
		}
		return null;
	}
}
?>
