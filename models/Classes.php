<?php 

namespace Models;
use \PDO;
use Exception;

class Classes 
{
    protected $class_id;
	protected $name;
	protected $description;
	protected $class_code;
    protected $teacher_id;

    // Database Connection Object
	protected $connection;

	public function __construct($name, $description, $class_code, $teacher_id)
	{
        $this->name = $name;
        $this->description = $description;
        $this->class_code = $class_code;
        $this->teacher_id = $teacher_id;
	}

    public function getId() {
        return $this->class_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getClassCode() {
        return $this->class_code;
    }

    public function getTeacherId() {
        return $this->teacher_id;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function displayClasses(){
		try {
            $sql = "SELECT * FROM classes INNER JOIN teachers on classes.teacher_id=teachers.teacher_id";

            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function addClass(){
		try {

			$sql = "INSERT INTO classes SET name=:name, description=:description, class_code=:class_code, teacher_id=:teacher_id";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':name' => $this->getName(),
                ':description' => $this->getDescription(),
				':class_code' => $this->getClassCode(),
				':teacher_id' => $this->getTeacherId(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateClass($name, $description, $class_code, $teacher_id){
		try {

			$sql = "UPDATE classes SET name=?, description=?, class_code=?, teacher_id=? WHERE class_id=?";
			$statement = $this->connection->prepare($sql);

			$statement->execute([
				$name, 
				$description, 
				$class_code, 
				$teacher_id, 
				$this->getId(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteClass(){
		try {

			$sql = "DELETE FROM classes WHERE class_id=?";
			$statement = $this->connection->prepare($sql);

			$statement->execute([
				$this->getId()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

	public function getById($class_id){
        try {
            $sql = 'SELECT * FROM classes WHERE class_id=:class_id';
			$statement = $this->connection->prepare($sql);

			$statement->execute([
				':class_id' => $class_id
			]);

            $row = $statement->fetch();
            
			$this->class_id = $row['class_id'];
			$this->name = $row['name'];
			$this->description = $row['description'];
			$this->class_code = $row['class_code'];
            $this->teacher_id = $row['teacher_id'];

        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

	public function displayClassRoster($class_id){
		try {
            $sql = "SELECT * FROM classes WHERE class_id=:class_id";
            $statement = $this->connection->prepare($sql);
			$statement->execute([
				':class_id' => $class_id
			]);
            return $statement->fetch();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}
}