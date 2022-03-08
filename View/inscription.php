<?php
session_start();
include ('head.php');
include('navbar.php');
require_once ('Model/connexion_bdd.php')
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Forms</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>
<body>

<?php
//identifiant base de donnée

function generateToken($len){
    $letter = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $token = "";
    $lenStr = strlen($letter);
    for ($i = 0; $i < $len; $i++){
        $random = rand(0,$lenStr-1);
        $token .= $letter[$random];
    }
    return $token;
}


//si on clique sur le bouton envoyer
if (isset($_POST['submit'])) {

    $errors = [];

    if  (isset($_POST['identifiant']) && !empty($_POST['identifiant'])){
        $selectExistInBdd = $conn->prepare('SELECT * FROM compte_client WHERE identifiant = :identifiant');
        $selectExistInBdd->bindValue('identifiant', $_POST['identifiant']);
        $selectExistInBdd->execute();
        $selectExistInBdd = $selectExistInBdd->fetch();
        if (!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $_POST['identifiant'])){
            $errors[] = "Votre nom d'utilisateur n'est pas conforme, il doit contenir entre 5 et 31 charactères sans charactères spéciaux";
        }elseif ($selectExistInBdd != NULL){
            $errors[] = "Cet identifiant est déjà utilisé";
        }
    }else{
    $errors[] = "Vous n'avez pas entré de nom d'utilisateur";
    }

    if  (isset($_POST['password']) && !empty($_POST['password'])){
        $pattern = '/^(?=.*[!@#$%^+&*-])(?=.*[0-9])(?=.*[A-Z]).{8,31}$/';
        if (!preg_match($pattern, $_POST['password'])){
            $errors[] = "Votre mot de passe n'est pas conforme, il doit contenir entre 8 et 31 charactères avec un symbole";
            }
        }else{
        $errors[] = "Vous n'avez pas entré de mot de passe";
    }

    if (isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword'])){
        if ($_POST['confirmPassword'] != $_POST['password']){
            $errors[] = "Votre confirmation ne correspond pas au mot de passe";
        }
    }else{
        $errors[] = "Vous n'avez pas confirmé votre mot de passe";
    }

    if (isset($_POST['email']) && !empty($_POST['email'])){
        if (!preg_match( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$_POST['email'])){
            $errors[] = "Votre mail n'est pas conforme";
        }
    }else{
        $errors[] =  "Vous n'avez pas entré de mails";
    }

    if (!isset($_POST['telPort']) && empty($_POST['telPort'])){
        $errors[] = "Votre numéro de téléphone n'est pas conforme";
    }

    if (!isset($_POST['adresse']) && empty($_POST['adresse'])){
        $errors[] = "Votre adresse n'est pas conforme";
    }

    if (!isset($_POST['ville']) && empty($_POST['ville'])){
        $errors[] = "Votre ville n'est pas conforme";
    }

    if (!isset($_POST['cp']) && empty($_POST['cp'])){
        $errors[] = "Votre code postal n'est pas conforme";
    }

    if (!isset($_POST['pays']) && empty($_POST['pays'])){
        $errors[] = "Votre pays n'est pas conforme";
    }

    if ($errors){
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }else{
        $token = generateToken(30);
        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $query = $conn->prepare("INSERT INTO Compte_client(identifiant, mot_de_passe, nom_client, prenom, mail, telephone_port, telephone_fixe, adresse_1, adresse_2, ville, code_postal, pays, code_validation)
                                    VALUES(:identifiant, :mdp, :nom, :prenom, :email, :telephone_port, :telephone_fixe, :adresse1, :adresse2, :ville, :cp, :pays, :code_validation)");
        $query->bindValue('identifiant', htmlspecialchars($_POST['identifiant']));
        $query->bindValue('mdp', $passwordHash);
        $query->bindValue('nom', htmlspecialchars($_POST['name']));
        $query->bindValue('prenom', htmlspecialchars($_POST['firstname']));
        $query->bindValue('email', htmlspecialchars($_POST['email']));
        $query->bindValue('telephone_port', htmlspecialchars($_POST['telPort']));
        $query->bindValue('telephone_fixe', htmlspecialchars($_POST['tel']));
        $query->bindValue('adresse1', htmlspecialchars($_POST['adresse']));
        $query->bindValue('adresse2', htmlspecialchars($_POST['adresse2']));
        $query->bindValue('ville', htmlspecialchars($_POST['ville']));
        $query->bindValue('cp', htmlspecialchars($_POST['cp']));
        $query->bindValue('pays', htmlspecialchars($_POST['pays']));
        $query->bindValue('code_validation', $token);
        $query->execute();

        $id = $conn->lastInsertId();

        $_SESSION['identifiant'] = $id;

        if(isset($_POST['id_produit_inscription'])) {
            header('Location: produit.php?id_produit='.$_POST['id_produit_inscription']);
        }else{
            header('Location: index.php');
        }
    }
}
else{
//    echo("Bienvenue sur mon formulaire !");
}



?>

<div class="contenu">

    <form action="inscription.php" method="post" class="form-example">

        <div class="form-example">
            <label for="name">Nom </label>
            <input type="text" name="name" id="name" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="firstname">Prénom </label>
            <input type="text" name="firstname" id="firstname" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="identifiant">Identifiant </label>
            <input type="text" name="identifiant" id="identifiant" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="password">Mot de passe </label>
            <input type="password" name="password" id="password" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="confirmPassword">Confirmer le mot de passe </label>
            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="email">E-mail </label>
            <input type="email" name="email" id="email" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="telPort"> Téléphone portable</label>
            <input type="tel" name="telPort" id="telPort" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="tel"> Téléphone</label>
            <input type="tel" name="tel" id="tel" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="adresse">Adresse </label>
            <input type="text" name="adresse" id="adresse" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="adresse2">Adresse 2</label>
            <input type="text" name="adresse2" id="adresse2" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="cp">Code Postal</label>
            <input type="number" name="cp" id="cp" class="form-control">
        </div><br>

        <div class="form-example">
            <label for="pays">Pays</label>
            <input type="text" name="pays" id="pays" class="form-control">
        </div><br>

        <div class="form-example">
            <input type="submit" name="submit" value="Envoyer" class="bouton">
        </div><br>

        <?php if(isset($_GET['id_produit_inscription'])) { ?>
            <input type="hidden" name="id_produit_inscription" value="<?php echo($_GET['id_produit_inscription']); ?>">
        <?php } ?>

    </form>
</div>

<?php include ('footer.php'); ?>
</body>
</html>
