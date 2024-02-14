<?php

// Page tunnel qui nous permet de supprimer un produit

// On récupère l'id du produit que l'on veut supprimer
// Puis on le retre dde nos variables de session acec unset
// On veut supprimer un seul élément et pas tous les produits

session_start();
 
if (isset($_GET['delete'])) {
 
    $product_id = $_GET['delete'];
 
    if (isset($_SESSION['user']['cart'][$product_id])) {
        if ($_SESSION['user']['cart'][$product_id]['quantity'] > 1) {
            $_SESSION['user']['cart'][$product_id]['quantity']--;
        } else {
            unset($_SESSION['user']['cart'][$product_id]);
        }
    }
 
    header('Location: cart');
}
 
?>


