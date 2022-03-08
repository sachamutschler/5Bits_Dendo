<?php
    require_once "stripe/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51KYYVEHiJNyOGrbXcKOs3Lkd39B2a8UXaOaaJX6pQO8XiIUmNPn3gw4VZ0LhyYXokQ1vQF7exLwNC4DP2TFdasZL00ezxOn9LA",
        "publishableKey" => "pk_test_51KYYVEHiJNyOGrbX5zfIbX0zlIoPqmalGX73qmirWtx2NzeU8VCrXimncE47BEJdSjRVz8XImOq4IXdZdsdvphSr00xqzBq812"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>