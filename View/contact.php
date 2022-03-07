<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include ('head.php'); ?>
</head>

<body>

<div id="header">
    <?php include ('navbar.php'); ?>
</div>
<?php
    include ('post_contact.php');
?>

<div class="w-100 conteneur-form">

<form action="" method="post" name="contact-form" class="contact-form w-50">

    <div class="div_titre">
        <h2 id="titre">Contactez nous ! </h2>
    </div>

    <div>
        <div class="conteneur_contact1">
            <div class="div_form div_form1">
                <input class="form-control" type="text" placeholder="Objet" aria-label="default input example" name="objet">
            </div>
            <div class="div_form">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Adresse mail" name="email">
            </div>
        </div>
        
        <div class="cont_desc">
            <textarea class="form-control description" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Description"></textarea>
        </div>

        <div class="cont_btn">
            <button type="submit" name="button" class="btn" id="btn">Envoyer</button>

        </div>
        
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

</body>
</html>
