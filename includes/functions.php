<?php

function getComments($pdo, $post_id) {
    
    $statement = $pdo->prepare(
        "SELECT comments.*, users.username AS username
        FROM comments 
        JOIN users
        ON users.user_id = comments.created_by
        WHERE post_id = :post_id
        ORDER BY comments.created_at ASC");
    
        $statement->execute([
            ":post_id"     => $post_id,
        ]);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $comments;
}

function test_input($data) // exempel

{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Ulrica function

//Creates excerpt for blogposts on main_page
function excerpt($string, $post_id, $post_slug){
    $string = strip_tags($string);
    if (strlen($string) > 40) {

        // truncate string
        $stringCut = substr($string, 0, 40);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= "... <a href='single_post.php?$post_id=$post_slug'>Read More</a>";
    }

    return $string;
}

//Remove image from database and folder and if any posts uses the image the image ID will be set to 0
if(isset($_GET['remove_image'])){
	$image_id = $_GET['remove_image'];

	$statement = $pdo->prepare(
        "SELECT image FROM images WHERE id = :image_id;

        UPDATE posts 
        SET image = 0
        WHERE image = :image_id;");
	
	$statement->execute([
		":image_id"     => $image_id,
	]);
	$image_location = $statement->fetchAll(PDO::FETCH_ASSOC);

	unlink("../".$image_location[0]['image']);

	$statement = $pdo->prepare("DELETE FROM images WHERE id = :image_id");
	$statement->execute([
		":image_id"     => $image_id,
	]);
    
    if(isset($_GET['post_id']) && isset($_GET['slug'])){
    header("Location: ?" . $_GET['post_id'] . "=" . $_GET['slug'] . "&success");	
    }else{
    header("Location: ?success");	
    }
}

//Remove specific post from database
if(isset($_GET['remove_post'])){
	$post_id = $_GET['remove_post'];

	$statement = $pdo->prepare(
        "DELETE FROM posts WHERE id = :post_id;
        
        DELETE FROM post_category WHERE post_id = :post_id;

        DELETE FROM comments WHERE post_id = :post_id;");
	$statement->execute([
		":post_id"     => $post_id,
	]);

	header("Location: main_page_2.php");	
}

//Remove specific comment from database
if(isset($_GET['remove_comment'])){
	$comment_id = $_GET['remove_comment'];

	$statement = $pdo->prepare("DELETE FROM comments WHERE id = :comment_id");
	$statement->execute([
		":comment_id"     => $comment_id,
	]);

	header("Location: ?" . $_GET['post_id'] . "=" . $_GET['slug']);	
}

//slut ulrica function