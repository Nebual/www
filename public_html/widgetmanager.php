<?php
class WidgetManager {
	private static $LinkID = null;
		
	private static $categories = null;
	
	public static function dbConnect($dbName, $dbPass){
		if(self::$LinkID){
			return;
		}
		
		// Connect to the MySQL server.
		self::$LinkID = mysql_connect("localhost", $dbName, $dbPass);

		// Die if no connect
		if (!self::$LinkID) {
		  die('Could not connect: ' . mysql_error());
		}

		// Choose the DB
		mysql_select_db($dbName, self::$LinkID);	
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
		//self::dbConnect();
				
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
		//self::dbConnect();
		
		$catID = (int) $catID;
		$query = "SELECT * FROM widget WHERE categoryID = $catID;";
		$result = mysql_query( $query, self::$LinkID);
		echo mysql_error(self::$LinkID);
				
		$cw = array();
		while ($row=mysql_fetch_assoc($result)) {
			array_push($cw, $row);
		}
		return $cw;
	}
	
	//returns an array representation of the widget with widID
	public static function getWidget($widID){
		//self::dbConnect();
		$widID = (int) $widID;
		$query = "SELECT * FROM widget WHERE widgetID = $widID;";
		$result = mysql_query( $query, self::$LinkID);
		echo mysql_error(self::$LinkID);
				
		$row=mysql_fetch_assoc($result);
		
		if($row){
			return $row;
		}
		return null;
	}
}
?>
