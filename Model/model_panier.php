<?php 

    //requete prix vélo
    $requete = 'SELECT prix FROM `produit` WHERE id = 1';
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
?>