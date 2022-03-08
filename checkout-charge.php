<?php
    session_start();
    include("./config.php");

    $token = $_POST["stripeToken"];
    $contact_name = $_POST["c_name"];
    $token_card_type = $_POST["stripeTokenType"];
    $phone           = $_POST["phone"];
    $email           = $_POST["stripeEmail"];
    $address         = $_POST["address"];
    $amount          = $_POST["amount"]; 
    $charge = \Stripe\Charge::create([
      "amount" => $_SESSION['total'],
      "currency" => 'eur',
      "description"=>$desc,
      "source"=> $token,
    ]);

    if($charge){
      header("Location:success.php?amount= " . $_SESSION['total'] . " ");
    }
?>