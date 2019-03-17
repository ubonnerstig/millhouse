<?php
session_start();
if(empty($_SESSION['user_id'])){
    header("Location: ../index.php?error=please_login");
}

include '../includes/database_connection.php';
include '../includes/db_fetches.php';
include '../includes/functions.php';
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>Millhouse</title>
</head>
<body id="main-page">
<?php
include '../includes/bootstrap_js.php';
?>

<!-- N A V . B A R -->
<nav class="navbar navbar-default navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="main_page_2.php?"><img class="d-inline-block navbarLogo" src="../images/Nav-logo.png" alt="Millhouse logo"></a>
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

<!--- H E A D E R  CONTENT--->
<header class="hero_header">
    <div class="inner-container">
        <img class="heroLogo" src="../images/logo_whr.svg">
    </div>
</header>

<main class="container post_section">
    <section data-aos="fade-up" data-aos-duration="2000" class="row latest_featured_article">

        <?php foreach($all_posts as $key => $single_post){?>
            <div class="col-12 col-md-6 post_parallax">
                <a href="single_post.php?<?=$single_post['id'];?>=<?=$single_post['slug'];?>">
                    <div class="blog-image-frame">
                        <img src="../<?=$single_post['image'];?>">
                    </div>
                </a>
                <div class="text-block">
                    <h4><?=$single_post['title'];?></h4>
                    <p><?=excerpt($single_post['description'], $single_post['id'], $single_post['slug']);?></p>
                    <?php if($_SESSION["admin"] == 1){?><a class="admin-link" href="edit_post.php?remove_post=<?=$single_post['id'];?>">Remove post</a> | <a class="admin-link" href="edit_post.php?<?=$single_post['id'];?>=<?=$single_post['slug'];?>">Edit post</a> <?php } ?>
                </div>
            </div>
            <?php } ?>
    </section>

</main>
<script>
    AOS.init();
</script>

</body>
</html>