<?php

include ("../init.php");
use Models\Classes;
use Models\Teacher;

	$class_id = $_GET['class_id'];

	$classes = new Classes('','','','','','');
	$classes->setConnection($connection);
	$classes->getById($class_id);

    $teacher= new Teacher('', '', '', '', '', '');
    $teacher->setConnection($connection);
    $all_teachers = $teacher->displayTeachers();
	
	$name = $classes->getName();
	$description = $classes->getDescription();
	$class_code = $classes->getClassCode();
	$teacher_id = $classes->getTeacherId();

	$template = $mustache->loadTemplate('classes/edit');
	echo $template->render(compact('classes', 'all_teachers', 'class_id', 'name','description','class_code','teacher_id'));
?>