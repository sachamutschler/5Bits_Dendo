<?php
if (isset($_POST['deconnexion'])){
    session_destroy();
}else{
    session_start();
}


?>
<img id="icone_menu" onclick="afficher_navbar()" src="public/images/icone_menu.png" alt="menu">
<div id="navbar">
    <a class="navbar_link" href="index.php">Accueil</a>
    <a class="navbar_link" href="produits.php">Produits</a>
    <a class="navbar_link" href="contact.php">Contact</a>
    <a class="navbar_link" href="#">Qui sommes nous ?</a>
    <?php
    if ($_SESSION['identifiant']){
    ?>
    <a class="navbar_link" href="moncompte.php">Mon compte</a>
    <?php
    }
    if ($_SESSION['identifiant']){
        ?>
    <a class="navbar_link" href="connexion.php">Se connecter</a>
    <?php
    }
    if ($_SESSION['identifiant']){
        ?>
        <form action="index.php" method="post">
            <input type="submit" name="deconnexion" value="Deconnexion">
        </form>
    <?php
    }
    ?>

</div>