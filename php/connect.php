<?php
    $servername='localhost';
	$username='u581335818_capstonev5_db';
	$password='TBwK?U9i!9r';
	$dbname = "u581335818_capstonev5_db";
	
	$con = new mysqli($servername, $username, $password, $dbname);
	
	if($con->connect_error){
		die("Connection failed: " . $con->connect_error);
	}
?>