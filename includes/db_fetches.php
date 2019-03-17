<?php 

//Get all posts if no GET for categories are set, elseif get posts for specific category
if(empty($_GET['categories'])){
    $statement = $pdo->prepare(
        "SELECT posts.*, posts.image AS image_id, images.image AS image, post_category.prod_category_id AS category_id
        FROM posts
        JOIN images
        ON images.id = posts.image
        JOIN post_category
        ON post_category.post_id = posts.id
        ORDER BY posts.created_at DESC");
        
    $statement->execute([
    ]);
    $all_posts = $statement->fetchAll(PDO::FETCH_ASSOC);
}elseif(isset($_GET['categories'])){
    $category = $_GET['categories'];

    $statement = $pdo->prepare(
        "SELECT posts.id, posts.title, posts.slug, posts.description, posts.image AS image_id, images.image AS image, post_category.prod_category_id AS category_id
        FROM posts
        JOIN images
        ON images.id = posts.image
        JOIN post_category
        ON post_category.post_id = posts.id
        WHERE post_category.prod_category_id = :category
        ORDER BY posts.created_at DESC");
        
    $statement->execute([
        ":category"     => $category,
    ]);
    $all_posts = $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Get all images
$statement = $pdo->prepare("SELECT * FROM images");	
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_ASSOC);

//Get all categories
$statement = $pdo->prepare("SELECT * FROM product_category");	
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

//Fetches specific image for writing/editing blogpost

if(isset($_POST['image'])){
	$statement = $pdo->prepare("SELECT id FROM images WHERE image = :image");	
	$statement->execute([
	":image"     => $_POST["image"],
	]);
	$image_id = $statement->fetchAll(PDO::FETCH_ASSOC);

	$image_id = $image_id[0]['id'];
} else {
    $image_id = "";
	//$image_id = $single_post[0]['image_id'];
}

