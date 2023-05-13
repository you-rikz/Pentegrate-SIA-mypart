<?php
namespace Models;
use \PDO;

class Product
{
    protected $product_name;
    protected $product_price;
    protected $product_description;
    protected $product_image;  

    public function __construct($product_name, $product_price, $product_description, $product_image)
	{
		$this->product_name= $product_name;
		$this->product_price= $product_price;
		$this->product_description= $product_description;
		$this->product_image= $product_image;
	}

	public function getProductName(){
		return $this->product_name;
	}

	public function getProductPrice(){
		return $this->product_price;
	}

	public function getProductDescription(){
		return $this->product_description;
	}

	public function getProductImage(){
		return $this->product_image;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getAllProducts(){
        try {
			$sql = 'SELECT * FROM ptg_products';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getByProductId($product_id){
		try {
			$sql = 'SELECT * FROM ptg_products WHERE product_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$product_id
			]);

			$row = $statement->fetchAll();
			foreach($row as $data){
				$this->product_name = $data['product_name'];
				$this->product_price = $data['product_price'];
				$this->product_description = $data['product_description'];
				$this->product_image = $data['product_image'];
			}
			return $row;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}