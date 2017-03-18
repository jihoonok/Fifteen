<?php
	session_start();

	if (isset($_POST["logout"])) {
		session_destroy();
		header("Location: main.php");
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/> 
		<title>Menu</title>	
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="container">
			<h1>Menu</h1>
			<form action = "fifteen.php" method="post">
				<input type="submit" name="submitInfoButton" value="Play" />
			</form>
			<form action = "setting.php" method="post">
				<input type="submit" name="submitInfoButton" value="submit" />
			</form>
			<form action = "score.php" method="post">
				<input type="submit" name="submitInfoButton" value="Score"/>
			</form>
			<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<input type="submit" name="logout", value="logout"/>
			</form>
		</div>
	</body>
</html>