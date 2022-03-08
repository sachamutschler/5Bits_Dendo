<?php
session_start();


if(isset($_POST['qte_ajout_panier'])) {
    include('Model/connexion_ajout_produit_au_panier.php');
}
?>
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
            <img src="public/images/produits/<?php echo($produit[0]['image']) ?>.png">

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
                <p class="caracteristiques_element">Stock : <?php echo($produit[0]['stock']) ?></p>
                <br>
                <p class="caracteristiques_element">Ce vélo <?php echo($categorie[0]['nom_categorie']) ?> <?php echo($produit[0]['nom_produit']) ?>  est au prix de <?php if($produit[0]['reduction_produit'] != 0) { echo($prix_apres .'€ au lieu de '.$prix_avant);  }else{ echo($produit[0]['prix']); } ?> € seulement !</p>
                <br>
                <p class="caracteristiques_element">Conceptualisé par nos soins, produit et assemblé par des partenaires de confiance, ce vélo est le fruit de dizaines d'années d'expérience dans le domaine du cyclisme.</p>
                <br>
                <?php
                if(isset($_SESSION['identifiant'])) {
                    ?>
                    <form id="form_ajout_panier" method="POST">
                        <input type="number" id="qte_ajout_panier" max="<?php echo($produit[0]['stock']); ?>" value="1" name="qte_ajout_panier">
                        <input type="hidden" id="id_produit_ajout_panier" name="id_produit_ajout_panier" value="<?php echo($produit[0]['id_produit']); ?>">
                        <input type="hidden" id="id_utilisateur_ajout_panier" name="id_utilisateur_ajout_panier" value="<?php echo($_SESSION['identifiant']); ?>">
                        <button type="submit" id="bouton_ajout_panier" class="bouton">Ajouter au panier</button>
                    </form>
                    <?php
                }
                else {
                    ?>
                    <form id="form_connexion" method="POST" action="connexion.php">
                        <input type="hidden" value="<?php echo($produit[0]['id_produit']); ?>" name="id_produit_connexion">
                        <p class="caracteristiques_element">Connectez vous pour ajouter cet article au panier</p>
                        <button type="submit" id="bouton_connexion" class="bouton">Connexion</button>
                    </form>
                    <?php
                }
                ?>

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
<?php include ('public/js/produit.php');
