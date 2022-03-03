<head>
    <?php include ('head.php'); ?>
</head>
<div id="header">
    <?php include ('navbar.php'); ?>
    <link href="public/css/panier.css" rel="stylesheet">
</div>
<div class="cont_panier">
    <?php

        for ($i=0; $i < 3; $i++) { 
            require('produit-panier.php');
        }

    ?>
    <div class="cont_buy">
        <a href="https://buy.stripe.com/test_8wMdRba3LdAN5KUdQR"><input type="button" value="Paiement" name="livraison_panier" class="panier_livraison"></a>
    </div>
</div>
<?php include ('footer.php'); ?>

