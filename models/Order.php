<?php
namespace Models;
use \PDO;

class Cart
{
    // protected $order_id;
    // protected $user_id;
	// protected $order_status;
    // protected $order_date;  

    // public function __construct()
	// {

	// }

	// public function getOrderId(){
	// 	return $this->order_id;
	// }

	// public function getUserId(){
	// 	return $this->user_id;
	// }

	// public function getOrderStatus(){
	// 	return $this->order_status;
	// }

	// public function getCartItemQuantity(){
	// 	return $this->order_date;
	// }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addToCart(){
        try {
            $sql = "INSERT INTO ptg_cart_items (user_id, product_id, order_status, cart_item_quantity) 
            VALUES (?, ?, ?, ?) 
            ON DUPLICATE KEY UPDATE total_price = total_price + ?, cart_item_quantity = cart_item_quantity + ? ";

			$statement = $this->connection->prepare($sql);

			return $statement->execute([
                $this->getUserId(),
                $this->getProductId(),
				$this->getTotalPrice(),
                $this->getCartItemQuantity(),
				$this->getTotalPrice(), // added parameter for ON DUPLICATE KEY UPDATE
                $this->getCartItemQuantity(), // added parameter for ON DUPLICATE KEY UPDATE
            ]);
        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}
