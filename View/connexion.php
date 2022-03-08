<?php
session_start();
$servername = "localhost";
$username = "root";
$pass = "";

try
{
    $db = new PDO("mysql:host=$servername;dbname=dendo",$username,$pass);
    $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Erreur de la connexion : " .$e->getMessage();
    die();
}

if (isset($_POST['connexion']) && !empty($_POST['username']) && !empty($_POST['password'])){
    $errors = [];
    $identifiant = htmlspecialchars($_POST['username']);
    $selectUsername = $db->prepare("SELECT * FROM compte_client WHERE identifiant = :username");
    $selectUsername->bindValue('username', $identifiant);
    $selectUsername->execute();
    $selectUsername = $selectUsername->fetch();
    if ($selectUsername == NULL){
        $errors[] = "Identifiant ou mot de passe incorrect";
    }else{
        if (!password_verify($_POST['password'], $selectUsername['mot_de_passe'])){
            $errors[] = "Identifiant ou mot de passe incorrect";
        }
    }
    if (!$errors){
        echo "connexion reussi";
        session_start();
        $_SESSION['identifiant'] = $selectUsername['id'];

        if(isset($_POST['id_produit_connexion'])) {
            header('Location: produit.php?id_produit='.$_POST['id_produit_connexion']);
            echo'oui';
        }
        else {
            header('Location: index.php');
        }
    }else{
        foreach ($errors as $error) {
            echo $error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include ('head.php'); ?>
    <link href="public/css/connexion.css" rel="stylesheet">
</head>
<body>

<?php include ('navbar.php'); ?>

<div class="contenu" id="contenu_connexion">
    <form action="connexion.php" method="post">
        <label for="username">Identifiant : </label>
        <input type="text" name="username" id="username">
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password">

        <?php if(isset($_POST['id_produit_connexion'])) { // ajouté par nihad ?>
            <input type="hidden" name="id_produit_connexion" value="<?php echo($_POST['id_produit_connexion']); ?>">
        <?php } ?>

        <input type="submit" name="connexion" value="Connexion" id="bouton_connexion" class="bouton">

    </form>

    <?php if(isset($_POST['id_produit_connexion'])) { // ajouté par nihad ?>
        <p>Si vous n'avez pas encore de compte : <a target="_blank" href="inscription.php?id_produit_inscription=<?php echo($_POST['id_produit_connexion']) ?>">inscrivez-vous</a></p>
    <?php }
    else{
        ?><p>Si vous n'avez pas encore de compte : <a href="inscription.php">inscrivez-vous</a></p>
    <?php } ?>
</div>
<?php include ('footer.php'); ?>
</body>
</html>

