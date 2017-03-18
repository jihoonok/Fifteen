<?php
	require_once("support.php");
	session_start();
	
	$title = "Dennis the Penis";
	$style = "css/loginStyle.css";
	/*
	$host = "localhost";
	$user = "fifteen";
	$password = "puzzle";
	$database = "15db";
	$table = "accountinfo";
	
	$db = connectToDB($host, $user, $password, $database);
	
	/*Connecting to database
	function connectToDB($host, $user, $password, $database) {
		$db = mysqli_connect($host, $user, $password, $database);
		if (mysqli_connect_errno()) {
			echo "Connect failed.\n".mysqli_connect_error();
			exit();
		}
		return $db;
	}	
	*/
	
	if (isset($_SESSION['passwordValue']) && isset($_SESSION['userNameValue'])){
		header("Location: menu.php");
	} else {
	
		$topPart = <<<EOBODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
			<input type="text" name="login" placeholder="Username" required="true"/><br/>
          	<input type="password" name="password" placeholder="Password" required="true" /><br/>
	      	<input class="submit" type="submit" name="submit" value="Sign In">
			<a href="createaccount.php"><button class="submit" type="button">Sign Up</button></a><br>
		</form>	
		
			
EOBODY;
	
		/*VALIDATION*/
		/*Need SQL Database:
			change nameValue and passwordValue
			check if there's a match in database
		*/
		if (isset($_POST["submit"])) {
			$passwordValue = trim($_POST["password"]);
			$nameValue = trim($_POST["login"]);
			
			if ($nameValue != "cmsc289s" || ($passwordValue != "terps")) {
				$bottomPart = "<h3>Invalid login information provided.</h3><br />";
				$passwordValue = "";
				$nameValue = "";						
				$body = "<div class=\"login\">".$topPart.$bottomPart."<div>";
				$page = generatePage($body, $title);
				echo $page;
			} else {
				$topPart = "";
				$_SESSION["passwordValue"] = $passwordValue;
				$_SESSION["userNameValue"] = $nameValue;
				header("Location: menu.php");
			}
		} 	else {
			$body = "<div class=\"login\">".$topPart."<div>";
			$page = generatePage($body, $title, $style);
			echo $page;	
		}		
	}
?>