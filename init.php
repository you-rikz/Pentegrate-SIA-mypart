<?php

include "vendor/autoload.php";
include "config/database.php";
include "config/stripe.php";

use Models\Connection;
use Models\Classes;
use Models\Teacher;
use Models\Student;

$connObj = new Connection($host, $database, $user, $password);
$connection = $connObj->connect();

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
]);

// $stripe = new \Stripe\StripeClient(
// 	'sk_test_51LgIL6JDVdkZQkB8LlIgHQbRhd0nkWRJZmUlg32mJIleQ6DyHGmdMg2JXKk3wXWenDOaQ8fMGgmBBSt0wmJeY0HY00FjrBokRO'
//   );
//   $product = $stripe->products->retrieve(
// 	  'prod_MP6pNBh2v4EVfo',
// 	  []
//   );