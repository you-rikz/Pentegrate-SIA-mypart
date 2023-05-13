<?php

include ("init.php");
include ("session.php");
use Models\Cart;

$user_id = $_SESSION['user_id'];

$carts = new Cart('', '', '', '');
$carts->setConnection($connection);
$carts->clearCartItems($user_id);

$template = $mustache->loadTemplate('cart.mustache');
echo $template->render();


