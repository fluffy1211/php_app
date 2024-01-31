<?php

ob_start();

include "../partials/header.php";
include "../config/dbconfig.php";

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

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Write request with PDO

           $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$username, $email, $hashed_password]);

            if ($result) {
                header("Location: signup-success.view.php");
                ob_end_flush();
 
            } else {
 
                $error = "Une erreur est survenue" . $stmt->errorInfo();
 
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