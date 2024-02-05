<?php

// Page tunnel qui nous permet de supprimer un produit

// On récupère l'id du produit que l'on veut supprimer
// Puis on le retre dde nos variables de session acec unset

session_start();

if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];

    unset($_SESSION['user']['cart'][$product_id]);
    headers('Location: cart.view.php');
}


?>