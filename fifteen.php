<?php
	require_once("support.php");
	session_start();
	
	$title = "Jihoon's a Bitch";
	$style = "css/fifteenStyle.css";
	
	$body = "<script src=\"fifteen.js\" type=\"text/javascript\"></script>";
	$body .= "<link href=\"https://webster.cs.washington.edu/images/fifteen/fifteen.gif\"
				  type=\"image/gif\" rel=\"shortcut icon\" />";
				  
				  
	$body .= <<< EOBODY
		<div id="puzzlearea">
		<!--
			this area holds the actual fifteen puzzle pieces
			add to it as you need to
		-->
		</div>

		<p id="controls">
			<button id="shufflebutton">Shuffle</button>
		</p>
		
		<div id="output"></div>
EOBODY;

	$page = generatePage($body, $title,$style);
			echo $page;	
?>