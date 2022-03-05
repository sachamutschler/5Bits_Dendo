<head>
    <?php include ('head.php'); ?>
</head>
<div id="header">
    <?php include ('navbar.php'); ?>
    <link href="public/css/produit.css" rel="stylesheet">
</div>

<?php

if(isset($_GET['id_produit'])) {
    $id_produit = $_GET['id_produit'];

    require_once ('Model/connexion_article_par_id.php');

    ?>

    <div class="contenu">
        <h1 class="titre_page"><?php echo($produit[0]['designation']) ?></h1>

        <div class="div_produit">
            <img src="public/images/produits/<?php echo($produit[0]['image']) ?>">

            <div id="caracteristiques">
                <h2 id="prix" class="caracteristiques_element">
                <?php
                if($produit[0]['reduction'] != 0) {
                    $prix_avant = $produit[0]['prix'];
                    $prix_apres = $prix_avant * (1 - ($produit[0]['reduction'] / 100) );
                    ?>

                    <strike id="prix_avant"><?php echo($prix_avant) ?></strike>
                    <span id="prix_apres"><?php echo($prix_apres) ?></span><?php
                }
                else {
                    ?><span id="prix_apres"><?php echo($produit[0]['prix']) ?></span> <?php
                }
                ?> €</h2>
                <p class="caracteristiques_element">Poids : <?php echo($produit[0]['poids']) ?> kg</p>

            </div>
        </div>
    <?php

//    var_dump($produit);

    ?>

    </div>

    <?php
}


?>


<?php include ('footer.php'); ?>
