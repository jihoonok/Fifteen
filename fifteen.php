<?php
	session_start();
	$tile = 15;
	$level = "Level 1";
	$sizes = $_SESSION["size"];
	if ($sizes == 4) {
		$_SESSION["pixel"] = 400;
	} else if ($sizes == 5) {
		$_SESSION["pixel"] = 500;
		$tile = 24;
		$level = "Level 2";;
	} else if ($sizes == 6) {
		$_SESSION["pixel"] = 600;
		$tile = 35;
		$level = "Level 3";;
	}
?>

<!doctype html>
	<html>
		<head> 
			<meta charset="utf-8">
			<title>15-Puzzle</title>			
			<link rel="stylesheet" type="text/css"  href="css/fifteenStyle.php"/>
			<script type="text/javascript">
				var size = "<?php echo $sizes ?>";
            </script>
			<script src="fifteen.js" type="text/javascript"></script>
			<link href="https://webster.cs.washington.edu/images/fifteen/fifteen.gif"
				  type="image/gif" rel="shortcut icon" />"
		</head>
		<body>        	
            <a href="fifteenMenu.php"><button class="submit" type="button">Settings</button></a>
            <a href="menu.php"><button class="submit" type="button">Main Menu</button></a><br>
            
        	<h1><u><?php echo $tile ?>-PUZZLE</u></h1>
            <h3>Difficulty: <?php echo $level ?></h3>
            
			<div id="puzzlearea">
			<!--
				this area holds the actual fifteen puzzle pieces
				add to it as you need to
			-->
			</div>

			<div id="control">
				<p id="controls">
					<button class="submit" id="shufflebutton">Shuffle</button>
				</p>
			</div>

			<div id="output"></div>
		</body>
</html>