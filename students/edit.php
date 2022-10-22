<?php

include ("../init.php");
use Models\Student;

	$student_id = $_GET['student_id'];

	$student = new Student('','','','','','');
	$student->setConnection($connection);
	$student->getById($student_id);
	
	$first_name = $student->getFirstName();
	$last_name = $student->getLastName();
	$student_number = $student->getStudentNumber();
	$email = $student->getEmail();
	$contact_number = $student->getContactNumber();
	$program = $student->getProgram();

	$template = $mustache->loadTemplate('student/edit');
	echo $template->render(compact('student', 'student_id', 'first_name','last_name','student_number','email','contact_number','program'));

?>