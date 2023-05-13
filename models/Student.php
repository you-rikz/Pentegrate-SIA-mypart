<?php 

namespace Models;
use \PDO;
use Exception;

class Student 
{
    protected $studentId;
    protected $firstName;
    protected $lastName;
    protected $birthdate;
    protected $address;
    protected $program;
    protected $contactNumber;
    protected $emergencyContact;

    public function __construct($studentId, $firstName, $lastName, $birthdate, $address, $program, $contactNumber, $emergencyContact)
    {
        $this->studentId = $studentId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->program = $program;
        $this->contactNumber = $contactNumber;
        $this->emergencyContact = $emergencyContact;
    }

    public function getId() {
        return $this->studentId;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getProgram() {
        return $this->program;
    }

    public function getContact() {
        return $this->contactNumber;
    }

    public function getEmergency() {
        return $this->emergencyContact;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function displayStudents(){
		try {
            $sql = "SELECT * FROM students";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function addStudent(){
		try {

			$sql = "INSERT INTO students SET first_name=:first_name, last_name=:last_name, student_number=:student_number, email=:email, contact_number=:contact_number, program=:program";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':first_name' => $this->getFirstName(),
                ':last_name' => $this->getLastName(),
				':student_number' => $this->getStudentNumber(),
				':email' => $this->getEmail(),
                ':contact_number' => $this->getContactNumber(),
                ':program' => $this->getProgram(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getById($student_id){
        try {
            $sql = 'SELECT * FROM students WHERE student_id=:student_id';
			$statement = $this->connection->prepare($sql);
            
			$statement->execute([
				':student_id' => $student_id
			]);

            $row = $statement->fetch();
            
			$this->student_id = $row['student_id'];
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
			$this->student_number = $row['student_number'];
            $this->email = $row['email'];
            $this->contact_number = $row['contact_number'];
            $this->program = $row['program'];


        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateStudent($first_name, $last_name, $student_number, $email, $contact_number, $program){
		try {

			$sql = "UPDATE students SET first_name=?, last_name=?, student_number=?, email=?, contact_number=?, program=? WHERE student_id=?";
            $statement = $this->connection->prepare($sql);

			$statement->execute([
                $first_name, 
                $last_name, 
                $student_number, 
                $email, 
                $contact_number, 
                $program,
                $this->getId()
                
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteStudent(){
		try {

			$sql = 'DELETE FROM students WHERE student_id=?';
			$statement = $this->connection->prepare($sql);

			$statement->execute([
				$this->getId()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    //wala pa roster
    public function viewClasses($student_id){
		try {
            $sql = "SELECT * FROM students INNER JOIN class_rosters ON students.student_number=class_rosters.student_number INNER JOIN classes ON class_rosters.class_code=classes.class_code WHERE students.id=:id";
            $statement = $this->connection->prepare($sql);
			$statement->execute([
				':student_id' => $student_id
			]);
            return $statement->fetchAll();

        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}
}