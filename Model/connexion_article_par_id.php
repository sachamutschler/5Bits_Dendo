<?php

try{
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $conn = new PDO('mysql:host=localhost;dbname=dendo;charset=utf8', 'root', '', $pdo_options);
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}



$sql = "SELECT * FROM produit WHERE id_produit = :id_produit ";

$result = $conn->prepare($sql);

$result->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_INT);

$result->execute();

$produit = $result->fetchAll(PDO::FETCH_ASSOC);

$result->closeCursor();
