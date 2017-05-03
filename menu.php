<?php
	session_start();
	require_once("support.php");

	if (isset($_POST["logout"])) {
		session_destroy();
		header("Location: main.php");
	} else if (isset($_POST["4096"])) {
		$host = "localhost";
		$user = "dbuser";
		$password = "goodbyeWorld";
		$database = "groupdb";
		$table = "4096_scores";
		$conn = new mysqli($host, $user, $password,$database);
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		echo "Connected successfully";
		
		$sqlQuery = "INSERT INTO 4096_scores
			(username) VALUES ('{$_SESSION['userNameValue']}');";
				if ($conn->query($sqlQuery) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
		
		header("Location: 4096.php");
	} else if (isset($_POST["fifteen"])) {
		header("Location: fifteenMenu.php");
	} else if (isset($_POST["score"])) {
		header("Location: score.php");
	} else {

		$title = "Menu";
		$style = "css/signUpStyle.css";
		
		$body = "<script src=\"fifteen.js\" type=\"text/javascript\"></script>";
		$body .= "<link href=\"https://webster.cs.washington.edu/images/fifteen/fifteen.gif\"
					  type=\"image/gif\" rel=\"shortcut icon\" />";
					  
					  
		$body .= <<< EOBODY
			<div class="login">
				<form action="{$_SERVER['PHP_SELF']}" method="post">
					<h1 align="center"><u>MAIN MENU</u></h1>
					<input class="submit" type="submit" name="fifteen" value="PUZZLE"/>
					<input class="submit" type="submit" name="4096" value="4096"/>
					<input class="submit" type="submit" name="score" value="LEADERBOARD"/>
					<input class="submit" type="submit" name="logout", value="LOGOUT"/>
				</form>
			</div>
EOBODY;
	
		$page = generatePage($body, $title,$style);
				echo $page;	
	}
?>

