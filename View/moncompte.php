<?php
session_start();
include ('head.php');
include ('navbar.php');
 require_once ('Model/connexion_bdd.php');
if (isset($_POST['modifMdp'])){
    $errors = [];
    $selectOldMdp = $conn->prepare('SELECT mot_de_passe, id FROM compte_client WHERE id=:id ');
    $selectOldMdp->bindValue('id',$_SESSION['identifiant']);
    $selectOldMdp->execute();
    $selectOldMdp = $selectOldMdp->fetch();

    if (isset($_POST['mdpActuel']) && !empty($_POST['mdpActuel']) && password_verify($_POST['mdpActuel'], $selectOldMdp['mot_de_passe'])){
        if (isset($_POST['newMdp']) && isset($_POST['newMdpConfirm']) && !empty($_POST['newMdp']) && !empty($_POST['newMdpConfirm']) && $_POST['newMdp'] == $_POST['newMdpConfirm']){
            $newMdp = password_hash($_POST['newMdp'], PASSWORD_BCRYPT);
            $updatePassword = $conn->prepare('UPDATE compte_client SET mot_de_passe = :mdp WHERE id=:id');
            $updatePassword->bindValue('mdp', $newMdp);
            $updatePassword->bindValue('id', $_SESSION['identifiant']);
            $updatePassword->execute();
            echo "Mot de passe modifié";
        }else{
            $errors[] = "Votre ancien mot de passe ne correspond pas ou votre nouveau mot de passe n'est pas le même que la confirmation de mot de passe";
        }
    }else{
        $errors[] = "Votre ancien mot de passe ne correspond pas ou votre nouveau mot de passe n'est pas le même que la confirmation de mot de passe";
    }
    foreach ($errors as $error) {
        echo $error;
    }
}

if (isset($_POST['modifInfo'])){
    $adresseMail = htmlspecialchars($_POST['mailClient']);
    $codePostal = htmlspecialchars($_POST['cpClient']);
    $telClient = htmlspecialchars($_POST['telClient']);
    $telFixClient = htmlspecialchars($_POST['telFixClient']);
    $adresseUneClient = htmlspecialchars($_POST['adresseUneClient']);
    $adresseDeuxClient = htmlspecialchars($_POST['adresseDeuxClient']);
    $villeClient = htmlspecialchars($_POST['villeClient']);

    $updateInfo = $conn->prepare('UPDATE compte_client SET mail=:mail, code_postal=:cp, telephone_port=:telpor, telephone_fixe=:telfix, adresse_1=:adresse1, adresse_2=:adresse2,ville=:ville WHERE id=:id');
    $updateInfo->bindValue('mail', $adresseMail);
    $updateInfo->bindValue('cp', $codePostal);
    $updateInfo->bindValue('telpor', $telClient);
    $updateInfo->bindValue('telfix', $telFixClient);
    $updateInfo->bindValue('adresse1', $adresseUneClient);
    $updateInfo->bindValue('adresse2', $adresseDeuxClient);
    $updateInfo->bindValue('ville', $villeClient);
    $updateInfo->bindValue('id', $_SESSION['identifiant']);
    $updateInfo->execute();
}

$selectUserInfo = $conn->prepare('SELECT * FROM compte_client WHERE ID= :id');
$selectUserInfo->bindValue('id', $_SESSION['identifiant']);
$selectUserInfo->execute();
$selectUserInfo = $selectUserInfo->fetch();


?>
<style>
    h1{
        color:white;
    }
    p{
        color: white;
    }

</style>
<div class="contenu">

    <h1>Mon compte</h1>

    <h2>Vos informations</h2>
    <form action="moncompte.php" method="post">
        <p>Nom : <?= $selectUserInfo['nom_client']?> </p>
        <p>Prenom : <?= $selectUserInfo['prenom']?> </p>

        <label for="mailClient">Adrese mail : </label>
        <input type="email" name="mailClient" value = "<?= $selectUserInfo['mail']?>" id="mailClient"><br><br>

        <label for="cpClient">Code postal : </label>
        <input type="number" name="cpClient" value="<?= $selectUserInfo['code_postal']?>" id="cpClient"><br><br>

        <label for="telClient">Numéro de télèphone portable : </label>
        <input type="text" name="telClient" value="<?= $selectUserInfo['telephone_port']?>" id="telClient"><br><br>

        <label for="telFixClient">Numéro de télèphone fixe : </label>
        <input type="text" name="telFixClient" value="<?= $selectUserInfo['telephone_fixe']?>" id="telFixClient"><br><br>

        <label for="adresseUneClient">Adresse 1 : </label>
        <input type="text" name="adresseUneClient" value="<?= $selectUserInfo['adresse_1']?>" id="adresseUneClient"><br><br>

        <label for="adresseDeuxClient">Adresse 2 : </label>
        <input type="text" name="adresseDeuxClient" value="<?= $selectUserInfo['adresse_2']?>" id="adresseDeuxClient"><br><br>

        <label for="villeClient">Ville : </label>
        <input type="text" name="villeClient" value="<?= $selectUserInfo['ville']?>" id="villeClient"><br><br>

        <input type="submit" name="modifInfo" value="Modifier informations">
    </form>

    <?php
    if ($selectUserInfo['etat'] == 0){
        echo 'Vous n\'avez pas confirmé votre compte, veuillez le confirmer sur ce lien : <a href="confirmation.php?token=' . $selectUserInfo['code_validation'] . '"> Confirmer le mail </a>';
    }
    ?>

    <h2>Changer de mot de passe : </h2>
    <form action="moncompte.php" method="post">
        <label for="mdpClient">Votre ancien mot de passe : </label>
        <input type="password" name="mdpActuel" id="mdpClient">
        <br><br>
        <label for="newMdp">Nouveau mot de passe : </label>
        <input type="password" name="newMdp" id="newMdp">
        <label for="newMdpConfirm">Confirmez votre mot de passe : </label>
        <input type="password" name="newMdpConfirm" id="newMdpConfirm"><br><br>
        <input type="submit" name="modifMdp" value="Modifier">
    </form>
</div>
