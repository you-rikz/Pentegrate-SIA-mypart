<?php

include ("../init.php");
use Models\Classes;

try {
	if (isset($_POST['class_id'])) {
        $class_id = intval($_POST['class_id']);
        $name = $_POST['name'];
        $description = $_POST['description'];
        $class_code = $_POST['class_code'];
        $teacher_id = intval($_POST['teacher_id']);

        $classes = new Classes('','','','','');
        $classes->setConnection($connection);
        $classes->getById($class_id);

        $classes->updateClass($name, $description, $class_code, $teacher_id);
        echo "<script>window.location.href='index.php';</script>";
        exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}