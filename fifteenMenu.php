<!-- <?php
    if(isset($_POST["submit"])) {
        $target_dir = realpath(dirname(getcwd()));
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?> -->

<?php 
    session_start();
    if (isset($_POST["submit"])) {
        $_SESSION["size"] = $_POST["size"];
        echo $_SESSION["size"];
        header("Location: fifteen.php");
    }
?>

<!DOCTYPE html>
<html>
<body>

    <form action="fifteenMenu.php" method="post" >
        <input type="radio" name="size" value=4> 4
        <input type="radio" name="size" value=5> 5
        <input type="radio" name="size" value=6> 6 <br />
<!--         Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"> -->
        <input type="submit" name="submit" value="Start">
    </form>

</body>
</html>