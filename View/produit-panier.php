<?php

    $servername = "localhost";
    $username = "root";
    $compteur_velo = 0;
    try
    {
        $db = new PDO("mysql:host=$servername;dbname=dendo",$username,'');
        $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e)
    {
        echo "Erreur de la connexion : " .$e->getMessage();
        die();
    }
    
    $total = 0;
    $requete = 'SELECT prix FROM `produit` WHERE id = 1';
    $prix = $db->query($requete);
    $prix->execute();
    $prix->setFetchMode(PDO::FETCH_CLASS, 'prix');
    $res = $prix->fetch();

    if (isset($_POST['supprimer'])) {
        $compteur_velo -= 1;
    }
    
?>

<div class="panier">
    <img class="imagePanier" src="public/images/accueil/image_accueil_3.png" alt="produit_accueil_3">
    <div class="text_panier">
        <form action="panier.php" class="quantity" method="post">
            <label for="title_panier" class="t_panier">Nom du produit</label>
            <label class="t_panier">Quantité : </label>
            <label class="t_panier">Prix : <?php echo $res['prix']; ?></label>
            <input type="submit" value="Supprimer" name="supprimer" class="delete_panier">

        </form> 
    </div>
</div>