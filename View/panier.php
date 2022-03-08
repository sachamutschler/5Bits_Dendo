<?php

use Mockery\Undefined;
use PhpParser\Node\Stmt\Echo_;

session_start();
include('Model/connexion_bdd.php');

if(isset($_POST['deleteItem'])){
    $id_client = $_SESSION['identifiant'];
    $id_produit = $_POST['deleteItem'];
    $req_delete = "DELETE FROM panier WHERE id_produit = ".$id_produit." AND id_compte_client = ".$id_client;

    $req_delete = $conn->query($req_delete);
    $req_delete->execute();
}
                                
?>


<head>
    <?php include ('head.php'); ?>
</head>
<div id="header">
    <?php include ('navbar.php'); ?>
    <link href="public/css/panier.css" rel="stylesheet">
</div>
<div class="cont_panier">
    <div class="cont_panier2">
        <?php
        $prix = 0;
            include('Model/model_panier.php');
            $total = 0;
            for($i=0; $i<count($tableau_id_produit); $i++) {
                ?>
                <div class="panier">
                    <img class="imagePanier" src="public/images/produits/<?php echo $tableau_produit[$i]['image'];?>.png" alt="produit_accueil">
                    <div class="text_panier">
                        <!-- Création d'un formulaire -->
                        <form action="" class="quantity" method="post">
                            <!-- Affichage du nom du produit avec la ligne $i puis la colonne -->
                            <label for="title_panier" class="t_panier"><?php echo $tableau_produit[$i]['nom_produit']; ?></label>
                            <!-- Affichage de la quantité de vélo sélectionnée avec la ligne $i puis la colonne -->
                            <label class="t_panier">Quantité : <?php echo $tableau_id_produit[$i]['quantite']; ?> </label>
                            <!-- Si la reduction est différente de 0 alors on calcule la réduction -->
                            <?php if($tableau_produit[$i]['reduction_produit'] != 0) {
                                $prix = $tableau_produit[$i]['prix']  * (1 - ($tableau_produit[$i]['reduction_produit'] / 100) );
                            }
                            else {
                                /* Sinon on affiche le prix */
                                $prix = $tableau_produit[$i]['prix'];
                            }
                            $total = $total + ($prix * $tableau_id_produit[$i]['quantite']);
                            ?>

                            <label class="t_panier">Prix : <?php echo $prix; ?> €</label>
                            
                            <button type="submit" value="<?php echo($tableau_produit[$i]['id_produit']) ?>" name="deleteItem" class="bouton delete_panier">Supprimer</button>
                            
                            

                        </form> 
                    </div>
                </div>
                <?php
            }
            
            if ($prix==0 || $total ==0) {
            
                echo "<style> .total_buy{ display: none;} </style>";
                
            }
            
            
        ?>
    </div>
    
    
</div>

<div class="total_buy">
        <div class="cont_total"> 
            <p class="txt_total">Le montant total est de : </br> <?php echo("$total"); ?> €</p>
        </div>
        <div class="cont_buy">
            <a href="checkout.php"><input type="button" value="Paiement" name="livraison_panier" class="panier_livraison bouton"></a>
        </div>
    </div>
<?php 
$_SESSION['total'] = $total; 
include ('footer.php'); 

?>

