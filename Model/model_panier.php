<?php 

    //requete prix vélo
    $requete = 'SELECT prix FROM `produit`WHERE id_produit = 4';
    $prix = $conn->query($requete);
    $prix->execute();
    $prix->setFetchMode(PDO::FETCH_CLASS, 'prix');
    $res = $prix->fetch();

    //Requète quantité de vélo 
    $req_quantite = 'SELECT quantite FROM `panier`';
    $quantite = $conn->query($req_quantite);
    $quantite->execute();
    $quantite->setFetchMode(PDO::FETCH_CLASS, 'quantite');
    $res_quantite = $quantite->fetch();

    //Requète Nom du vélo
    $req_nom = 'SELECT nom_produit FROM `produit` WHERE id_produit = 4';
    $nom_velo = $conn->query($req_nom);
    $nom_velo->execute();
    $nom_velo->setFetchMode(PDO::FETCH_CLASS, 'nom_produit');
    $req_nom = $nom_velo->fetch();

    //Requète quantité totale 
    $req_total = 'SELECT COUNT(id) FROM `panier` WHERE id_compte_client = 1';
    $total = $conn->query($req_total);
    $total->execute();
    $total->setFetchMode(PDO::FETCH_CLASS, 'COUNT(id)');
    $req_total = $total->fetch();
?>