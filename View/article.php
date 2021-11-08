<head>
    <?php include ('head.php'); ?>
</head>
<div id="header">
    <?php include ('navbar.php'); ?>
    <link href="public/css/article.css" rel="stylesheet">
</div>
<div class="panier">
    <img class="imagePanier" src="public/images/accueil/image_accueil_3.png" alt="produit_accueil_3">
    <div class="text_panier">
    <form action="post" class="quantity">
        <label for="title_panier" class="t_panier">Nom du produit</label>
        <label class="t_panier">Quantité : </label>
        <label class="t_panier">Prix : </label>
        <input type="button" value="Supprimer" name="supprimer" class="delete_panier">
        <input type="button" value="Choisir ma livraison" name="livraison_panier" class="panier_livraison">

    </form> 
    </div>
</div>
<?php include ('footer.php'); ?>
