<?php session_start() ?>
<?php header("Content-type: text/css"); ?>
body {
	text-align: center;
	font-size: 14pt;
	font-family: cursive;
}

#puzzlearea {
	width: <?php echo $_SESSION["pixel"]?>px;
	height: <?php echo $_SESSION["pixel"]?>px;
	position: relative;
	margin-left: auto;
	margin-right: auto;
}

.tiles {
	border: 5px solid black;
	cursor: default;
}

.tilesHover {
	border: 5px solid red;
	cursor: pointer;
}

.tiles, .tilesHover {
	position: absolute;
	background-image: url("background.jpg");
	width: 90px;
	height: 90px;
	font-size: 40pt;
}

.control {
	padding-top: 100px;
}