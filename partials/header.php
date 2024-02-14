<?php

session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <?php if ($uri === 'index') : ?>
        <link rel="stylesheet" href="/views/style/style.css">
    <?php else : ?>
        <link rel="stylesheet" href="/views/style/style.css">
    <?php endif; ?>


    <script src="scripts/app.js" defer></script>
</head>
<body>

    <nav>
        <!-- <img src="<?= $path ?>assets/icons/burger.png" alt="burger loading"> -->
        <ul>
                <li><a href="/">Home</a></li>
            

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['logged']) :  ?>

                <li><a href="products">Products</a></li>
                <li><a href="cart">Cart</a></li>
                <li><a href="profile">Profile</a></li>
                <li><a href="contact">Contact</a></li>
                <li><a href="logout">Logout</a></li>


            <?php else : ?>
                <li><a href="signup">Signup</a></li>
                <li><a href="login">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>