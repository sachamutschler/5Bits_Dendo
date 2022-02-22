<?php
    session_start();
    include ('navbar.php');
    include ('head.php');
    include ('post_contact.php');
?>

<div class="w-100 conteneur-form">
<form action="" method="post" name="contact-form" class="contact-form w-50">
    <h2>Formulaire de contact : </h2>
    <div>
        <label for="exampleFormControlInput1" class="objet-form">Objet :</label>
        <input class="form-control" type="text" placeholder="Default input" aria-label="default input example" name="objet">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" >Adresse email :</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Descriptif de la demande :</label>
            <textarea class="form-control description" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
        </div>

        <button type="submit" name="button" class="btn btn-primary">Envoyer</button>
        <div class = "g-recaptcha" data-sitekey = "site_key"></div>

        <?php 
            if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                $secret = 'your_actual_secret_key'; 
                $verifyResponse = file_get_contents ('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST [' g-recaptcha-response ']); 
                $responseData = json_decode ($verifyResponse); 
            if ($responseData-> success) {
                $succMsg = 'Votre demande de contact a été envoyée avec succès.'; 
            } 
            else {
                $errMsg = 'La vérification du robot a échoué, veuillez réessayer.'; 
            }
        } 
        ?>

    </div>
    
</form>
</div>

<?php
    include ('footer.php');
    
?>