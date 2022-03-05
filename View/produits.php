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
                                 <?php $db = connexionBase('dendo2');
                                    #Récupération des noms dans les tables pour créer les listes déroulantes
                                    $listeCategories = $db->query("select id, nom_categorie FROM categorie");
                                    $listeCategories = $listeCategories->fetchAll();
                                    $listeCouleurs = $db->query("select id, couleur FROM carac_couleur");
                                    $listeCouleurs = $listeCouleurs->fetchAll();
                                    $listeTaxonomies = $db->query("select id, nom_taxonomie FROM taxonomie");
                                    $listeTaxonomies = $listeTaxonomies->fetchAll();
                                    ?>
                                <tr>
                                    <!-- Formulaire de tri -->
                                    <form method="get">
                                        <label for="categorie">Type vélo:</label>
                                        <select name="categorie" id="categorie">
                                            <option value="">--- Choisir un type de vélo ---</option>
                                            <option type="submit" value="%" name="categorie">Tout</option>
                                            <?php foreach ($listeCategories as $itemCategorie){
                                                echo '<option type="submit" value="'.$itemCategorie['id'].'" name="'.$itemCategorie['nom_categorie'].'">'.$itemCategorie['nom_categorie'].'</option>';
                                            }?>
                                        </select>
                                        <label for="couleur">Couleur vélo:</label>
                                        <select name="couleur" id="couleur">
                                            <option value="">--- Choisir une couleur ---</option>
                                            <option type="submit" value="%" name="couleur">Tout</option>
                                            <?php foreach ($listeCouleurs as $itemCouleur){
                                                echo '<option type="submit" value="'.$itemCouleur['id'].'" name="'.$itemCouleur['couleur'].'">'.$itemCouleur['couleur'].'</option>';
                                            }?>
                                        </select>
                                        <label for="taxonomie">Genre:</label>
                                        <select name="taxonomie" id="taxonomie">
                                            <option value="">--- Choisir genre ---</option>
                                            <option type="submit" value="%" name="taxonomie">Tout</option>
                                            <?php foreach ($listeTaxonomies as $itemTaxonomie){
                                                echo '<option type="submit" value="'.$itemTaxonomie['id'].'" name="'.$itemTaxonomie['nom_taxonomie'].'">'.$itemTaxonomie['nom_taxonomie'].'</option>';
                                            }?>
                                        </select>
                                        <button type="submit">Lancer la recherche</button>
                                    </form>

                                <?php $db = connexionBase('dendo2');
                                    $requeteC = $db->query("select id, nom_categorie FROM categorie");
                                    $requeteC = $requeteC->fetchAll();
                                    echo '<tr>
                                            <form method="get">
                                               <button type="submit" value="%" name="categorie">Tout</button>
                                            </form>
                                           </tr>';
                                    foreach ($requeteC as $itemC){
                                        echo'<tr>
                                                <form method="get">
                                                    <button type="submit" value="'.$itemC['id'].'" name="categorie">'.$itemC['nom_categorie'].'</button>
                                                </form>
                                             </tr>';
                                    }
                                    ?>
                            </table>
                            <table>
                                <?php $db = connexionBase('dendo2');
                                $requeteT = $db->query("select id, nom_taxonomie FROM taxonomie");
                                $requeteT = $requeteT->fetchAll();
                                echo '<tr>
                                            <form method="get">
                                               <button type="submit" value="%" name="taxonomie">Tout</button>
                                            </form>
                                           </tr>';
                                foreach ($requeteT as $itemT){
                                    echo'<tr>
                                                <form method="get">
                                                    <button type="submit" value="'.$itemT['id'].'" name="taxonomie">'.$itemT['nom_taxonomie'].'</button>
                                                </form>
                                             </tr>';
                                }
                                ?>
                            </table>

                        </div>
                        <div class="colonne_droite">
                            <div id="articles_produits">
                                <?php
                                    #Préparation d'une requête incluant, de base, tous les produits disponibles
                                    $preparationRequete = "SELECT DISTINCT nom_produit FROM produit";
                                    #Concaténation avec un complément si recherche plus affinée
                                    if(isset($_GET)) {
                                        $preparationRequete .= " INNER JOIN categorie c on p.id_categorie = c.id
                                                                 INNER JOIN carac_couleur cc on p.id_carac_couleur = cc.id
                                                                 INNER JOIN carac_couleur cc on p.id_carac_couleur = cc.id
                                                                 INNER JOIN taxonomie_produit tp on p.id = tp.id_produit
                                                                 INNER JOIN taxonomie t on tp.id_taxonomie = t.id";
                                    }
                                    if (isset($GET['categorie']) !=0){
                                        $preparationRequete .= " WHERE p.id_categorie LIKE :categorie";
                                    }
                                    if (isset($GET['couleur']) !=0){
                                        $preparationRequete .= " WHERE p.id_carac_couleur LIKE :couleur";
                                    }
                                    if (isset($GET['taxonomie']) !=0){
                                        $preparationRequete .= " WHERE tp.id_taxonomie LIKE :taxonomie";
                                    }

                                    $requeteFinale = $db->prepare($preparationRequete);

                                    #Injection des éléments de l'URL dans la requête
                                    $requeteFinale->bindValue('categorie', $categorie);
                                    $requeteFinale->bindValue('couleur', $couleur);
                                    $requeteFinale->bindValue('taxonomie', $taxonomie);

                                    #Exécution de la requête préparée et création du tableau PHP contenant chaque élément
                                    $requeteFinale->execute();
                                    $requeteFinale = $requeteFinale->fetchAll();
                                    foreach ($requeteFinale as $itemRequete){
                                        echo'<div class="article_produits">
                                            <div class="article_container">';
                                        ?>
                                                <img class="image" src="<?= $itemRequete['image']; ?>.png" alt="image_produit">
                                                <h3><?= $itemRequete['nom_produit']; ?></h3>
                                                <h4><?php if($itemRequete['reduction_produit'] != 0){
                                                            $prixSpecial = $itemRequete['prix']/100*(100-$itemRequete['reduction_produit']);
                                                            echo $prixSpecial.'€ <strike>'.$itemRequete['prix'].'€</strike>';
                                                        }else{
                                                            echo $itemRequete['prix'].'€';
                                                        }?>
                                                </h4>
                                                <p><? = $itemRequete['reduction'] ?></p>
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