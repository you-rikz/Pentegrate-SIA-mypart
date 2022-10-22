<?php

include ("../init.php");
use Models\Teacher;

	$teacher_id = $_GET['teacher_id'];
	//var_dump($teacher_id);
	$teacher = new Teacher('','','','','');
	$teacher->setConnection($connection);
	$teacher->getById($teacher_id);
		
	$first_name = $teacher->getFirstName();
	$last_name = $teacher->getLastName();
	$email = $teacher->getEmail();
	$contact_number = $teacher->getContactNumber();
	$employee_number = $teacher->getEmployeeNumber();

	$template = $mustache->loadTemplate('teacher/edit');
	echo $template->render(compact('teacher', 'teacher_id', 'first_name','last_name','email','contact_number','employee_number'));

?>