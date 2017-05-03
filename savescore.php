<?php
if(isset($_POST['userid']) && isset($_POST['score'])){
	
	$host = "localhost";
		$user = "dbuser";
		$password = "goodbyeWorld";
		$database = "groupdb";
		$table = "4096_scores";
		$conn = new mysqli($host, $user, $password,$database);
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		echo "Connected successfully";
		
		$sqlQuery = "Select score from 4096_scores
			where username = '{$_SESSION['userNameValue']}';";
			$result =$conn->query($sqlQuery);
				if ($result === TRUE) {
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							 if($row["score"] === null || $row["score"] < $_POST['score']){
								$sqlQuery = "UPDATE 4096_scores set score= '{$_POST['score']}'
									where username = '{$_SESSION['userNameValue']}';"
								$conn->query($sqlQuery);
							 }
						}
					} else {
						echo "0 results";
					}
$conn->close();
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
}

?>