<?php
session_start();
?>


<head>
    <?php include ('head.php'); ?>
</head>
<div id="header">
    <?php include ('navbar.php'); ?>
    <link href="public/css/panier.css" rel="stylesheet">
</div>
<div class="cont_panier">
    <div class="cont_panier2">
        <?php
            include('Model/connexion_bdd.php');
            include('Model/model_panier.php');
            // for ($i=0; $i < intval($req_total['COUNT(id)']); $i++) { 
               // require('produit-panier.php');
            // }
            for($i=0; $i<count($tableau_id_produit); $i++) {
                ?>
                <div class="panier">
                    <img class="imagePanier" src="public/images/accueil/image_accueil_3.png" alt="produit_accueil_3">
                    <div class="text_panier">
                        <form action="panier.php" class="quantity" method="post">
                            <label for="title_panier" class="t_panier"><?php echo $tableau_produit[$i]['nom_produit']; ?></label>
                            <label class="t_panier">Quantité : <?php echo $tableau_id_produit[$i]['quantite']; ?> </label>
                            <?php if($tableau_produit[$i]['reduction_produit'] != 0) {
                                $prix = $tableau_produit[$i]['prix']  * (1 - ($tableau_produit[$i]['reduction_produit'] / 100) );
                            }
                            else {
                                $prix = $tableau_produit[$i]['prix'];
                            } ?>
                            <label class="t_panier">Prix : <?php echo $prix; ?></label>
                            <input type="submit" value="Supprimer" name="supprimer" class="delete_panier">

                        </form> 
                    </div>
                </div>
                <?php
            }
            $total= 0 + $prix*$i;
            
        ?>
    </div>
    
    <div class="total_buy">
        <div class="cont_total"> 
            <p class="txt_total">Le montant total est de : </br> <?php echo("$total"); ?> €</p>
        </div>
        <div class="cont_buy">
            <a href="https://buy.stripe.com/test_8wMdRba3LdAN5KUdQR"><input type="button" value="Paiement" name="livraison_panier" class="panier_livraison"></a>
        </div>
    </div>
</div>
<?php include ('footer.php'); ?>

