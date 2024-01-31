<?php

ob_start();

include "../partials/header.php";
include "../config/dbconfig.php";
include "../utils/functions.php";



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {

        // Validate username
        // if (htmlspecialchars($username)) {
        //     echo "No special characters.";
        //     exit;
        // }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        // Validate password
        if ($password != $confirm_password) {
// Passwords match
            echo "Passwords do not match.";
            exit;
        }

        // On vérifie que le mdp corresponde aux critères de la CNIL (12 caractères, au moins 1 chiffre, 1 lettre majuscule, 1 lettre minuscule, 1 caractère spécial)
        // if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{12,}$/', $password)) {
        //     echo 'The password does not meet the requirements !';
        //     exit;
        // }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // On vérifie si le mail ou email n'existe pas en bdd
        if (checkExists('name', $username, $pdo)) {
            echo "Le nom est déjà pris";
        } else if (checkExists('email', $email, $pdo)) {
            echo "L'email est déjà pris";
        } else {
    
        // Write request with PDO
           $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$username, $email, $hashed_password]);

            if ($result) {
                // header pour redirect
                header("Location: signup-success.view.php");
                ob_end_flush();
 
            } else {
 
                $error = "Une erreur est survenue" . $stmt->errorInfo();
 
            }
 
        }

    }
}

?>


<body>
    <h1>Signup</h1>
    <form class="signup-form" method="POST">
        <input type="text" placeholder="Votre nom ici ..." name="username" required><br><br>

        <input type="email" placeholder="Votre email ici ..." name="email" required><br><br>

        <input type="password" placeholder="Votre mdp ici ..." name="password" required><br><br>

        <input type="password" placeholder="Confirmer votre mdp ..." name="confirm_password" required><br><br>

        <input type="submit" name="submit" value="Signup">
    </form>
</body>
</html>

<?php

include "../partials/footer.php";

?>