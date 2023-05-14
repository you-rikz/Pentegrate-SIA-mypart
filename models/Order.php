<?php
namespace Models;
use \PDO;

class Order
{
    protected $order_id;
    protected $product_id;
    protected $product_quantity;  

    public function __construct($order_id, $product_id, $product_quantity)
	{
		$this->order_id= $order_id;
		$this->product_id= $product_id;
		$this->product_quantity= $product_quantity;
	}

	public function getOrder(){
		return $this->order_id;
	}

	public function getProductId(){
		return $this->product_id;
	}

	public function getQuantity(){
		return $this->product_quantity;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function recordOrder(){
		try {
			$sql = "INSERT INTO ptg_orders SET user_id=?, order_status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				1,
				'Checked Out'
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addOrderDetails($order_id, $product_id, $product_quantity){
		try {
			$sql = "INSERT INTO ptg_order_details SET order_id=?, product_id=?, product_quantity=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$order_id,
				$product_id,
				$product_quantity,
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getOrderId($user_id){
		try {
			$sql = 'SELECT order_id FROM ptg_orders WHERE user_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$user_id
			]);
			return $statement->fetchAll();

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getOrderItems($order_id){
		try{
			$sql = 'SELECT * FROM ptg_order_details INNER JOIN ptg_orders ON ptg_order_details.order_id=ptg_orders.order_id INNER JOIN ptg_products ON ptg_order_details.product_id=ptg_products.product_id WHERE ptg_orders.user_id=1 AND ptg_order_details.order_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$order_id
			]);
			return $statement->fetchAll();

			// $data = $this->connection->query($sql)->fetchAll();
			// return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}
