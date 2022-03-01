<?php
function connexionBase($nomBase)
{
    $servername="localhost";
    $username="root";
    $password="";
    try {
        $db = new PDO("mysql:host=$servername;dbname=$nomBase", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Error of connection: " .$e->getMessage();
        die();
    }
    return $db;
}
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include ('head.php'); ?>
    </head>
    <body>
        <div id="header">
            <link href="public/css/produits.css" rel="stylesheet">
            <?php include ('navbar.php'); ?>
        </div>
        <div class="contenu">
            <h1 class="titre_page">Nos produits</h1>
                <input class=recherche type=text name="recherche" placeholder="Recherche..."><label for="recherche"></label>
                    <div class="colonnes_container">
                        <div class="colonne_gauche">
                            <!-- Boutons de tri + requêtage -->
                            <table>
                                <?php $db = connexionBase('dendo');
                                    $requete = $db->query("select idCategorie, nom FROM categorie");
                                    $requete = $requete->fetchAll();
                                    echo '<tr>
                                            <form method="get">
                                               <button type="submit" value="%" name="categorie">Tout</button>
                                            </form>
                                           </tr>';
                                    foreach ($requete as $item){
                                        echo'<tr>
                                                <form method="get">
                                                    <button type="submit" value="'.$item['idCategorie'].'" name="categorie">'.$item['nom'].'</button>
                                                </form>
                                             </tr>';
                                    }
                                    ?>
                            </table>

                        </div>
                        <div class="colonne_droite">
                            <div id="articles_produits">
                                <?php if (isset($_GET['categorie']) !=0){
                                        $categorie  = $_GET['categorie'];
                                    } else {
                                        $categorie = "%";}
                                    $requete2 = $db->prepare("select * FROM produit p
                                                                INNER JOIN taxonomie_produit tp on p.idProduit = tp.idProduit
                                                                INNER JOIN taxonomie t on tp.idTaxonomie = t.idTaxonomie
                                                                INNER JOIN categorie c on p.idCategorie = c.idCategorie
                                                                WHERE p.idCategorie LIKE :categorie");
                                    $requete2->bindValue('categorie', $categorie);
                                    $requete2->execute();
                                    $requete2 = $requete2->fetchAll();
                                    foreach ($requete2 as $item2){
                                        $prixSpecial=$item2['prix']-50;
                                        ?>
                                        <div class="article_produits">
                                            <div class="article_container">
                                                <img class="image" src="<?= $item2['image']; ?>" alt="image_produit_1">
                                                <h3><?= $item2['designation']; ?></h3>
                                                <h4><?= $prixSpecial ?>€ <strike><?= $item2['prix'] ?>€</strike></h4>
                                                <p>Ce vélo <?php if ($item2['electrique']){echo ' électrique ';} echo"possède le dernier type de suspension ".$item2['type_suspension']." ainsi qu'un système de freinage ".$item2['type_frein'].". Le cadre en ".$item2['matiere_cadre']." est particulièrement indiqué pour vos sorties".$item2['nom'];?></p>

                                            </div>
                                            <a class="bouton_produit" href="#">Yatama</a>
                                        </div>
                                    <?php }?>

                            </div>
                        </div>
                    </div>
        </div>
    </body>
</html>