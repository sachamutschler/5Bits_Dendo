<?php
session_start();
include ('head.php');
include ('navbar.php');
if (isset($_SESSION['identifiant'])){
    session_destroy();
    header('Location: index.php');
}

