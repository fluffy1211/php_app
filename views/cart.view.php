<?php
 
// J'inclus la page sur laquelle je fais l'appel API pour récupérer les produits
include "config/curl_products.php";
include "partials/header.php";
 
// Si dans l'URL on a un paramètre product qui vaut un id alors on crée une variable
// product_id contenant le fameux id
if (isset($_GET['product'])) {
    $product_id = $_GET['product'];
}
 
?>
 
<h1>Cart</h1>
 
<!-- On vient récupérer l'id du produit que l'on veut ajouter au panier
On l'ajoute ensuite à la session au niveau de la clé cart  -->
<?php foreach($products as $product) : ?>
     <?php if ((isset($product_id) && ($product['id'] == $product_id) && (!isset($_SESSION['user']['cart'][$product_id])))) {

            $_SESSION['user']['cart'][$product_id]  = $product;
            $_SESSION['user']['cart'][$product_id]['quantity']  = 1;
            header('Location: cart');

        } elseif (((isset($product_id) && ($product['id'] == $product_id)) && (isset($_SESSION['user']['cart'][$product_id])))) {
            $_SESSION['user']['cart'][$product_id]['quantity'] += 1;
            header('Location: cart');
        } ?>

        
              
 <?php endforeach ?>
 
 <!-- Si jamais on a bien des éléments dans notre cart alors on les affiche -->
 <?php if (!empty($_SESSION['user']['cart'])) : ?>

    <?php 
    $totalCost = 0;
    foreach ($_SESSION['user']['cart'] as $item) 
        $totalCost += $item['price'] * $item['quantity'];
    ?>
 
    <?php foreach ($_SESSION['user']['cart'] as $item) : ?>
 
        <h3><?= $item['title'] ?></h3>
        <p>Prix unitaire : <?= $item['price'] ?> $</p>
        <p class="description"><?= substr($item['description'], 1, 50) ?> ...</p>
        <p>Quantité : <?= $item['quantity'] ?></p>
        <!-- Ici on veut avec unset supprimer l'élément du panier via son id -->
        <!-- Supprimer un seul élement et non tous les éléments -->
        <a class="delete-btn" href="delete?delete=<?= $item['id'] ?>">Supprimer du panier</a>
    <?php endforeach ?>

    <h2>Total : <?= $totalCost ?> $</h2>
    <?php
    $articleCount = array_sum(array_column($_SESSION['user']['cart'], 'quantity'));
    $articleText = ($articleCount == 1) ? 'article' : 'articles';
    ?>
    <h2>Nombre d'<?= $articleText ?> : <?= $articleCount ?></h2>
    <a href="checkout">Allez au checkout</a>

<?php else : ?>

    <h2>Votre panier est vide ...</h2>
 
<?php endif ?>

 
 <!-- Lien vers la page de checkout / paiement -->
 
 
<?php include "partials/footer.php"; ?>
