<?php
	
	//$db = mysql_connect("localhost","root","");
	//mysqli_select_db("carpool",$db)or die( "<p><span style=\"color: red;\">Unable to select database</span></p>");
	
	
	
	$db = new PDO('mysql:host=localhost;dbname=wisdom_organizer;charset=utf8', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


	
	
?>