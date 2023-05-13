<?php

include ("init.php");
use Models\Product;
session_start();
$user_id = $_SESSION['user_id'];

$product_id = $_GET['product_id']??null;

$product = new Product('', '', '', '');
$product->setConnection($connection);
$product = $product->getByProductId($product_id);

$template = $mustache->loadTemplate('product.mustache');
echo $template->render(compact('product','user_id'));