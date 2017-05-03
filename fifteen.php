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
			<title>Puzzle</title>			
			<link rel="stylesheet" type="text/css"  href="css/fifteenStyle.php"/>
			<script type="text/javascript">
				var size = "<?php echo $sizes ?>";
            </script>
			<script src="fifteen.js" type="text/javascript"></script>
			<link href="https://scontent-iad3-1.xx.fbcdn.net/v/t31.0-8/17358868_10211053014954882_2699185441242309355_o.jpg?oh=529ce48c0716d4180a18ff0b88cf47d3&oe=597AE827"
				  type="image/gif" rel="shortcut icon" />
		</head>
		<body>        	
            <a href="fifteenMenu.php"><button class="submit" type="button">Settings</button></a>
            <a href="menu.php"><button class="submit" type="button">Main Menu</button></a><br>
            
            <audio id="music" autoplay>
			    <source src="hello.mp3" type="audio/mp3">
			</audio>

        	<h1><u>PUZZLE</u></h1>
            <h3>Difficulty: <?php echo $level ?></h3>
            
			<div id="puzzlearea">
			<!--
				this area holds the actual fifteen puzzle pieces
				add to it as you need to
			-->
			</div>

			<h4 id="score">Score: 0</h4>

			<div id="control">
				<p id="controls">
					<button class="submit" id="shufflebutton">Shuffle</button>
				</p>
			</div>

			<div id="output"></div>
            <button class = "submit" type="button" onclick = "document.getElementById('music').pause()">Mute</button>
			<button class = "submit" type="button" onclick = "document.getElementById('music').play()">Unmute </button>
		</body>
</html>