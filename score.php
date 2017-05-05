<?php
	$body = "";

		$host = "localhost";
		$user = "dbuser";
		$password = "goodbyeWorld";
		$database = "groupdb";
		$table_2 = "fifteen_scores";
		$table_1 = "4096_scores";
		$db = connectToDB($host, $user, $password, $database);

		$sqlQuery = sprintf("select * from %s order by score asc limit 10", $table_1);
		$sqlQuery2 = sprintf("select username,image,name,score from %s order by score asc limit 10", $table_2);
		
		$result = mysqli_query($db, $sqlQuery);
		$result2 = mysqli_query($db, $sqlQuery2);
		if ($result) {
			$body = "";
			$body .= "<h1>Scoreboard</h1>";
			$body .= "<table border=1><tbody>";
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
		
		if ($result2) {
			$body .= "<table border=1><tbody>";
			while ($recordArray = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				$body .= "<tr>";
				$body .= "<td>".$recordArray['username']."</td>";
				//Gabe image here
				$body .= "<td><img src='css/".$recordArray['name']."'/></td>";
				$body .= "<td>".$recordArray['score']."</td>";
				$body .= "</tr>";
			}
			$body .= "</tbody></table><br />";
		} else {
			$body = "Retrieving records failed.".mysqli_error($db);
		}
		
		
		mysqli_close($db);	


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
	</body>
</html>