<?php

session_start();

// Adresse de base qu'on transforme en tableau et qui sépare avec les /
$array = explode('/', $_SERVER['REQUEST_URI']);
// On vient chercher le dernier item du tableau
$uri = $array[count($array) - 1];
var_dump($uri);

$uri === 'index.view.php' ? $path = 'views/' : $path = '';

echo $_SERVER['SCRIPT_NAME'];



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="<?= $path ?>style/style.css">
</head>
<body>

    <nav>
        <ul>
                <li><a href="../index.view.php">Home</a></li>
                

            <?php if ($_SESSION['user']['logged']) :  ?>

                <li><a href="<?= $path ?>products.view.php">Products</a></li>
                <li><a href="<?= $path ?>cart.view.php">Cart</a></li>
                <li><a href="<?= $path ?>profile.view.php">Profile</a></li>
                <li><a href="<?= $path ?>contact.view.php">Contact</a></li>
                <li><a href="<?= $path ?>logout.view.php">Logout</a></li>


            <?php else : ?>
                <li><a href="signup.view.php">Signup</a></li>
                <li><a href="login.view.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>