<?php
include ("init.php");
use Models\Product;

$products = new Product('', '', '', '');
$products->setConnection($connection);
$all_products = $products->getAllProducts();

$template = $mustache->loadTemplate('index.mustache');
echo $template->render(compact('all_products'));
