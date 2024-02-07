<?php

ob_start();

include "../partials/header.php";
// session_start();

ob_end_flush();

?>

<h1>Bienvenue <?= $_SESSION['user']['name'] ?></h1>


<!-- Afficher le nom, l'avatar, la date de création du compte, l'email -->



<div class="grid-container">
    <img class="grid-item" src="../assets/images/avatar.jpg" alt="michael scott">
    <div class="grid-item"> <p>Nom :  </p><?= $_SESSION['user']['name'] ?>
    </div>
    <div class="grid-item">Email : <br> <?= $_SESSION['user']['email'] ?></div>
    <div class="grid-item">Date de création du compte : <br> <?= $_SESSION['user']['created_at'] ?></div>
</div>


<?php

include "../partials/footer.php";

?>
