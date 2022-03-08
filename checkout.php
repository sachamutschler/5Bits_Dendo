<?php
    session_start();

    include_once('Model/connexion_bdd.php');
    include_once('Model/model_panier.php');
    include_once('View/head.php');
    if(isset($_GET)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Integartion (Stripe)</title>
    <link rel="stylesheet" href="./css/_style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<button type="button" onclick="goback()" class="back">Go Back</button> 
<div class="row">
    <div class="col-md-6">
        <div class="form-container">
            <form autocomplete="off" action="checkout-charge.php" method="POST">
                <div>
                    <input type="text" name="c_name" required/>
                    <label>Nom / Prénom</label>
                </div>
                <div>
                    <input type="text" name="address" required/>
                    <label>Adresse</label>
                </div>
                <div>
                    <input type="number" id="ph" name="phone" pattern="\d{10}" maxlength="10" required/>
                    <label>numéro de téléphone</label>
                </div>
                <div>
                    <input type="text"  name="price" value="<?php echo $_SESSION['total'];?>" disabled required/>
                    <label>Prix</label>
                </div>
               
                    <input type="hidden" name="amount" value="<?php //echo $_GET["price"]?>">
                    <input type="hidden" name="product_name" value="<?php //echo $_GET["item_name"]?>">
                
                <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51KYYVEHiJNyOGrbX5zfIbX0zlIoPqmalGX73qmirWtx2NzeU8VCrXimncE47BEJdSjRVz8XImOq4IXdZdsdvphSr00xqzBq812"
                data-amount="<?php $_SESSION['total'];?>"
                data-name="<?php  echo $_GET["item_name"];?>"
                data-description="<?php  echo $_GET["item_name"];?>"
                data-currency="inr"
                data-locale="auto">
                </script>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="checkout-container">
            <h4>Product Name&nbsp;:&nbsp;<?php //echo $_GET["item_name"]?></h4>
            <img src="<?php // echo $_GET["image"]?>"/>
            <span>Price &nbsp;:&nbsp;<?php echo $_SESSION['total'];?></span>
        </div>
    </div>
</div> 

<?php
  }
?>
<script>
    function goback(){
        window.history.go(-1);
    }

    $('#ph').on('keypress',function(){
         var text = $(this).val().length;
         if(text > 9){
              return false;
         }else{
            $('#ph').text($(this).val());
         }
         
    });
</script>
</body>
</html>