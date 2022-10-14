<?php 

namespace Models;
use \PDO;
use Exception;

class ClassRoster 
{
    protected $class_code;
	protected $student_number;
	protected $enrolled_at;

    // Database Connection Object
	protected $connection;

	public function __construct($class_code, $student_number, $enrolled_at)
	{
        $this->class_code = $class_code;
        $this->student_number = $student_number;
        $this->enrolled_at = $enrolled_at;
	}

    public function getClassCode() {
        return $this->class_code;
    }

    public function getStudentNumber() {
        return $this->student_number;
    }

    public function getEnrolledAt() {
        return $this->enrolled_at;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function displayClassRoster(){
		try {
            $sql = "SELECT * FROM class_rosters";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function addClassRoster(){
		try {

			$sql = "INSERT INTO class_rosters SET class_code=:class_code, student_number=:student_number, enrolled_at=:enrolled_at";
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

    public function updateClass(){
		try {

			$sql = "UPDATE classes SET class_code=:class_code, student_number=:student_number, enrolled_at=:enrolled_at";
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

    public function deleteClass(){
		try {

			$sql = "DELETE FROM classes WHERE enrolled_at=$enrolled_at";

			$statement = $pdo->prepare($sql);

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