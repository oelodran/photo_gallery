<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/my_stylesheet.css'); ?>" />
    <title>Shared Gallery</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo url_for('/index.php')?>">Shared Gallery</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
<!--            <li class="nav-item active">-->
<!--                <a id="" class="nav-link" href="#">Number of Images</a>-->
<!--            </li>-->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo url_for('/login.php'); ?>">Login</a>
            </li>
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="--><?php //echo url_for('/user/users/new.php'); ?><!--">Registration</a>-->
<!--            </li>-->
        </ul>
    </div>
</nav>
