<?php

require_once ('connexion_bdd.php');

$sql = "SELECT SUM(quantite) FROM panier where id_compte_client = ".$_SESSION['identifiant'];

$result = $conn->prepare($sql);

$result->execute();

$qte_panier = $result->fetch(PDO::FETCH_ASSOC);
$qte_panier = $qte_panier['SUM(quantite)'];
$result->closeCursor();