<?php

if(isset($_POST['button'])) {
    $objet = $_POST['objet'];
    $message = $_POST['description'];
    $mail = $_POST['email'];
    $headers = 'FROM: '. $mail;
    mail('mail@mail.com', $objet, $message, $headers);
    echo('Le mail a été envoyé avec succès.');
}
elseif(isset($_POST['button'])){
    echo('Une erreur est survenue');
}