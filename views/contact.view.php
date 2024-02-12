<?php 

include "../partials/header.php";

// require_once '../config/php_mailer_config.php';
require_once '../vendor/autoload.php';

?>

<h1>Page de contact</h1>

<form method="POST" class="contact-form">
    <h2>Nous contacter</h2>

    <p><label>Adresse Mail</label> 
    <input style="cursor: pointer;" name="mail" type="email" /></p>
    
    <p><label>Sujet</label> 
    <input name="subject" type="text" /></p>

    <p><label>Message</label>  
    <textarea name="message"></textarea> </p>
       
    <p><input type="submit" value="Send" name="submit" /></p>
</form>

<?php 

include "../partials/footer.php";

require_once '../controllers/contact.php';

?>