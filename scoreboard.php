<?php
	$body = "";
	if (isset($_POST["submitScore"])) {
		$host = "localhost";
		$user = "dbuser";
		$password = "goodbyeWorld";
		$database = "groupdb";
		$table = "scores"
		$db = connectToDB($host, $user, $password, $database);

		$sqlQuery = sprintf("select * from %s order by score asc", $table);
		$result = mysqli_query($db, $sqlQuery);
		if ($result) {
			$body = "<h1>Scoreboard</h1>";
			$body = "<table border=1><tbody>";
			while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$body .= "<tr>";
				foreach ($recordArray as $value) {
					$body .= "<td>".$value."</td>";
				}
				$body .= "</tr>";
			}
			$body .= "</tbody></table><br />";
		} else {
			$body = "Retrieving records failed.".mysqli_error($db);
		}
		mysqli_close($db);	
	}

	function connectToDB($host, $user, $password, $database) {
		$db = mysqli_connect($host, $user, $password, $database);
		if (mysqli_connect_errno()) {
			echo "Connect failed.\n".mysqli_connect_error();
			exit();
		}
		return $db;
	}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/> 
		<title>Scoreboard</title>	
	</head>

	<body>
		<?php echo $body ?>
		<form action="SubmitApplication.php" method="post"> 
			<strong>Email associated with application: </strong><input type="email" name="email"/><br /><br />
			<strong>Password associated with application: </strong><input type="password" name="password"/><br /><br />	
			<input type="submit" name="submitUpdate" value="submitUpdate"/><br /><br />
		</form>
	</body>
</html>