<?php 

namespace Models;
use \PDO;
use Exception;

class ClassRoster 
{
	protected $roster_id;
    protected $class_code;
	protected $student_number;

    // Database Connection Object
	protected $connection;

	public function __construct($class_code, $student_number)
	{
        $this->class_code = $class_code;
        $this->student_number = $student_number;
	}

	public function getId() {
        return $this->roster_id;
    }

    public function getClassCode() {
        return $this->class_code;
    }

    public function getStudentNumber() {
        return $this->student_number;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function displayClassRosters(){
		try {
			$sql = "SELECT c.class_id, c.name, c.description, c.class_code, t.first_name, t.last_name, (SELECT COUNT(student_number) FROM class_rosters AS r WHERE r.class_code = c.class_code) AS students_enrolled FROM classes AS c INNER JOIN teachers AS t ON c.teacher_id=t.teacher_id";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

	public function viewRoster($class_code){
		try {
            $sql = "SELECT * FROM class_rosters INNER JOIN students on class_rosters.student_number=students.student_number WHERE class_code=:class_code";
            $statement = $this->connection->prepare($sql);
			$statement->execute([
				':class_code' => $class_code
			]);

            return $statement->fetchAll();

        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

	public function getById($roster_id){
        try {
            $sql = "SELECT * FROM class_rosters WHERE roster_id=:roster_id";
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':roster_id' => $roster_id
			]);

            $row = $statement->fetch();
            
			$this->roster_id = $row['roster_id'];
			$this->class_code = $row['class_code'];
			$this->description = $row['description'];
			$this->enrolled_at = $row['enrolled_at'];

        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addClassRoster(){
		try {

			$sql = "INSERT INTO class_rosters SET class_code=:class_code, student_number=:student_number";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':class_code' => $this->getClassCode(),
                ':student_number' => $this->getStudentNumber(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteClass(){
		try {

			$sql = "DELETE FROM class_rosters WHERE roster_id=:roster_id";

			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':class_code' => $this->getClassCode(),
                ':student_number' => $this->getStudentNumber(),
				':enrolled_at' => $this->getEnrolledAt(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}