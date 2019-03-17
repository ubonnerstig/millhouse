<?php
session_start();
include 'includes/header.php';
if(isset($_SESSION['user_id'])){
    header("Location: views/main_page_2.php");
}
?>

<body class="body_index">

    <header role="banner">
        <div class="container-fluid">
            <img src="images/hero_image.svg" class="hero_image" alt="Logo Big">    
        </div>
        <nav role="navigation">
        </nav>
    </header>

        <main role="main">

            <form action="views/login.php" class="form_index" method="post">    
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label class="sr-only" for="username">Username</label>
                        <input type="text" class="form-control border-0" name="username" Placeholder="Username">
                    </div>
                    <div class="form-group col-md-6">
                    <label class="sr-only" for="password">Password</label>
                        <input type="password" class="form-control border-0" name="password" Placeholder="Password">
                    </div>
                </div>
                <button type="submit" class="btn btn-success" name="login">Log in <i class="fas fa-sign-in-alt"></i></button><br/>
                <p>Not a member? <a href="views/register_user.php">Register</a></p>
            </form>
        </main>

    <footer role="contentinfo">
        <address>
          <p>For further information, please contact <a href="mailto:admin@millhouse.com">Millhouse</a>.</p>
        </address>
        <small>Copyright &copy; <time>2018</time></small>
    </footer>

</body>
</html>