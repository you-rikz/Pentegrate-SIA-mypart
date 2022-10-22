<?php 

namespace Models;
use \PDO;
use Exception;

class Teacher 
{
    protected $teacher_id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $contact_number;
    protected $employee_number;
    
    // Database Connection Object
	protected $connection;

    public function __construct($first_name, $last_name, $email, $contact_number, $employee_number)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->contact_number = $contact_number;
        $this->employee_number = $employee_number;
    }

    public function getId() {
        return $this->teacher_id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContactNumber() {
        return $this->contact_number;
    }

    public function getEmployeeNumber() {
        return $this->employee_number;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function displayTeachers(){
		try {
            $sql = "SELECT * FROM teachers";
            $statement = $this->connection->query($sql)->fetchAll();
            return $statement;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function addTeacher(){
		try {

			$sql = "INSERT INTO teachers SET first_name=:first_name, last_name=:last_name, email=:email, contact_number=:contact_number, employee_number=:employee_number";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':first_name' => $this->getFirstName(),
                ':last_name' => $this->getLastName(),
                ':email' => $this->getEmail(),
                ':contact_number' => $this->getContactNumber(),
				':employee_number' => $this->getEmployeeNumber(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getById($teacher_id){
        try {
            $sql = 'SELECT * FROM teachers WHERE teacher_id=:teacher_id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':teacher_id' => $teacher_id
			]);

            $row = $statement->fetch();
            
			$this->teacher_id = $row['teacher_id'];
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
            $this->email = $row['email'];
            $this->contact_number = $row['contact_number'];
            $this->employee_number = $row['employee_number'];

        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }


    public function updateTeacher($first_name, $last_name, $email, $contact_number, $employee_number){
		try {

			$sql = "UPDATE teachers SET first_name=?, last_name=?, email=?, contact_number=?, employee_number=? WHERE teacher_id=?";
            $statement = $this->connection->prepare($sql);
			$statement->execute([
                $first_name, 
                $last_name, 
                $email, 
                $contact_number, 
                $employee_number,
                $this->getId()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteTeacher(){
		try {

			$sql = "DELETE FROM teachers WHERE teacher_id=?";
			$statement = $this->connection->prepare($sql);

			$statement->execute([
				$this->getId()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
    public function viewClasses($teacher_id){
		try {
            $sql = "SELECT * FROM teachers INNER JOIN classes on teachers.teacher_id=classes.teacher_id WHERE teachers.teacher_id=:teacher_id";
            $statement = $this->connection->prepare($sql);
			$statement->execute([
				':teacher_id' => $teacher_id
			]);
            return $statement->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}
    
}