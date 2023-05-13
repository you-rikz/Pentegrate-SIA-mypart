<?php

include ("init.php");
use Models\Cart;
use Models\Order;

$stripe = new \Stripe\StripeClient(
    'sk_test_51LgIL6JDVdkZQkB8LlIgHQbRhd0nkWRJZmUlg32mJIleQ6DyHGmdMg2JXKk3wXWenDOaQ8fMGgmBBSt0wmJeY0HY00FjrBokRO'
  );
  $checkout = $stripe->checkout->sessions->all(['limit' => 1]);

$jsonData = json_encode($checkout);
file_put_contents("checkout_session.json", $jsonData);

$session = $checkout->data[0];
// $id = $session->id;
// $line_items = $stripe->checkout->sessions->allLineItems($id, ['limit' => 5]);

// $jsonData = json_encode($line_items);
// file_put_contents("checkout_session.json", $jsonData);

//var_dump($line_items);

  $id = $session->id;
  $amount_total = $session->amount_total;
  $currency = $session->currency;
  $customer_details = $session->customer_details->email;
  $name = $session->customer_details->name;
  $payment_intent = $session->payment_intent;

$orders = new Order();
$orders->setConnection($connection);
$details = $orders->recordOrder();
//var_dump($details);
$order_detail_id = $orders->getOrderId(1);
//var_dump($order_detail_id);
$carts = new Cart('','', '', '', '');
$carts->setConnection($connection);
$cart = $carts->getCartItems(1);



foreach($cart as $cart_item){
  $order_id = $order_detail_id[0];
  $product_id = $cart_item['product_id'];
  $product_quantity = $cart_item['cart_item_quantity'];
  $orders->addOrderDetails($order_id, $product_id, $product_quantity);
}

// var_dump($cart);
//$orders->addOrderDetails($order_id, $product_id, $product_quantity);
//$checkout->



// $product_id = $carts->getProductId();
// $total_price = $carts->getTotalPrice();
// $quantity = $carts->getCartItemQuantity();

// $prices[] = array();
// foreach($all_carts as $carts){
//     $product_price = $carts['total_price'];
//     $p = array_push($prices,$product_price);
// }


// $cart_total = intval($prices[1]) + intval($prices[2]);

// $template = $mustache->loadTemplate('cart.mustache');
// echo $template->render(compact('all_carts','cart_total'));


