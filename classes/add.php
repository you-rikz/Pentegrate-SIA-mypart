<?php

include ("../init.php");
use Models\Classes;
use Models\Teacher;

$teacher= new Teacher('', '', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->displayTeachers();

$template = $mustache->loadTemplate('classes/add.mustache');
echo $template->render(compact('all_teachers'));

try {
	if (isset($_POST['name'])) {
		$addClass = new Classes($_POST['name'], $_POST['description'], $_POST['class_code'], $_POST['teacher_id']);
		$addClass->setConnection($connection);
		$addClass->addClass();
		echo "<script>window.location.href='index.php';</script>";
		exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>