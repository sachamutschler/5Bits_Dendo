<?php
session_start();
?>
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
            <p>JITENSHA signifie vélo en japonais. Le vélo est profondément ancré dans la culture et le style de vie à Tokyo. On y croise toutes sortes de vélos, et des gens d’horizons très différents qui tous, font du vélo. Le vélo est le moyen idéal pour vivre Tokyo.<br>

                <br>L’art de vivre japonais a inspiré à JITENSHA la recherche d’essentiel, de pureté, et d’élégance. Une approche minimaliste, qui peut produire des looks pointus, voire extrêmes, comme les jouent les adolescentes de Shibuya ou les bikers tokyoïtes.<br>

                <br>Ce clin d’oeil au Japon a guidé tous les choix de JITENSHA, des couleurs de cadres au design des embouts de guidon. L’envie de partager sa vie entre Tokyo, Paris et toutes les cities, la croyance que le vélo est et sera de plus en plus une belle solution de mobilité urbaine, l’engagement pour un environnement durable, à travers des entreprises plus petites et responsables.

                <br><br>Voila l'esprit et l'énergie JITENSHA !</p>
            <a href="dendo_jitensha.php" class="bouton">En savoir plus</a>
        </div>
        <img src="public/images/accueil/accueil_1.jpg" alt="accueil_1">
    </div>
<!-- Une section qui affiche les éléments choisis en base de donnée qui ont pour valeur 1 dans le champ accueil-->
    <?php include ('Model/connexion_articles_accueil.php');

    if(isset($produits_accueil)) { ?>
    <h1 class="titre_page">Produits</h1>
        <div id="articles_accueil">
        <?php for($i=0; $i<count($produits_accueil); $i++) {
            if($produits_accueil[$i]['accueil'] == 1) {
               ?>
                <div class="article_accueil">
                    <div class="article_container">
                        <img class="image" src="public/images/produits/<?php echo($produits_accueil[$i]['image']) ?>.png" alt="produit_accueil_1">
                        <h3><?php echo($produits_accueil[$i]['nom_produit']) ?></h3>
                        <?php if($produits_accueil[$i]['reduction_produit'] != 0) {
                            ?><h4><?php echo($produits_accueil[$i]['prix']  * (1 - ($produits_accueil[$i]['reduction_produit'] / 100) )) ?> € <s><?php echo($produits_accueil[$i]['prix']) ?> €</s></h4><?php
                        }
                        else {
                            ?><h4><?php echo($produits_accueil[$i]['prix']) ?> €</h4><?php
                        }
                        ?>
                        <p><?php echo($produits_accueil[$i]['designation']) ?></p>
                    </div>
                    <a class="bouton_produit_accueil" href="produit.php?id_produit=<?php echo($produits_accueil[$i]['id_produit']) ?>">Détails</a>
                </div>
            <?php
            }
        } ?>
        </div>
   <?php } ?>



    <div id="icones_accueil">
        <div class="icones_accueil_liste">
            <div class="une_icone">
                <a href="produits.php"><span class="iconify" data-icon="gis:bicycle"></span> Des vélos de qualité artisanale</a>
            </div>
            <div class="une_icone">
                <a href="#"><span class="iconify" data-icon="ri:tools-fill"></span> Un atelier de réparation dernier cri</a>
            </div>
            <div class="une_icone">
                <a href="contact.php"><span class="iconify" data-icon="bi:headset"></span> Un problème ? Contactez nous !</a>
            </div>
        </div>

        <div class="icones_accueil_liste">
            <div class="une_icone">
                <a href="#"><span class="iconify" data-icon="bx:leaf"></span> Une démarche écologique</a>
            </div>
            <div class="une_icone">
                <a href="produits.php"><span class="iconify" data-icon="gis:measure"></span> Des vélos sur mesure</a>
            </div>
            <div class="une_icone">
                <a href="produits.php"><span class="iconify" data-icon="eos-icons:performance"></span> Optimisés pour les performances!</a>
            </div>
        </div>
    </div>
    <!-- Une section promotion qui affiche les articles dès 20% de réduction-->
    <?php include ('Model/connexion_articles_promo.php');
    if(isset($reduction_produit)) { ?>
        <h1 class="titre_page">Offres promotionnelles du moment:</h1>
        <div id="articles_accueil">
            <?php for($i=0; $i<4; $i++) {
                if($reduction_produit[$i]['reduction_produit'] >= 20) {
                    ?>
                    <div class="article_accueil">
                        <div class="article_container">
                            <img class="image" src="public/images/produits/<?php echo($reduction_produit[$i]['image']) ?>.png" alt="produit_accueil_1">
                            <h3><?php echo($reduction_produit[$i]['nom_produit']) ?></h3>
                            <?php if($reduction_produit[$i]['reduction_produit'] != 0) {
                                ?><h4><?php echo($reduction_produit[$i]['prix']  * (1 - ($reduction_produit[$i]['reduction_produit'] / 100) )) ?> € <s><?php echo($reduction_produit[$i]['prix']) ?> €</s></h4><?php
                            }
                            else {
                                ?><h4><?php echo($reduction_produit[$i]['prix']) ?> €</h4><?php
                            }
                            ?>
                            <p><?php echo($reduction_produit[$i]['designation']) ?></p>
                        </div>
                        <a class="bouton_produit_accueil" href="produit.php?id_produit=<?php echo($reduction_produit[$i]['id_produit']) ?>">Détails</a>
                    </div>
                    <?php
                }
            } ?>
        </div>
    <?php }
    include ('footer.php'); ?>
</div>



<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
</body>

</html>
