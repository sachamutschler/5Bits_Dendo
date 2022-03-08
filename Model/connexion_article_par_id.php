<?php

require_once ('connexion_bdd.php');



$requete_produit = "SELECT * FROM produit WHERE id_produit = :id_produit ";
$result_produit = $conn->prepare($requete_produit);
$result_produit->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_INT);
$result_produit->execute();
$produit = $result_produit->fetchAll(PDO::FETCH_ASSOC);
$result_produit->closeCursor();


$requete_cadre = "SELECT * FROM carac_taille_cadre WHERE id = :id_taille_cadre";
$result_cadre = $conn->prepare($requete_cadre);
$result_cadre->bindValue(':id_taille_cadre', $produit[0]['id_carac_taille_cadre'], PDO::PARAM_INT);
$result_cadre->execute();
$taille_cadre = $result_cadre->fetchALL(PDO::FETCH_ASSOC);
$result_cadre->closeCursor();

$requete_roues = "SELECT * FROM carac_taille_roues WHERE id = :id_taille_roues";
$result_roues = $conn->prepare($requete_roues);
$result_roues->bindValue(':id_taille_roues', $produit[0]['id_carac_taille_roues'], PDO::PARAM_INT);
$result_roues->execute();
$taille_roues = $result_roues->fetchALL(PDO::FETCH_ASSOC);
$result_roues->closeCursor();

$requete_couleur = "SELECT * FROM carac_couleur WHERE id = :id_carac_couleur";
$result_couleur = $conn->prepare($requete_couleur);
$result_couleur->bindValue(':id_carac_couleur', $produit[0]['id_carac_couleur'], PDO::PARAM_INT);
$result_couleur->execute();
$couleur = $result_couleur->fetchALL(PDO::FETCH_ASSOC);
$result_couleur->closeCursor();

$requete_categorie = "SELECT * FROM categorie WHERE id = :id_categorie";
$result_categorie = $conn->prepare($requete_categorie);
$result_categorie->bindValue(':id_categorie', $produit[0]['id_categorie'], PDO::PARAM_INT);
$result_categorie->execute();
$categorie = $result_categorie->fetchALL(PDO::FETCH_ASSOC);
$result_categorie->closeCursor();
