<?php

ob_start();

include "../partials/header.php";
session_start();

ob_end_flush();

?>


<h1>Bienvenue <?= $_SESSION['users']['name'] ?></h1>


<?php

include "../partials/footer.php";

?>
