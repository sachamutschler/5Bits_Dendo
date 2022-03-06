<?php
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
        $_SESSION['identifiant'] = $identifiant;
        header('Location: index.php');
    }else{
        foreach ($errors as $error) {
            echo $error;
        }
    }
}

?>
<form action="connexion.php" method="post">
    <label for="username">Identifiant : </label>
    <input type="text" name="username" id="username">
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password">
    <input type="submit" name="connexion" value="Connexion">
</form>
<p>Si vous n'avez pas encore de compte : <a href="inscription.php">inscrivez-vous</a></p>
