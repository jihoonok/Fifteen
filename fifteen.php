<?php
	session_start();
	$sizes = $_SESSION["size"];
?>

<!doctype html>
	<html>
		<head> 
			<meta charset="utf-8">
			<title>$title</title>			
			<link rel="stylesheet" type="text/css"  href="css/fifteenStyle.css"/>
			<script type="text/javascript">var size = "<?php echo $sizes ?>";</script>
			<script src="fifteen.js" type="text/javascript"></script>
			<link href="https://webster.cs.washington.edu/images/fifteen/fifteen.gif"
				  type="image/gif" rel="shortcut icon" />"
		</head>
		<body>
			<!-- <input type="hidden" id="size" value="<?php echo $sizes ?>"> -->
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
		</body>
</html>