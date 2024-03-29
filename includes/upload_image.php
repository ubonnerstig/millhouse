<?php
$imageErr = "";

if(isset($_FILES["image"])){
    $image = $_FILES["image"];
    $temporary_location = $image["tmp_name"];
    $target_dir = "../images/uploads/";
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($temporary_location);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            $imageErr = "Image type not valid";
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
        $imageErr = "File already exists";
    }
    // Check file size
    if ($image["size"] > 500000) {
        $uploadOk = 0;
        $imageErr = "Your file was not uploaded, max 500kB";
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
        $imageErr = "Invalid image format, only jpeg, png and gif allowed";
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //$imageErr = "Sorry, your file was not uploaded.";
       
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($temporary_location, $target_file)) {

            //echo "The file ". basename( $image["name"]). " has been uploaded.";
            $statement = $pdo->prepare("INSERT INTO images (image) VALUES (:image)");
            $statement->execute([
                //trim away ../ since that will create issues for files that has a different place in the file structure
                ":image" => trim($target_file, "../"),
            ]);
            
            if(isset($_POST['post_id']) && isset($_POST['post_slug'])){
                echo "POST";
                header("Location: ?" . $_POST['post_id'] . "=" . $_POST['post_slug']. "&success");
            }else{
                echo "INTE POST";
                header('Location: ?success');
            }
        } else {
            $imageErr = "Sorry, there was an error uploading your file.";
        }
    }
}
?>