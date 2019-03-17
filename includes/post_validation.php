<?php

if(isset($_SERVER)){
	
	// Giving all variables below an empty string as value so they are predefined
	$title = $category = $description = "";
	$titleErr = $categoryErr = $descriptionErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		// If the post variable is empty, set a value to the error variable which prints out on the page
		if (empty($_POST["title"])) {
                  $titleErr = 1;
		} else {
                  $title = test_input($_POST["title"]);
		}
		
		if (empty($_POST["category_id"])) {
			$categoryErr = "Please choose a category";
		} else {
			$category = test_input($_POST["category_id"]);
		}
		
		if (empty($_POST["description"])) {
			$descriptionErr = 1;
		} else {
                  $description = test_input($_POST["description"]);
		}
		
		//Makes sure all error variables are empty before proceeding
		if (empty($titleErr) && empty($categoryErr) && empty($descriptionErr)){

			//Make a new object and call method in pPost class
            $post = new Post($pdo);
            $post->createPost($title, $_POST["description"], $_SESSION["user_id"], $_POST["image_id"], $_POST["published"], $category);

            header("Location: main_page_2.php");	
            } 
	}		
}


?>