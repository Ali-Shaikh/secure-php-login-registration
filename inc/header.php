<?php include "func/init.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#26a69a">
    <title></title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="css/styles.css">
    <!--Import jQuery before materialize.js-->
    <script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
<nav class="teal lighten-1">
    <div class="container">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">Levi</a>
            <ul class="right hide-on-med-and-down">
                <?php if ( ! logged_in() ):?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <?php if ( logged_in() ): ?>
                    <li><a href="admin.php">Admin</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
            <ul id="nav-mobile" class="side-nav right">
                <?php if ( ! logged_in() ):?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <?php if ( logged_in() ): ?>
                    <li><a href="admin.php">Admin</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        </div>
    </div>
</nav>
<main>