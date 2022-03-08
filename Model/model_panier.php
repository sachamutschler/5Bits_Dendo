<?php 
    
    //requete prix vélo
    $id_compte_client = intval($_SESSION['identifiant']);
    
    $id_produit = "SELECT * FROM panier WHERE id_compte_client = $id_compte_client";
    $req_id_produit = $conn->query($id_produit);
    $req_id_produit->execute();
    $req_id_produit->setFetchMode(PDO::FETCH_CLASS, 'id_produit');
    $tableau_id_produit = $req_id_produit->FetchAll(PDO::FETCH_ASSOC);
    /* var_dump($tableau_id_produit); */
    if(count($tableau_id_produit) !== 0) {
       

        $requete = "SELECT * FROM produit WHERE id_produit IN (";
        for($i=0; $i < count($tableau_id_produit); $i++) {
            if($i == count($tableau_id_produit) - 1) {
                $requete.= $tableau_id_produit[$i]['id_produit'] . ')';
            }
            else {
                $requete.= $tableau_id_produit[$i]['id_produit'] . ', ';
            }
        }

        $produit = $conn->query($requete);
        $produit->execute();
        
        $tableau_produit = $produit->fetchAll(PDO::FETCH_ASSOC);
        /* var_dump($tableau_produit); */
        //Requète quantité de vélo 
        /* $req_quantite = "SELECT quantite FROM `panier` WHERE id_compte_client = $id_compte_client";
        $quantite = $conn->query($req_quantite);
        $quantite->execute();
        $quantite->setFetchMode(PDO::FETCH_CLASS, 'quantite');
        $res_quantite = $quantite->fetch(); */

        //Requète quantité totale 
        /* $req_total = "SELECT COUNT(id) FROM `panier` WHERE id_compte_client = $id_compte_client";
        $total = $conn->query($req_total);
        $total->execute();
        $total->setFetchMode(PDO::FETCH_CLASS, 'COUNT(id)');
        $req_total = $total->fetch(); */
        //$delete_ligne_panier = "";

    
}
else {
    echo ("<div><h2>Votre panier est vide</h2></div>");
}

?>