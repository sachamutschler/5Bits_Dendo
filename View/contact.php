<?php
    session_start();
    include ('navbar.php');
    include ('head.php');
    include ('post_contact.php');
?>

<div class="w-100 conteneur-form">

<form action="" method="post" name="contact-form" class="contact-form w-50">


    <h2 id="titre">Formulaire de contact : </h2>


    <div>
        <div class="">
            <div>
                <input class="form-control" type="text" placeholder="Objet" aria-label="default input example" name="objet">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Adresse mail" name="email">
            </div>
        </div>
        
        <div class="mb-3">
            <textarea class="form-control description" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Description"></textarea>
        </div>

        <button type="submit" name="button" class="btn btn-primary" id="btn">Envoyer</button>

        
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