<?php
if (isset($_POST['deconnexion'])){
    session_destroy();
    header("Refresh:0");
}
?>

<img id="icone_menu" onclick="afficher_navbar()" src="public/images/icone_menu.png" alt="menu">
<div id="navbar">
    <a class="navbar_link" href="index.php">Accueil</a>
    <a class="navbar_link" href="produits.php">Produits</a>
    <a class="navbar_link" href="contact.php">Contact</a>
    <a class="navbar_link" href="#">Qui sommes nous ?</a>
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