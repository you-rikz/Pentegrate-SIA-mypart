<?php
namespace Models;
use \PDO;

class Cart
{
    protected $user_id;
    protected $product_id;
	protected $total_price;
    protected $cart_item_quantity;  

    public function __construct($user_id, $product_id, $total_price, $cart_item_quantity)
	{
		$this->user_id= $user_id;
		$this->product_id= $product_id;
		$this->total_price= $total_price;
		$this->cart_item_quantity= $cart_item_quantity;
	}

	public function getUserId(){
		return $this->user_id;
	}

	public function getProductId(){
		return $this->product_id;
	}

	public function getTotalPrice(){
		return $this->total_price;
	}

	public function getCartItemQuantity(){
		return $this->cart_item_quantity;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addToCart(){
        try {
            $sql = "INSERT INTO ptg_cart_items (user_id, product_id, total_price, cart_item_quantity) 
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

	public function getCartItems($user_id){
		try {
			$sql = 'SELECT * FROM ptg_products INNER JOIN ptg_cart_items ON ptg_products.product_id=ptg_cart_items.product_id WHERE user_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$user_id
			]);
			return $statement->fetchAll();

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getCart($user_id){
		try {
			$sql = 'SELECT product_id, cart_item_quantity FROM ptg_cart_items WHERE user_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$user_id
			]);
			return $statement->fetchAll();

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
	// public function getCart($user_id){
    //     try {
    //         $sql = 'SELECT * FROM ptg_cart_items WHERE user_id=?';
	// 		$statement = $this->connection->prepare($sql);
            
	// 		$statement->execute([
	// 			$user_id
	// 		]);

    //         $row = $statement->fetch();
            
	// 		$this->product_id = $row['product_id'];
	// 		$this->cart_item_quantity = $row['cart_item_quantity'];

    //     } catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
    // }

	public function clearCartItems($user_id){
		try {
			$sql = 'DELETE FROM ptg_cart_items WHERE user_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$user_id
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}
