<?php
session_start();

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
            echo "<div class='validation' id='validation'>Mot de passe modifié</div>";
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

    echo "<div class='validation' id='validation'>Informations modifiés</div>";
}

$selectUserInfo = $conn->prepare('SELECT * FROM compte_client WHERE ID= :id');
$selectUserInfo->bindValue('id', $_SESSION['identifiant']);
$selectUserInfo->execute();
$selectUserInfo = $selectUserInfo->fetch();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include ('head.php'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link href="public/css/accueil.css" rel="stylesheet">

</head>
<body>
<style>
    h1{
        color:white;
    }
    p{
        color: white;
    }
    .validation{
        position: absolute;
        width: 100%;
        background-color: rgba(0,128,0,0.5);
        padding: 27px;
        text-align: center;
        color : white;
        top: 80px;
    }
</style>
<div id="header">
    <?php include ('navbar.php'); ?>
</div>
<div class="contenu p-5">

    <h1>Mon compte</h1>

    <h2>Vos informations</h2>
    <form class="row g-3" action="moncompte.php" method="post">
        <p>Nom : <?= $selectUserInfo['nom_client']?> </p>
        <br>
        <p>Prenom : <?= $selectUserInfo['prenom']?> </p>
        <br>
        <div class="col-md-6">
            <label for="telClient" class="form-label">Numéro de télèphone portable : </label>
            <input type="number" class="form-control" name="telClient" value="<?= $selectUserInfo['telephone_port']?>" id="telClient">
        </div>
        <div class="col-md-6">
            <label for="telFixClient" class="form-label">Numéro de télèphone fixe : </label>
            <input type="number" class="form-control" name="telFixClient" value="<?= $selectUserInfo['telephone_fixe']?>" id="telFixClient">
        </div>
        <div class="col-md-8">
            <label for="mailClient" class="form-label">Adrese mail : </label>
            <input class="form-control" type="email" name="mailClient" value = "<?= $selectUserInfo['mail']?>" id="mailClient">
        </div>

        <div class="col-md-4">
            <label for="cpClient" class="form-label">Code postal : </label>
            <input type="number" class="form-control" name="cpClient" value="<?= $selectUserInfo['code_postal']?>" id="cpClient">
        </div>
        <div class="col-md-4">
            <label for="adresseUneClient" class="form-label">Adresse 1 : </label>
            <input type="text" class="form-control" name="adresseUneClient" value="<?= $selectUserInfo['adresse_1']?>" id="adresseUneClient">
        </div>
        <div class="col-md-4">
            <label for="adresseDeuxClient" class="form-label">Adresse 2 : </label>
            <input type="text" class="form-control" name="adresseDeuxClient" value="<?= $selectUserInfo['adresse_2']?>" id="adresseDeuxClient">
        </div>
        <div class="col-md-4">
            <label for="villeClient" class="form-label">Ville : </label>
            <input type="text" class="form-control" name="villeClient" value="<?= $selectUserInfo['ville']?>" id="villeClient">
        </div>
        <div class="form-example">
            <input type="submit" name="modifInfo" value="Modifier informations" class="bouton">
        </div><br>
    </form>

    <?php
    if ($selectUserInfo['etat'] == 0){
        echo '<p>Vous n\'avez pas confirmé votre compte, veuillez le confirmer sur ce lien : <a href="confirmation.php?token=' . $selectUserInfo['code_validation'] . '"> Confirmer le mail </a></p>';
    }
    ?>

    <h2>Changer de mot de passe : </h2>
    <form action="moncompte.php" method="post">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" for="mdpClient">Votre ancien mot de passe : </label>
                <input class="form-control" type="password" name="mdpActuel" id="mdpClient">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label class="form-label" for="newMdp">Nouveau mot de passe : </label>
                <input class="form-control" type="password" name="newMdp" id="newMdp">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="newMdpConfirm">Confirmez votre mot de passe : </label>
                <input class="form-control" type="password" name="newMdpConfirm" id="newMdpConfirm"><br><br>
            </div>
        </div>
        <div class="form-example">
            <input type="submit" name="modifMdp" value="Modifier" class="bouton">
        </div><br>
    </form>
</div>
<script>
    function dnone(){
        let validation = document.getElementById('validation');
        validation.style.display = "none";
    }
    setTimeout(dnone,4000);

</script>
