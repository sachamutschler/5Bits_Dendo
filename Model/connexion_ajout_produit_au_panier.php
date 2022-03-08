<?php

require_once ('connexion_bdd.php');
$requete_select_panier = "SELECT * FROM panier WHERE id_produit = :id_produit";
$result_select_panier = $conn->prepare($requete_select_panier);
$result_select_panier->bindValue(':id_produit', $_POST['id_produit_ajout_panier'], PDO::PARAM_INT);
$result_select_panier->execute();
$tableau_select_panier = $result_select_panier->fetchAll(PDO::FETCH_ASSOC);
$result_select_panier->closeCursor();

if(count($tableau_select_panier) == 0) {
    $requete_produit = "INSERT INTO panier (quantite, id_produit, id_compte_client) VALUES (:quantite, :id_produit, :id_compte_client)";
    $qte = $_POST['qte_ajout_panier'];
}
else {
    $requete_produit = "UPDATE panier SET quantite = :quantite WHERE id_produit = :id_produit AND id_compte_client = :id_compte_client";
    $qte = $_POST['qte_ajout_panier'] + $tableau_select_panier[0]['quantite'];
}

$result_produit = $conn->prepare($requete_produit);
$result_produit->bindValue(':quantite', $qte, PDO::PARAM_INT);
$result_produit->bindValue(':id_produit', $_POST['id_produit_ajout_panier'], PDO::PARAM_INT);
$result_produit->bindValue(':id_compte_client', $_POST['id_utilisateur_ajout_panier'], PDO::PARAM_INT);
$result_produit->execute();
$result_produit->closeCursor();