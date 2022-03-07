<?php
session_start();
?>
<head>
    <?php include ('head.php'); ?>
</head>
<div id="header">
    <?php include ('navbar.php'); ?>
    <link href="public/css/produit.css" rel="stylesheet">
</div>gi

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
                <h2 id="nom_produit" class="caracteristiques_element"><?php echo($produit[0]['nom_produit']) ?></h2>
                <h2 id="prix" class="caracteristiques_element">
                <?php
                if($produit[0]['reduction_produit'] != 0) {
                    $prix_avant = $produit[0]['prix'];
                    $prix_apres = $prix_avant * (1 - ($produit[0]['reduction_produit'] / 100) );
                    ?>

                    <strike id="prix_avant"><?php echo($prix_avant) ?></strike>
                    <span id="prix_apres"><?php echo($prix_apres) ?></span><?php
                }
                else {
                    ?><span id="prix_apres"><?php echo($produit[0]['prix']) ?></span> <?php
                }
                ?> €</h2>
                <p class="caracteristiques_element">Poids : <?php echo($produit[0]['poids']) ?> kg</p>
                <p class="caracteristiques_element">Taille de cadre : <?php echo($taille_cadre[0]['taille_cadre']) ?></p>
                <p class="caracteristiques_element">Taille des roues : <?php echo($taille_roues[0]['taille_roues']) ?> kg</p>
                <p class="caracteristiques_element">Couleur : <?php echo($couleur[0]['couleur']) ?></p>
                <br>
                <p class="caracteristiques_element">Ce vélo <?php echo($categorie[0]['nom_categorie']) ?> <?php echo($produit[0]['nom_produit']) ?> de couleur <?php echo($couleur[0]['couleur']) ?> est au prix de <?php if($produit[0]['reduction_produit'] != 0) { echo($prix_apres .'€ au lieu de '.$prix_avant);  }else{ echo($produit[0]['prix']); } ?> €</p>
                <br>
                <p class="caracteristiques_element">Conceptualisé par nos soins, produit et assemblé par des partenaires de confiance, ce vélo est le fruit de dizaines d'années d'expérience dans le domaine du cyclisme.</p>
                <button type="button" id="bouton_ajout_au_panier" class="bouton">Ajouter au panier</button>
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
