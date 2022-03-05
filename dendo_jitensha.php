<?php
include('View/dendo_jitensha.php');




$requete_test = "SELECT * FROM produits";


if(isset($_GET)) {  // SI ON SAIT QU'IL Y A AU MOINS UNE CONDITION : ON AJOUTE LE WHERE
    $requete_test .= " WHERE ";
}

$premiere_condition = true;

if(isset($_GET['type_velo'])) {  // SI IL Y A LA CONDITION TYPE DE VELO (PAR EXEMPLE CASE VTT COCHEE)
    $type_velo = $_GET['type_velo'];
    if($premiere_condition == true) {
        $premiere_condition = false;
        $requete_test .= "type_velo = ".$type_velo;
    }
    else {
        $requete_test .= " AND type_velo = ".$type_velo;
    }
}

if(isset($_GET['genre'])) {  // SI IL Y A LA CONDITION GENRE (PAR EXEMPLE CASE HOMME COCHEE)
    $genre = $_GET['genre'];
    if($premiere_condition == true) {
        $premiere_condition = false;
        $requete_test .= "genre = ".$homme;
    }
    else {
        $requete_test .= " AND genre = ".$genre;
    }
}



/* --------- ON MET LA CONDITION DE TRI EN TOUT DERNIER CAR LES REQUETES SQL SONT DE TYPE : SELECT * FROM table WHERE condition = condition ORDER BY tri */

if(isset($_GET['tri'])) {  // SI IL Y A LA CONDITION GENRE (PAR EXEMPLE CASE HOMME COCHEE)
    $tri = $_GET['tri'];
    if($tri == 'ASC') {
        $requete_test .= " ORDER BY nom_produit ASC";
    }
    else {
        $requete_test .= " ORDER BY nom_produit DESC";
    }
}


// La normalement tu as une requête qui rassemble toutes tes conditons + ton tri croissant ou décroissant // pense à faire un echo($requete_test) pour voir à quoi elle ressemble