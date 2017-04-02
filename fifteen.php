<?php
	session_start();
	$sizes = $_SESSION["size"];
	if ($sizes == 4) {
		$_SESSION["pixel"] = 400;
	} else if ($sizes == 5) {
		$_SESSION["pixel"] = 500;
	} else if ($sizes == 6) {
		$_SESSION["pixel"] = 600;
	}
?>

<!doctype html>
	<html>
		<head> 
			<meta charset="utf-8">
			<title>Hello</title>			
			<link rel="stylesheet" type="text/css"  href="css/fifteenStyle.php"/>
			<script type="text/javascript">var size = "<?php echo $sizes ?>";</script>
			<script src="fifteen.js" type="text/javascript"></script>
			<link href="https://webster.cs.washington.edu/images/fifteen/fifteen.gif"
				  type="image/gif" rel="shortcut icon" />"
		</head>
		<body>
			<div id="puzzlearea">
			<!--
				this area holds the actual fifteen puzzle pieces
				add to it as you need to
			-->
			</div>

			<div id="control">
				<p id="controls">
					<button id="shufflebutton">Shuffle</button>
				</p>
			</div>

			<div id="output"></div>
		</body>
</html>