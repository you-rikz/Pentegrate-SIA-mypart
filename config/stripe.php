<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51LgIL6JDVdkZQkB8LlIgHQbRhd0nkWRJZmUlg32mJIleQ6DyHGmdMg2JXKk3wXWenDOaQ8fMGgmBBSt0wmJeY0HY00FjrBokRO",
        "publishableKey" => "pk_test_51LgIL6JDVdkZQkB87y4tUjov4zuaXhOh7z7MZfBJJgEi6KPWAkUXQh0fymNr0Ayjir5BRld7Rjj035AUDMFDY2t700RyD669ah"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>