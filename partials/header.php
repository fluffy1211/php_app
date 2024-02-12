<?php

session_start();

// Adresse de base qu'on transforme en tableau et qui sépare avec les /
$array = explode('/', $_SERVER['REQUEST_URI']);
// On vient chercher le dernier item du tableau
$uri = $array[count($array) - 1];

// $uri === 'index.view.php' ? $path = '/PHP CURL/tpshop' : $path = '..';

if ($_SERVER['REQUEST_URI'] === 'index.view.php') {
    $path = '';
} else {
    $path = '/PHP CURL/tpshop/';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <?php if ($uri === 'index.view.php') : ?>
        <link rel="stylesheet" href="views/style/style.css">
    <?php else : ?>
        <link rel="stylesheet" href="style/style.css">
    <?php endif; ?>


    <script src="<?= $path ?>/views/scripts/app.js" defer></script>
</head>
<body>

    <nav>
        <!-- <img src="<?= $path ?>assets/icons/burger.png" alt="burger loading"> -->
        <ul>
                <li><a href="../index.view.php">Home</a></li>
            

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['logged']) :  ?>

                <li><a href="<?= $path ?>views/products.view.php">Products</a></li>
                <li><a href="<?= $path ?>views/cart.view.php">Cart</a></li>
                <li><a href="<?= $path ?>views/profile.view.php">Profile</a></li>
                <li><a href="<?= $path ?>views/contact.view.php">Contact</a></li>
                <li><a href="<?= $path ?>views/logout.view.php">Logout</a></li>


            <?php else : ?>
                <li><a href="<?= $path ?>views/signup.view.php">Signup</a></li>
                <li><a href="<?= $path ?>views/login.view.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>