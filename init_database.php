<?php
	//Database Variable Initialization	
	$host = "localhost";
	$user = "dbuser";
	$password = "goodbyeWorld";
	$database = "groupdb";
	$table1 = "userinfo";
	$table2 = "fifteen_scores";
	$table3 = "4096_scores";
	
	// Create connection to root
	$conn = new mysqli($host,"root","");
	
	//Check if it fails
	if ($conn->connect_error) {
  	  die("Connection failed: " . $conn->connect_error);
	} 
	
	//Check if database - "groupdb" exists
	$sqlQuery = "SHOW DATABASES";
	$result = $conn->query($sqlQuery);
	$found = false;
	while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		//"groupdb" already exists
		if($recordArray['Database'] == $database) {
			$found = true;
			break;
		}
	}
	
	//create "groupdb" if it does not exist
	if (!$found) {	
		
		//Create database
		$conn->query("CREATE DATABASE $database");	
		
		//Creater user
		$conn->query("CREATE USER '$user'@'$host' IDENTIFIED BY '$password'");
		
		//Grant user access to DB
		$conn->query( "GRANT ALL PRIVILEGES ON $database.* TO '$user'@'$host'");
		
		//CONNECT TO NEW DATABASE AND USER
		$conn = new mysqli($host, $user, $password, $database);	
		
		//Create table for Fifteen scores
		$result = $conn->query("CREATE TABLE $table2(username varchar(50) primary key, image BLOB, name varchar(255), score int)");
		
		//Create table for  4096 scores
		$result = $conn->query("CREATE TABLE $table3(username varchar(50) primary key, score int)");
		
		//Create table for userinfo
		$conn->query("CREATE TABLE $table1(username varchar(50) primary key, password varchar(250))");
	}
	
	$conn->close();
?>