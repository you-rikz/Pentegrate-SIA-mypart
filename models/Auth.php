<?php
namespace Models;
use \PDO;

class Auth
{
    protected $email;
    protected $password;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function login($email, $password){
        //$encrypted_password = sha1($password);
        $sql = 'SELECT * FROM ptg_users WHERE email=? AND password=?';
		$statement = $this->connection->prepare($sql);
		$statement->execute([
				$email,
                $password
		]);
        $row = $statement->fetch();
        return $row;
    }
}