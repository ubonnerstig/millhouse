<?php
session_start();

if(empty($_SESSION['user_id'])){
    header("Location: ../index.php?error=please_login");
}

include '../includes/database_connection.php';
include '../includes/db_fetches.php';
include '../classes/Posts.php';
include '../includes/upload_image.php';
require_once '../includes/functions.php';

//Defining the post id and slug as variables to make it easier to return the user to this page
$post_id = key($_GET);
$post_slug = $_GET[key($_GET)];
$single_post = new Post($pdo);
$single_post = $single_post->singlePost($post_id, $post_slug);

$openModal = false;

//Open modal on reload
if(isset($_GET['success']) || isset($_GET['error']) ){
	$openModal = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!-- Include stylesheet -->
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <title>Millhouse | Edit post</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<!-- N A V . B A R -->
<nav class="navbar navbar-default navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="main_page_2.php"><img class="d-inline-block navbarLogo" src="../images/Nav-logo.png" alt="Millhouse logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar_options" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto ">
            <li class="nav-item active">
                <div class="dropdown">
                <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category
                </a>
                <div class="dropdown-menu">
                    <a class="nav-link" href="main_page_2.php?">All Categories<span class="sr-only">(current)</span></a>
                    <?php foreach($categories as $single_category){ ?>
                        <a class="nav-link" href="main_page_2.php?categories=<?=$single_category['category_id']?>"><?=ucfirst($single_category['category'])?><span class="sr-only">(current)</span></a>
                    <?php }?>
                </div>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="mailto:admin@millhouse.com">Contact</a>
            </li>
        </ul>
        <?php if($_SESSION["admin"] == 1){?><a href="create_post.php"><button class="loginButton btn btn-default my-2 my-sm-0"><i class="fas fa-pen"></i></button></a><?php } ?>
        <a href="logout.php"><button class="loginButton btn btn-default my-2 my-sm-0"><i class="fas fa-sign-out-alt"></i></button></a>
    </div>
</nav>

<div class="container-fluid">
	<main class="post_wrap">
		<div class="row justify-content-around">
			<!-- Modal -->
			<?php include '../includes/modal.php'; ?>
			<div class="col-12">
				<div class="blog-image-frame">
				<?php if(isset($_POST["image"])){?>
					<img src="../<?=$_POST["image"];?>">
				<?php } else {?>
                    <img src="../<?=$single_post[0]["image"];?>">
                <?php } ?>
				</div>
			</div>
			<!-- Create the editor container -->
			<div class="col-12">
				<!-- Create toolbar container -->
				<div id="toolbar">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
					Choose an image
					</button>
					<span class="error"><?=$imageErr;?></span>
				</div>
				<form action="update_post.php" method="post" id="update">
					<input type="hidden" name="image_id" id="image_id" value="<?=$image_id; ?>">
					<input type="hidden" name="user_id" id="user_id" value="<?=$_SESSION["user_id"];?>">
					<input type="hidden" name="post_id" id="post_id" value="<?=$single_post[0]['id'];?>">

					<input class="post_title" aria-label="Title" id="tile" name="title" type="text" placeholder="Title" form="update" value="<?=$single_post[0]["title"];?>">
					<?php foreach($categories as $single_category){ ?>
						&ensp;
					<label for="<?=$single_category['category']?>"><?=ucfirst($single_category['category'])?></label>
                    <input type="radio" id="<?=$single_category['category']?>" name="category_id" value="<?=$single_category['category_id']?>" form="update"<?php if($single_category['category_id'] == $single_post[0]["category_id"]){ ?> checked <?php } ?>>
						
					<?php } ?>

					<div class="col-12" id="editor" contenteditable="true" name="textBox" aria-label="description">
                        <?=$single_post[0]["description"];?>
					</div>
					<input id="hiddeninput" name="description" type="hidden">

					<!-- <button type="submit" id="save" value="0" name="published" class="btn btn-secondary post" form="post">Save</button> -->
					<button type="submit" id="publish" value="1" name="published" class="btn btn-primary post" form="update">Update</button>
				</form>
				
			</div>

			<?php include '../includes/quill.php'; ?>

			<script>
			//Script for opening modal on reload if openModal == true
			var php_var = "<?php echo $openModal; ?>";

			$(document).ready(function() { 
				if (php_var){
					$('#imageUploadModal').modal('show');
				}
			});

			</script>
		</div>
	</main>
	<footer class="row"></footer>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>