<?php

include ("../init.php");
use Models\Teacher;
use Models\Classes;

$teacher_id = $_GET['teacher_id'];
$teacher= new Teacher('', '', '', '', '', '');
$teacher->setConnection($connection);
$teacher->getById($teacher_id);
$first_name = $teacher->getFirstName();
$last_name = $teacher->getLastName();
$all_teachers = $teacher->viewClasses($teacher_id);

$template = $mustache->loadTemplate('teacher/view.mustache');
echo $template->render((compact('all_teachers', 'first_name','last_name', 'teacher_id')));
?>
