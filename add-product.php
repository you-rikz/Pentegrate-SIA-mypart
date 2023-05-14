<?php

include ("init.php");
use Models\Product;
use Models\Cart;

$product_id = $_POST['product_id'];
try {
    if(isset($_POST['product_id'])){
        $price = new Product('','','','','');
        $price->setConnection($connection);
        $price = $price->getByProductId($_POST['product_id']);
        
        foreach($price as $p){
            $product_price = $p['product_price'];
        }

        $quantity = $_POST['cart_item_quantity'];
        $total_price = $product_price * $quantity;
        
        $cart = new Cart(1, $_POST['product_id'] , $total_price, $_POST['cart_item_quantity']);
        $cart->setConnection($connection);
        $cart = $cart->addToCart();
        echo '<script>alert("Added to Cart Successfully")</script>';
        echo "<script>window.location.href=\"product-page.php?product_id=$product_id\";</script>";

        //echo "<script>window.location.href='index.php?success=1';</script>";
        
        exit();
        
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}