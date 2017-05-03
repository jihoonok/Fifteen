<?php header("Content-type: text/css"); 
session_start();
if(isset($_SESSION["image"])){
	$background = $_SESSION["image"];
}else{
	$background = "background.jpg";
}
	
?>

body {
	text-align: center;
	font-size: 14pt;
	font-family: cursive;
    background: url(../backgrounds/blackwood.jpg);
}

h1, h2, h3, h4 {
	color: white;
    font-family: 'Open Sans', Arial, sans-serif;
}

#puzzlearea {
	width: <?php echo $_SESSION["pixel"]?>px;
	height: <?php echo $_SESSION["pixel"]?>px;
	position: relative;
	margin-left: auto;
	margin-right: auto;
}

.submit{
  background: #E58133;
  width: 15%;
  height: 3em;
  color: white;
  cursor: pointer;
  border: 0;
}

.submit:hover {
  background: #FF5F00;
}

#shufflebutton{
	width: 30%;
}

.tiles {
	border: 3px solid black;
	cursor: default;
}

.tilesHover {
	border: 5px solid red;
	cursor: pointer;
}

.tiles, .tilesHover {
	position: absolute;
	background-image: url(<?php echo $background;
								unset($_SESSION["image"]);?>);
	width: 90px;
	height: 90px;
	font-size: 40pt;
}