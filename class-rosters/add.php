<?php
include ("../init.php");
use Models\ClassRoster;

try {
	if (isset($_POST['class_code'])) {
		var_dump($_POST['class_code'], $_POST['student_number']);
		$addRoster = new ClassRoster($_POST['class_code'], $_POST['student_number']);
		$addRoster->setConnection($connection);
		$addRoster->addClassRoster();
		echo "<script>window.location.href='index.php';</script>";
		exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>

