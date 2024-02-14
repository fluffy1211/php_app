<?php include "partials/header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <?php if ($uri === 'index.view.php') : ?>
        <link rel="stylesheet" href="views/style/style.css">
    <?php else : ?>
        <link rel="stylesheet" href="style/style.css">
    <?php endif; ?>


    <script src="/views/scripts/app.js" defer></script>
</head>
<body>
    
<h1>Bienvenue sur mon app en PHP</h1>

</body>
</html>


<?php include "partials/footer.php"; ?>

