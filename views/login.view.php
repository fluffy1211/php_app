<?php

include "../partials/header.php";
include "../config/dbconfig.php";

// Coder la logique pour le login

// Vérifier que le form ait été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        // Chercher en BDD l'email en question, message si l'on ne trouve rien
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            echo "L'email n'existe pas";
        } else {

        // Comparer les mots de passe
        if (password_verify($password, $user['password'])) {
            session_start(); 
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $email['email'];
            header("Location: index.view.php");
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect";
            exit;
        }
    }
}
}










?>

<body>
    <h1>Login</h1>
    <form class="login-form" method="POST">

        <input type="email" placeholder="Votre email ici ..." name="email" required><br><br>

        <input type="password" placeholder="Votre mdp ici ..." name="password" required><br><br>

        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>

<?php

include "../partials/footer.php";

?>