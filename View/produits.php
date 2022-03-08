<?php
session_start();
?>
<?php
require_once ('Model/connexion_bdd.php');
function recuperationToken($name){
    if (isset($_GET[$name]) !=0){
        $resultat = $_GET[$name];
    } else {
        $resultat = "%";
    }
    return $resultat;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
        <?php include ('head.php'); ?>
        <link href="public/css/produits.css" rel="stylesheet">
    </head>
    <body>
        <div id="header">
            <?php include ('navbar.php'); ?>
        </div>
        <div class="contenu">
            <h1 class="titre_page">Nos produits</h1>
                <button class="open_button" onclick="openTri()">Recherche</button>
                    <div class="colonnes_container">
                        <div class="colonne_tri" id="popupTri">
                            <button class="close_button" onclick="closeTri()"><span class="iconify" data-icon="clarity:window-close-line"></span></button>
                            <!-- Boutons de tri + requêtage -->
                                 <?php
                                    #Récupération des noms dans les tables pour créer les listes déroulantes
                                    $listeCategories = $conn->query("SELECT id, nom_categorie FROM categorie");
                                    $listeCategories = $listeCategories->fetchAll();
                                    $listeCouleurs = $conn->query("SELECT id, couleur FROM carac_couleur");
                                    $listeCouleurs = $listeCouleurs->fetchAll();
                                    $listeTailles = $conn->query("SELECT id, taille_cadre FROM carac_taille_cadre");
                                    $listeTailles = $listeTailles->fetchAll();
                                    $listeTaxonomies = $conn->query("SELECT id, nom_taxonomie FROM taxonomie");
                                    $listeTaxonomies = $listeTaxonomies->fetchAll();
                                    ?>
                                    <!-- Formulaire de tri (5 listes + bouton submit)-->
                                    <form method="get">
                                        <label for="categorie">Type:</label>
                                        <br>
                                        <select name="categorie" id="categorie">
                                            <option value="%" name="categorie">Tout</option>
                                            <!--Chercher les données en base pour les afficher dans la liste-->
                                            <?php foreach ($listeCategories as $itemCategorie){
                                                echo '<option value="'.$itemCategorie['id'].'" name="'.$itemCategorie['nom_categorie'].'">'.$itemCategorie['nom_categorie'].'</option>';
                                            }?>
                                        </select>
                                        <br>
                                        <label for="couleur">Couleur:</label>
                                        <br>
                                        <select name="couleur" id="couleur">
                                            <option value="%" name="couleur">Tout</option>
                                            <?php foreach ($listeCouleurs as $itemCouleur){
                                                echo '<option value="'.$itemCouleur['id'].'" name="'.$itemCouleur['couleur'].'">'.$itemCouleur['couleur'].'</option>';
                                            }?>
                                        </select>
                                        <br>
                                        <label for="taxonomie">Genre:</label>
                                        <br>
                                        <select name="taxonomie" id="taxonomie">
                                            <option value="%" name="taxonomie">Tout</option>
                                            <?php foreach ($listeTaxonomies as $itemTaxonomie){
                                                echo '<option value="'.$itemTaxonomie['id'].'" name="'.$itemTaxonomie['nom_taxonomie'].'">'.$itemTaxonomie['nom_taxonomie'].'</option>';
                                            }?>
                                        </select>
                                        <br>
                                        <label for="taille">Taille:</label>
                                        <br>
                                        <select name="taille" id="taille">
                                            <option value="%" name="taille">Tout</option>
                                            <?php foreach ($listeTailles as $itemTaille){
                                                echo '<option value="'.$itemTaille['id'].'" name="'.$itemTaille['taille_cadre'].'">'.$itemTaille['taille_cadre'].'</option>';
                                            }?>
                                        </select>
                                        <br>
                                        <label for="electrique">Electrique:</label>
                                        <br>
                                        <select name="electrique" id="electrique">
                                            <option value="%" name="electrique">Tout</option>
                                            <option value="0" name="electrique">Non</option>
                                            <option value="1" name="electrique">Oui</option>
                                        </select>
                                        <br>
                                        <button type="submit" onclick="closeTri()">Lancer la recherche</button>
                                    </form>
                        </div>
                        <!--Partie où les articles apparaissent en fonction de la recherche-->
                        <div class="colonne_droite">
                            <div id="articles_produits">
                                <?php
                                    #Préparation d'une requête incluant, de base, tous les produits disponibles
                                    $preparationRequete = "SELECT * FROM produit p";
                                    #Concaténation avec un complément si recherche plus affinée: jointures + paramètres
                                    if(isset($_GET)) {
                                        $preparationRequete .= " INNER JOIN categorie c on p.id_categorie = c.id
                                                                 INNER JOIN carac_couleur cc on p.id_carac_couleur = cc.id
                                                                 INNER JOIN carac_taille_cadre ctc on p.id_carac_taille_cadre = ctc.id
                                                                 INNER JOIN taxonomie_produit tp on p.id_produit = tp.id_produit
                                                                 INNER JOIN taxonomie t on tp.id_taxonomie = t.id
                                                                 WHERE p.id_categorie LIKE :categorie
                                                                 AND p.id_carac_couleur LIKE :couleur
                                                                 AND p.id_carac_taille_cadre LIKE :taille
                                                                 AND tp.id_taxonomie LIKE :taxonomie
                                                                 AND p.electrique LIKE :electrique
                                                                 ORDER BY p.nom_produit";

                                        #Création de variables en fonction des tokens récupérés dans l'URL
                                        $categorie = recuperationToken('categorie');
                                        $couleur = recuperationToken('couleur');
                                        $taille = recuperationToken('taille');
                                        $taxonomie = recuperationToken('taxonomie');
                                        $electrique = recuperationToken('electrique');
                                    }
                                    #Et injection dans la requête préparée
                                    $requeteFinale = $conn->prepare($preparationRequete);
                                    $requeteFinale->bindValue('categorie', $categorie);
                                    $requeteFinale->bindValue('couleur', $couleur);
                                    $requeteFinale->bindValue('taille', $taille);
                                    $requeteFinale->bindValue('taxonomie', $taxonomie);
                                    $requeteFinale->bindValue('electrique', $electrique);
                                    #Exécution de la requête préparée et création du tableau PHP contenant chaque élément
                                    $requeteFinale->execute();
                                    $requeteFinale = $requeteFinale->fetchAll();
                                    #Avoir une variable nom d'article précédent pour éviter des doublons dans la recherche
                                    $nomPrecedent= "";
                                    if (empty($requeteFinale)){
                                        echo '<h2>Aucun vélo trouvé</h2>';
                                    }
                                    foreach ($requeteFinale as $itemRequete){
                                        if ($nomPrecedent != $itemRequete['nom_produit']){
                                            echo'<div class="article_produits">
                                                <div class="article_container">'; ?>
                                                <img class="image" src="public/images/produits/<?= $itemRequete['image']; ?>.png" alt="image_produit">
                                                <h3><?= $itemRequete['nom_produit']; ?></h3>
                                                <h4><?php if($itemRequete['reduction_produit'] != 0){
                                                            $prixSpecial = $itemRequete['prix']/100*(100-$itemRequete['reduction_produit']);
                                                            echo $prixSpecial.'€ <br><s>'.$itemRequete['prix'].'€</s>';
                                                        }else{
                                                            echo $itemRequete['prix'].'€';
                                                        }?>
                                                </h4>
                                                <p><?= $itemRequete['designation'] ?></p>
                                                </div>
                                            <a class="bouton_produit" href="produit.php?id_produit=<?=$itemRequete['id_produit'] ?>">Détails</a>
                                            </div>
                                    <?php }
                                        $nomPrecedent = $itemRequete['nom_produit'];
                                    }?>
                            </div>
                        </div>
                    </div>
        </div>
        <?php
        include ('footer.php');
        ?>
        <script>
                /*Ouverture et fermeture de la partie tri article*/
                function openTri() {
                    document.getElementById("popupTri").classList.add ("force_display");
                }
                function closeTri() {
                    document.getElementById("popupTri").classList.remove ("force_display");
                }
        </script>
        <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
    </body>
</html>