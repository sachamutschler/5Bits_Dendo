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

html:5

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
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
                                    $requeteC = $db->query("select id, nom FROM categorie");
                                    $requeteC = $requeteC->fetchAll();
                                    echo '<tr>
                                            <form method="get">
                                               <button type="submit" value="%" name="categorie">Tout</button>
                                            </form>
                                           </tr>';
                                    foreach ($requeteC as $itemC){
                                        echo'<tr>
                                                <form method="get">
                                                    <button type="submit" value="'.$itemC['id'].'" name="categorie">'.$itemC['nom'].'</button>
                                                </form>
                                             </tr>';
                                    }
                                    ?>
                            </table>
                            <table>
                                <?php $db = connexionBase('dendo');
                                $requeteT = $db->query("select id, nom FROM taxonomie");
                                $requeteT = $requeteT->fetchAll();
                                echo '<tr>
                                            <form method="get">
                                               <button type="submit" value="%" name="taxonomie">Tout</button>
                                            </form>
                                           </tr>';
                                foreach ($requeteT as $itemT){
                                    echo'<tr>
                                                <form method="get">
                                                    <button type="submit" value="'.$itemT['id'].'" name="taxonomie">'.$itemT['nom'].'</button>
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
                                        $categorie = "%";
                                    }
                                    $requete1 = $db->prepare("select * FROM produit p
                                                                INNER JOIN categorie c on p.id_categorie = c.id
                                                                INNER JOIN carac_couleur cc on p.id_carac_couleur = cc.id
                                                                INNER JOIN carac_matiere_cadre cmc on p.id_carac_matiere_cadre = cmc.id
                                                                INNER JOIN carac_taille_cadre ctc on p.id_carac_taille_cadre = ctc.id
                                                                INNER JOIN carac_taille_roues ctr on p.id_carac_taille_roues = ctr.id
                                                                WHERE p.id_categorie LIKE :categorie");
                                    $requete1->bindValue('categorie', $categorie);
                                    $requete1->execute();
                                    $requete1 = $requete1->fetchAll();
                                    foreach ($requete1 as $item1){
                                        echo'<div class="article_produits">
                                            <div class="article_container">';
                                        ?>
                                                <img class="image" src="<?= $item1['image']; ?>" alt="image_produit_1">
                                                <h3><?= $item1['nom']; ?></h3>
                                                <h4><?php if($item1['reduction'] != 0){
                                                            $prixSpecial = $item1['prix']/100*(100-$item1['reduction']);
                                                            echo $prixSpecial.'€ <strike>'.$item1['prix'].'€</strike>';
                                                        }else{
                                                            echo $item1['prix'].'€';
                                                        }?>
                                                </h4>
                                                <p><? = $item1['reduction'] ?></p>
                                            </div>
                                            <a class="bouton_produit" href="#">EN SAVOIR PLUS</a>
                                        </div>
                                    <?php }?>

                                <?php if (isset($_GET['taxonomie']) !=0){
                                    $taxonomie  = $_GET['taxonomie'];
                                } else {
                                    $taxonomie = "%";
                                }
                                $requete2 = $db->prepare("select * FROM produit p
                                                                        INNER JOIN taxonomie_produit tp on p.id = tp.id_produit
                                                                        INNER JOIN taxonomie t on tp.id_taxonomie = t.id
                                                                        WHERE tp.id_taxonomie LIKE :taxonomie");
                                $requete2->bindValue('taxonomie', $taxonomie);
                                $requete2->execute();
                                $requete2 = $requete2->fetchAll();
                                foreach ($requete2 as $item2){
                                echo'<div class="article_produits">
                                                    <div class="article_container">';
                                ?>
                                <img class="image" src="<?= $item2['image']; ?>" alt="image_produit_1">
                                <h3><?= $item2['designation']; ?></h3>
                                <h4><?php if($item2['reduction'] != 0){
                                        $prixSpecial = $item2['prix']/100*(100-$item2['reduction']);
                                        echo $prixSpecial.'€ <strike>'.$item2['prix'].'€</strike>';
                                    }else{
                                        echo $item2['prix'].'€';
                                    }?>
                        </h4>
                    </div>
            <a class="bouton_produit" href="#">EN SAVOIR PLUS</a>
        </div>
        <?php }?>
                            </div>
                        </div>
                    </div>
        </div>
    </body>
</html>