<?php

require_once ('Model/connexion_bdd.php');



$sql = "SELECT * FROM produit WHERE reduction_produit >= 20.00";

$result = $conn->prepare($sql);

$result->execute();

$reduction_produit = $result->fetchAll(PDO::FETCH_ASSOC);
$result->closeCursor();