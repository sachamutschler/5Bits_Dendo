<?php

session_start();

if(isset($_POST['button'])) {
    $objet = $_POST['objet'];
    $message = $_POST['description'];
    $mail = $_POST['email'];
    $headers = 'FROM: '. $mail;
    mail('contactdendo@gmail.com', $objet, $message, $headers);
    echo('Le mail a été envoyé avec succès.');
}
elseif(isset($_POST['button'])){
    echo('Une erreur est survenue');
}