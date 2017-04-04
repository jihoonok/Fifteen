<?php
	define ("MAX_SIZE","750");
	session_start();
    if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])) {    
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
	}else if(isset($_POST["submit"])){
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
<html>
<body>

    <form action="fifteenMenu.php" method="post" enctype="multipart/form-data">
        <input type="radio" name="size" value=4 required> 4
        <input type="radio" name="size" value=5 required> 5
        <input type="radio" name="size" value=6 required> 6 <br />
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" name="submit" value="Start">
    </form>

</body>
</html>