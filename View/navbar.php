<?php
if (isset($_POST['deconnexion'])){
    session_destroy();
    header("Refresh:0");
}
?>

<img id="icone_menu" onclick="afficher_navbar()" src="public/images/icone_menu.png" alt="menu">
<img id="icone_dendo" alt="icone_dendo" src="public/images/logo.png" onclick="location='index.php'">
<div id="navbar">
    <a class="navbar_link" href="index.php">Accueil</a>
    <a class="navbar_link" href="produits.php">Produits</a>
    <a class="navbar_link" href="contact.php">Contact</a>
    <a class="navbar_link" href="dendo_jitensha.php">Qui sommes nous ?</a>
    <?php
    if (isset($_SESSION['identifiant'])){
    ?>
    <a class="navbar_link" href="moncompte.php">Mon compte</a>
    <?php
    }
    if (!isset($_SESSION['identifiant'])){
        ?>
    <a class="navbar_link" href="connexion.php">Se connecter</a>
    <?php
    }
    if (isset($_SESSION['identifiant'])){
        ?>
        <a class="navbar_link" href="deconnexion.php">Deconnexion</a>
    <?php
    }
    ?>

</div>
<div id="div_panier" onclick="location.href = 'panier.php'">
    <?php if(isset($_SESSION['identifiant'])) {
        require_once ('Model/connexion_panier_navbar.php');
        ?><img src="public/images/icone_panier.png" id="icone_panier"><?php
        if($qte_panier != null) {
            ?><p id="quantite_panier"><?php echo($qte_panier) ?></p><?php
        }
    }
    ?>
</div>
