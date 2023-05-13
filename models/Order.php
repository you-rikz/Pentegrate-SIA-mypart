<?php
namespace Models;
use \PDO;

class Order
{
    // public function __construct()
	// {

	// }

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
			return $statement->fetch();

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}
