<?php
include("../auth.inc");
class WidgetManager {
	private static $LinkID = null;
	private static $categories = null;
	private static $siteName = "";
	
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
		$widID = (int) $widID;
		$query = "SELECT * FROM widget WHERE widgetID = $widID;";
		$result = mysql_query($query, self::$LinkID);
		echo mysql_error(self::$LinkID);
				
		$row = mysql_fetch_assoc($result);
		
		if($row){
			return $row;
		}
		return null;
	}
	
	public static function getSiteName(){
		if (self::$siteName != "") {
			return self::$siteName;
		}
		//set the name of the site owner
		$owner = mt_rand(0,1) ? "Wally&apos;s" : "Willy&apos;s";
		//grab an adjective for possible use
		$result = mysql_query( 'SELECT word FROM dubyawords WHERE type="adjective" ORDER BY RAND() LIMIT 1;', self::$LinkID);
		$adj = mysql_fetch_row($result);
		$adj = ucwords($adj[0]);
		//grab a noun
		$result = mysql_query( 'SELECT word FROM dubyawords WHERE type="noun" ORDER BY RAND() LIMIT 1;', self::$LinkID);
		$noun = mysql_fetch_row($result);
		$noun = ucwords($noun[0]);
		//grab a second noun if we don't use the adjective
		$result = mysql_query( 'SELECT word FROM dubyawords WHERE type="noun" ORDER BY RAND() LIMIT 1;', self::$LinkID);
		$noun2 = mysql_fetch_row($result);
		$noun2 = ucwords($noun2[0]);
		//concat it all together randomly
		$n2len = strlen($noun2);
		//make sure that the noun that could be a plural probably looks right
		$nounplur = $noun2;
		if ($noun2[$n2len-1] != "s" && $noun2[$n2len-1] != "y") {
			$nounplur .= "s";
		}
		$tname = $owner." ";
		if ( mt_rand(0,1) ) {
			$tname .= ( mt_rand(0,1) ? ($adj." Widgets") : ("Widget ".$noun) );
		} else {
			$tname .= ( mt_rand(0,1) ? ($adj." ".$nounplur) : ($noun." ".$noun2) );
		}
		//concat some more
		self::$siteName = mt_rand(0,1) ? $tname : $owner . " Widget World";
		//title assembled
		return self::$siteName;
	}
}
WidgetManager::dbConnect($dbName, $dbPass);
?>
