<?php

try{
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $conn = new PDO('mysql:host=localhost;dbname=dendo;charset=utf8', 'root', '', $pdo_options);
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

$requete_produit = "INSERT INTO panier (quantite, id_produit, id_compte_client) VALUES (:quantite, :id_produit, :id_compte_client)";
$result_produit = $conn->prepare($requete_produit);
$result_produit->bindValue(':quantite', $_POST['qte_ajout_panier'], PDO::PARAM_INT);
$result_produit->bindValue(':id_produit', $_POST['id_produit_ajout_panier'], PDO::PARAM_INT);
$result_produit->bindValue(':id_compte_client', $_POST['id_utilisateur_ajout_panier'], PDO::PARAM_INT);
$result_produit->execute();
$result_produit->closeCursor();