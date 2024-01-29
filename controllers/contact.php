
<?php

// On requiert notre vue pour la page de contact
require_once '../views/contact.view.php';

// On requiert notre fichier de configuration pour PHPMailer
require_once '../config/php_mailer_config.php';
require_once '../vendor/autoload.php';

// On utilise la classe PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


// Récupération des données rentrées par l'utilisateur du formulaire de contact 
if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $email = $_POST['mail'];
    $subject = htmlspecialchars($_POST['subject']);
    $body = htmlspecialchars($_POST['message']);

    // On vérifie que l'email soit au bon format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // On instancie la classe PHP Mailer cad on crée un objet $mail
        $mail = new PHPMailer(true);

        try {
            //Server settings / On configure le serveur SMTP
            $mail->isSMTP();                                            
            $mail->Host       = SMTP_HOST;                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = SMTP_USERNAME;                     
            $mail->Password   = SMTP_PASSWORD;                               
            $mail->SMTPSecure = SMTP_ENCRYPTION;            
            $mail->Port       = SMTP_PORT;                              

            //Recipients / On précise les récipients pour le mail 
            $mail->setFrom($email);
            $mail->addAddress($mail->Username, 'Gabriel'); 
            $mail->Subject = $subject;
            $mail->Body  = $body;   //Add a recipient

            // On envoie le mail 
            $mail->send();
            echo 'Message has been sent';
            var_dump('on est bon');

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $error = "Assurez vous que le mail soit au bon format";
    }
} else {
    $error = "Veuillez remplir tous les champs";
}

