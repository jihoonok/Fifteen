<?php
if(isset($_GET['userid']) && isset($_GET['score'])){
	session_start();
	
	$host = "localhost";
		$user = "dbuser";
		$password = "goodbyeWorld";
		$database = "groupdb";
		if(isset($_GET['game'])){
			$table = "fifteen_scores";
		}else{
			$table = "4096_scores";
		}
		$conn = new mysqli($host, $user, $password,$database);
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		echo "Connected successfully";
		
		$sqlQuery = "Select score from {$table}
			where username = '{$_SESSION['userNameValue']}'";
			$result =$conn->query($sqlQuery);
				if ($result) {
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							 if($row["score"] === null || $row["score"] < $_GET['score']){
								$sqlQuery = "UPDATE {$table} set score= '{$_GET['score']}'
									where username = '{$_SESSION['userNameValue']}';";
								$conn->query($sqlQuery);
							 }
						}
					} else {
						echo "0 results";
					}
$conn->close();
				} else {
					echo "Error: " . $sqlQuery . "<br>" . $conn->error;
				}
}

?>