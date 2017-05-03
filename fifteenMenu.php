<?php
	define ("MAX_SIZE","750");
	session_start();
	
		
		
    if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])) {    
		$host = "localhost";
		$user = "dbuser";
		$password = "goodbyeWorld";
		$database = "groupdb";
		$table = "fifteen_scores";
		$conn = new mysqli($host, $user, $password,$database);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		echo "Connected successfully";
		
		$errors=0;

        $image =$_FILES["fileToUpload"]["name"];
		$uploadedfile = $_FILES['fileToUpload']['tmp_name'];

		if ($image) {
			$filename = stripslashes($_FILES['fileToUpload']['name']);
			$extension = getExtension($filename);
			$extension = strtolower($extension);
			if (($extension != "jpg") && ($extension != "jpeg") 
					&& ($extension != "png") && ($extension != "gif")) {  
				echo ' Please upload an image. ';
				$errors=1;
			}else{
				$size=filesize($_FILES['fileToUpload']['tmp_name']);
	
				if ($size > MAX_SIZE*1024){
					echo "You have exceeded the size limit";
					$errors=1;
				}
	
				if($extension=="jpg" || $extension=="jpeg" ){
					$uploadedfile = $_FILES['fileToUpload']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);
				}else if($extension=="png"){
					$uploadedfile = $_FILES['fileToUpload']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				}else {
					$src = imagecreatefromgif($uploadedfile);
				}
				
				echo "<script type=\"text/javascript\">console.log(\"hello\");</script>";
				
				$imgData =addslashes (file_get_contents($_FILES['fileToUpload']['tmp_name']));
				$sqlQuery = "INSERT INTO fifteen_scores
			(image, name, username) VALUES ('{$imgData}', '{$_FILES['fileToUpload']['name']}','{$_SESSION['userNameValue']}');";
				if ($conn->query($sqlQuery) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
		
				list($width,$height)=getimagesize($uploadedfile);
		
				if($_POST["size"] == 4){
					$newwidth=400;
					$newheight=400;
				} else if($_POST["size"] == 5){
					$newwidth=500;
					$newheight=500;	
				} else if($_POST["size"] == 6){
					$newwidth=600;
					$newheight=600;
				}
		
				$tmp=imagecreatetruecolor($newwidth,$newheight);
		
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		 		
				$filename = "css/". $_FILES['fileToUpload']['name'];
				$_SESSION["image"] = $_FILES['fileToUpload']['name'];
				$_SESSION["size"] = $_POST["size"];
		
				imagejpeg($tmp,$filename,100);
		
				imagedestroy($src);
				imagedestroy($tmp);
			}
		}
	}
	
	if(isset($_POST["submit"])){
		$_SESSION["size"] = $_POST["size"];
		header("Location: fifteen.php");
	}
	//If no errors registred, print the success message

	if(isset($_POST['submit']) && !$errors) {
		// mysql_query("update SQL statement ");
		header("Location: fifteen.php");
		echo "Image Uploaded Successfully!";
	}
	
	
	function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
	}
?> 


<!DOCTYPE html>
<html><head>
		<meta charset="utf-8">
		<title>Fifteen Settings</title>			
		<link rel="stylesheet" type="text/css"  href="css/15menu.css"/>
</head>
<body>
	<div class="menu">	
        <form action="fifteenMenu.php" method="post" enctype="multipart/form-data">
        	<h1><u>PUZZLE SETTINGS</u></h1>
        	<strong>Select Level of Dificulty:</strong><br /><br />
            <input class="radio" type="radio" name="size" value=4 id="4" required>
            <label for="4"> Level 1 - 4x4 Grid </label><br /> 
            <input class="radio" type="radio" name="size" value=5 id="5" required>
            <label for="5"> Level 2 - 5x5 Grid </label><br />
            <input class="radio" type="radio" name="size" value=6 id="6" required>
            <label for="6"> Level 3 - 6x6 Grid </label><br /><br />
            <strong>Select Image to Upload:</strong><br /><br />
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input class="submit" type="submit" name="submit" value="Start">
            <a href="menu.php"><button class="submit" type="button">Main Menu</button></a><br>
        </form>
	</div>
</body>
</html>