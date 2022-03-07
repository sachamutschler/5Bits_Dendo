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
            for ($i=0; $i < intval($req_total['COUNT(id)']); $i++) { 
                require('produit-panier.php');
            }
            $total= 0 + intval($res['prix']*$i);
            
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

