<?php

ob_start();

include "partials/header.php";
include "config/dbconfig.php";

// Coder la logique pour le login

// Vérifier que le form ait été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];


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
        
        $hashed_password = $user['password'];

        // Comparer les mots de passe
        if (password_verify($password, $hashed_password)) {
            // On peut démarrer une session
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['user']['logged'] = true;
            
            // On redirige vers une page home ou profile
            header('Location: profile');
            ob_end_flush();
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect";
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

include "partials/footer.php";

?>