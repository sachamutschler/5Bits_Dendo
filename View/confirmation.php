<?php
require_once ('Model/connexion_bdd.php');
$updateAccount = $conn->query('UPDATE compte_client SET etat = 1 WHERE code_validation = "' . $_GET['token'] . '" ');
echo "Votre compte a été validé";