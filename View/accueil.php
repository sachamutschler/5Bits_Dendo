<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include ('head.php'); ?>
    <link href="public/css/accueil.css" rel="stylesheet">

</head>
<body>

<div id="header">
    <?php include ('navbar.php'); ?>
</div>

<div class="contenu">
    <h1 class="titre_page">Dendo Jitensha</h1>

    <div id="presentation">
        <div id="texte_presentation">
            <p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>
            <a href="#" class="bouton">En savoir plus</a>
        </div>
        <img src="public/images/accueil/accueil_1.jpg" alt="accueil_1">
    </div>

    <?php include ('Model/connexion_articles_accueil.php');

    if(isset($produits_accueil)) { ?>
    <h1 class="titre_page">Produits</h1>
        <div id="articles_accueil">
        <?php for($i=0; $i<count($produits_accueil); $i++) {
            if($produits_accueil[$i]['accueil'] == 1) {
               ?>
                <div class="article_accueil">
                    <div class="article_container">
                        <img class="image" src="public/images/produits/<?php echo($produits_accueil[$i]['image']) ?>" alt="produit_accueil_1">
                        <h3><?php echo($produits_accueil[$i]['nom_produit']) ?></h3>
                        <?php if($produits_accueil[$i]['reduction_produit'] != 0) {
                            ?><h4><?php echo($produits_accueil[$i]['prix']  * (1 - ($produits_accueil[$i]['reduction'] / 100) )) ?> € <strike><?php echo($produits_accueil[$i]['prix']) ?> €</strike></h4><?php
                        }
                        else {
                            ?><h4><?php echo($produits_accueil[$i]['prix']) ?> €</h4><?php
                        }
                        ?>
                        <p><?php echo($produits_accueil[$i]['designation']) ?></p>
                    </div>
                    <a target="_blank" class="bouton_produit_accueil" href="produit.php?id_produit=<?php echo($produits_accueil[$i]['id']) ?>">Page produit</a>
                </div>
            <?php
            }
        } ?>
        </div>
   <?php } ?>



    <div id="icones_accueil">
        <div class="icones_accueil_liste">
            <div class="une_icone">
                <img src="public/images/accueil/icone_velo.png" alt="icone_velo">
                <p>Des vélos de qualité artisanale</p>
            </div>
            <div class="une_icone">
                <img src="public/images/accueil/icone_outils.png" alt="icone_velo">
                <p>Un atelier de réparation dernier cri</p>
            </div>
            <div class="une_icone">
                <img src="public/images/accueil/icone_service.png" alt="icone_velo">
                <p>Un problème ? Contactez nous !</p>
            </div>
        </div>

        <div class="icones_accueil_liste">
            <div class="une_icone">
                <p>Une démarche écologique</p>
                <img src="public/images/accueil/icone_nature.png" alt="icone_velo">
            </div>
            <div class="une_icone">
                <p>Des vélos sur mesure !</p>
                <img src="public/images/accueil/icone_metre.png" alt="icone_velo">
            </div>
            <div class="une_icone">
                <p>Optimisés pour les performances</p>
                <img src="public/images/accueil/icone_performance.png" alt="icone_velo">
            </div>
        </div>
    </div>

</div>

<?php include ('footer.php'); ?>

<?php include ('public/js/navbar.php'); ?>
</body>

</html>
