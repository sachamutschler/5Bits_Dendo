<?php 

try
{
    $db = new PDO("mysql:host=$servername;dbname=dendo",$username,'');
    $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e)
{
    echo "Erreur de la connexion : " .$e->getMessage();
    die();
}

?>