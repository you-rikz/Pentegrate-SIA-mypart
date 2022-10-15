<?php

include ("../init.php");
use Models\Classes;


$template = $mustache->loadTemplate('classes/add.mustache');
echo $template->render();

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