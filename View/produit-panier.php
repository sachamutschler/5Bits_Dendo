
<?php
    $total = 0;
    

  
    
?>

<div class="panier">
    <img class="imagePanier" src="public/images/accueil/image_accueil_3.png" alt="produit_accueil_3">
    <div class="text_panier">
        <form action="panier.php" class="quantity" method="post">
            <label for="title_panier" class="t_panier"><?php echo $req_nom['nom_produit']; ?></label>
            <label class="t_panier">Quantité : <?php echo $res_quantite['quantite']; ?> </label>
            <label class="t_panier">Prix : <?php echo $res['prix']; ?></label>
            <input type="submit" value="Supprimer" name="supprimer" class="delete_panier">

        </form> 
    </div>
</div>