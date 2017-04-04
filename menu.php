<?php
	session_start();
	require_once("support.php");

	if (isset($_POST["logout"])) {
		session_destroy();
		header("Location: main.php");
	} else if (isset($_POST["play"])) {
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
					<h1 align="center">Menu</h1>
					<input class="submit" type="submit" name="play" value="PLAY" />
					<input class="submit" type="submit" name="score" value="MY SCORES"/>
					<input class="submit" type="submit" name="score" value="LEADERBOARD"/>
					<input class="submit" type="submit" name="logout", value="LOGOUT"/>
				</form>
			</div>
EOBODY;
	
		$page = generatePage($body, $title,$style);
				echo $page;	
	}
?>

