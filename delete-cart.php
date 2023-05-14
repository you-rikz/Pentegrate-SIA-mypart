<?php

include ("init.php");
use Models\Cart;

try {
    $carts = new Cart('', '', '','');
    $carts->setConnection($connection);
    $carts->clearCartItems(1);

    header("Location: cart.php");
    exit();
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}



