<?php
include ("init.php");
include ("session.php");
use Models\Product;

$products = new Product('', '', '', '');
$products->setConnection($connection);
$all_products = $products->getAllProducts();

$user_id = $_SESSION['user_id'];
//var_dump($all_products);
$template = $mustache->loadTemplate('index.mustache');
echo $template->render(compact('all_products','user_id'));
