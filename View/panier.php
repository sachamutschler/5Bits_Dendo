<head>
    <?php include ('head.php'); ?>
</head>
<div id="header">
    <?php include ('navbar.php'); ?>
    <link href="public/css/panier.css" rel="stylesheet">
</div>
<div class="panier">
    <img class="imagePanier" src="public/images/accueil/image_accueil_3.png" alt="produit_accueil_3">
    <div class="text_panier">
    <form action="post" class="quantity">
        <label for="title_panier" class="t_panier">Nom du produit</label>
        <label class="t_panier">Quantité : </label>
        <label class="t_panier">Prix : </label>
        <input type="button" value="Supprimer" name="supprimer" class="delete_panier">
        <a href="https://buy.stripe.com/test_8wMdRba3LdAN5KUdQR"><input type="button" value="Paiement" name="livraison_panier" class="panier_livraison"></a>

    </form> 
    </div>
</div>
<?php include ('footer.php'); ?>

