<?php

include ("../init.php");
use Models\Student;

$student_id = $_POST['id'];
$template = $mustache->loadTemplate('student/edit.mustache');
echo $template->render();

try {
	if (isset($_POST['first_name'])) {

		$student_id = $_POST['id'];
		
		$student = new Student($_POST['first_name'], $_POST['last_name'], $_POST['student_number'], $_POST['email'], $_POST['contact_number'], $_POST['program']);
		$student->setConnection($connection);
		$student->getById($student_id);
		$student->update();

		echo "<script>window.location.href='index.php';</script>";
		exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>