<?php

include ("init.php");
use Models\Product;

$product_id = $_GET['product_id']??null;

$product = new Product('', '', '', '');
$product->setConnection($connection);
$product = $product->getByProductId($product_id);

$template = $mustache->loadTemplate('single-product.mustache');
echo $template->render(compact('product'));