<?php

require_once ('Model/connexion_bdd.php');



$sql = "SELECT * FROM produit WHERE accueil = 1";

$result = $conn->prepare($sql);

$result->execute();

$produits_accueil = $result->fetchAll(PDO::FETCH_ASSOC);
$result->closeCursor();