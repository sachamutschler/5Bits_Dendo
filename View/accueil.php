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
                            ?><h4><?php echo($produits_accueil[$i]['prix']  * (1 - ($produits_accueil[$i]['reduction_produit'] / 100) )) ?> € <strike><?php echo($produits_accueil[$i]['prix']) ?> €</strike></h4><?php
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

</body>

</html>
