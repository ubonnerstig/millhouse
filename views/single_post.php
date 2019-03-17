<?php
//Start session for comment and admin 
session_start();
if(empty($_SESSION['user_id'])){
    header("Location: ../index.php?error=please_login");
}

//get database connection once
require_once '../includes/database_connection.php';
require_once '../includes/functions.php';
include '../includes/db_fetches.php';
include '../classes/Posts.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>Millhouse</title>
</head>
<body id="single-post-page">

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
    <main class="single-post-container">
        <div class="row justify-content-around">
            <!--Load single post function-->
            <?php 
            /*If a user manually types in "single_post.php" they will get this error message*/ 
            if(empty(key($_GET)) || empty($_GET[key($_GET)])){  ?>
            <div class="row no_post">
                <div class="card col-12"> 
                    <p>Please choose a post to view!</p>  
                </div>    
            </div>
            <?php 
            } else { 
                $single_post = new Post($pdo);
                $single_post = $single_post->singlePost(key($_GET), $_GET[key($_GET)]);
                ?> <br />
            
            <!--Display post image-->
            <div class="col-12">
                <div class="blog-image-frame"> 
                    <img src="../<?=$single_post[0]["image"];?>" alt="Cool Post Image">
                </div>
            </div>
            <!--Display post title-->
            <div class="col-12">
                <h1><?=$single_post[0]["title"];?></h1>
                <?php if($_SESSION["admin"] == 1){?><a class="admin-link" href="edit_post.php?remove_post=<?=key($_GET);?>">Remove post</a> | <a class="admin-link" href="edit_post.php?<?=key($_GET);?>=<?=$_GET[key($_GET)];?>">Edit post</a> <?php } ?>
            </div>
            <div class="col-12">
                <!--Display post date-->
                <p><?=$single_post[0]['created_at'];?> |
                <!--Display author-->
                <b>Author:</b> <?=$single_post[0]['author'];?> |
                <!--Display post category-->
                <b>Category:</b> <?=ucfirst($single_post[0]["category_name"]);?></p>
            </div>
            <div class="col-12" id="description">
                <!--Display post -->
                <?=$single_post[0]['description'];?>
            </div>
        </div>
        <div class="row justify-content-around">
            
            <!--Add comment form-->
            <div class="card col-12">
                <div class="card-title"><h2>Submit Your Comments</h2></div>
                  
                <div class="form-group">
                    <form method="POST" action="../includes/commentform.php">
                        <!--insert post and session values to form-->
                        <input type="hidden" name="post_id" id="single_comment" value='<?= key($_GET)?>' />
                        <input type="hidden" name="slug" id="single_comment" value='<?= $_GET[key($_GET)]?>' />
                        <input type="hidden" name="created_by" id="single_comment" value='<?= $_SESSION["user_id"]?>' />
                        <label for="single_comment">Comment</label>
                        <textarea id="single_comment" name="content" class="form-control" rows="3"></textarea>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>                  
            </div>

            <?php
            $all_comments = getComments($pdo, key($_GET));

            foreach($all_comments as $allComment => $comment): ?>
                <div class="card col-12" >
                    <h3><i class="fas fa-user"></i> <?= $comment['username'];?></h3> <p><?= $comment['created_at']; ?></p>
                    <p class="comment">"<?= $comment['content']; ?>"</p>
                    <?php if($_SESSION['admin'] == 1){ ?>
                        <a class="admin-link" href="?remove_comment=<?=$comment['id'];?>&post_id=<?=key($_GET)?>&slug=<?=$_GET[key($_GET)]?>">Remove comment</a>
                    <?php } ?>
                </div>
            <?php endforeach; ?>
            
        <?php 
            } //end else
            include '../includes/bootstrap_js.php';
        ?>
        </div>
    </main>
    <footer class="row"></footer>
</div> 

</body>
</html>