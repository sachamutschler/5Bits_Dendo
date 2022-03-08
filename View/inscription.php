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
            $errors[] = "Votre mot de passe n'est pas conforme, il doit contenir entre 8 et 31 charactères, avec une majuscule et un caractère spécial.";
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
            echo '<p style="color:white">' . $error . '</p><br>';
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

    <form class="row g-3" action="inscription.php" method="post">
        <div class="col-md-6">
            <label for="validationDefault01" class="form-label">Nom <span style="color:red;">*</span></label>
            <input type="text" name="name" class="form-control" id="validationDefault01" required>
        </div>
        <div class="col-md-6">
            <label for="validationDefault02" class="form-label">Prenom <span style="color:red;">*</span></label>
            <input type="text" name="firstname"class="form-control" id="validationDefault02" required>
        </div>
        <div class="col-md-4">
            <label for="validationDefault03" class="form-label">Identifiant <span style="color:red;">*</span></label>
            <input type="text" name="identifiant"class="form-control" id="validationDefault03" required>
        </div>
        <div class="col-md-4">
            <label for="validationDefault04" class="form-label">Mot de passe <span style="color:red;">*</span></label>
            <input type="password" name="password" class="form-control" id="validationDefault04" required>
        </div>
        <div class="col-md-4">
            <label for="validationDefault05" class="form-label">Confirmer mot de passe <span style="color:red;">*</span></label>
            <input type="password" name="confirmPassword"class="form-control" id="validationDefault05" required>
        </div>
        <div class="col-md-8">
            <label for="mail" class="form-label">E-mail <span style="color:red;">*</span></label>
            <input type="email" name="email" class="form-control" id="mail"  aria-describedby="inputGroupPrepend2" required>
        </div>
        <div class="col-md-6">
            <label for="telPortable" class="form-label">Téléphone portable <span style="color:red;">*</span></label>
            <input type="number" name="telPort" class="form-control" id="telPortable" required>
        </div>
        <div class="col-md-6">
            <label for="telFixe" class="form-label">Téléphone fixe</label>
            <input type="number" name="tel" class="form-control" id="telFixe"  aria-describedby="inputGroupPrepend2">
        </div>
        <div class="col-md-6">
            <label for="adresseUn" class="form-label">Adresse 1 <span style="color:red;">*</span></label>
            <input type="text" name="adresse" class="form-control" id="adresseUn"  aria-describedby="inputGroupPrepend2" required>
        </div>
        <div class="col-md-6">
            <label for="adresseDeux" class="form-label">Adresse 2 </label>
            <input type="text" name="adresse2" class="form-control" id="adresseDeux"  aria-describedby="inputGroupPrepend2">
        </div>
        <div class="col-md-4">
            <label for="ville" class="form-label">Ville <span style="color:red;">*</span></label>
            <input type="text" name="ville" class="form-control" id="ville" required>
        </div>
        <div class="col-md-4">
            <label for="codePostal" class="form-label">Code Postal <span style="color:red;">*</span></label>
            <input type="text" name="cp" class="form-control" id="codePostal" required>
        </div>
        <div class="col-md-4">
            <label for="pays" class="form-label">Pays <span style="color:red;">*</span></label>
            <input type="text" name="pays" class="form-control" id="pays" required>
        </div>

        <i style="color:white;"><span style="color:red;">*</span> Champs obligatoires</i>
        <br>
        <br>

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
