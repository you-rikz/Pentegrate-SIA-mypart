<?php

include ("../init.php");
use Models\Student;


$template = $mustache->loadTemplate('classroster/add.mustache');
echo $template->render();

try {
	if (isset($_POST['first_name'])) {
		$addRoster = new ClassRoster($_POST['class_code'], $_POST['student_number'], $_POST['enrolled_at']);
		$addRoster->setConnection($connection);
		$addRoster->addClassRoster();
		var_dump($addRoster);
		echo "<script>window.location.href='index.php';</script>";
		exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>