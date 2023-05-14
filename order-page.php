<?php

include ("init.php");
use Models\Order;
use Models\Cart;

$stripe = new \Stripe\StripeClient(
    'sk_test_51LgIL6JDVdkZQkB8LlIgHQbRhd0nkWRJZmUlg32mJIleQ6DyHGmdMg2JXKk3wXWenDOaQ8fMGgmBBSt0wmJeY0HY00FjrBokRO'
  );
try {
    $checkout = $stripe->checkout->sessions->all(['limit' => 1]);
    $session = $checkout->data[0];
    $amount_total = $session->amount_total;
    $total = number_format(($amount_total/100),2);

    $order = new Order('','','');
    $order->setConnection($connection);
    $id = $order->getOrderId(1);
    $detail_id = end($id);
    $order_items = $order->getOrderItems($detail_id[0]);

    $carts = new Cart('','', '', '');
    $carts->setConnection($connection);
    $carts->clearCartItems(1);
    $template = $mustache->loadTemplate('order.mustache');
    echo $template->render(compact('order_items','total'));

} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}