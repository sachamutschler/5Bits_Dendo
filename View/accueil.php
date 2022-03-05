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

    <h1 class="titre_page">Produits</h1>
    <div id="articles_accueil">
        <div class="article_accueil">
            <div class="article_container">
                <img class="image" src="public/images/accueil/image_accueil_1.png" alt="produit_accueil_1">
                <h3>Produit 1</h3>
                <h4>1099 € <strike>1299€</strike></h4>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
            </div>
            <a class="bouton_produit_accueil" href="#">Produit 1</a>
        </div>
        <div class="article_accueil">
            <div class="article_container">
                <img class="image" src="public/images/accueil/image_accueil_2.png" alt="produit_accueil_2">
                <h3>Produit 3</h3>
                <h4>799 € <strike>999€</strike></h4>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
            </div>
            <a class="bouton_produit_accueil" href="#">Produit 2</a>
        </div>
        <div class="article_accueil">
            <div class="article_container">
                <img class="image" src="public/images/accueil/image_accueil_3.png" alt="produit_accueil_3">
                <h3>Produit 3</h3>
                <h4>1599 € <strike>1799€</strike></h4>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
            </div>
            <a class="bouton_produit_accueil" href="#">Produit 3</a>
        </div>
        <div class="article_accueil">
            <div class="article_container">
                <img class="image" src="public/images/accueil/image_accueil_4.png" alt="produit_accueil_4">
                <h3>Produit 4</h3>
                <h4>999 € <strike>1199€</strike></h4>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
            </div>
            <a class="bouton_produit_accueil" href="#">Produit 4</a>
        </div>
    </div>

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
