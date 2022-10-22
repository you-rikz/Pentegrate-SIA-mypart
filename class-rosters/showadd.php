<?php
include ("../init.php");
use Models\ClassRoster;
use Models\Classes;
use Models\Student;

$roster_id = intval($_GET['roster_id']);

$class= new Classes('', '', '', '','', '');
$class->setConnection($connection);
$class->getById($roster_id);
$all_classes = $class->displayClassRoster($roster_id);

$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$all_students = $student->displayStudents();

$template = $mustache->loadTemplate('classroster/add.mustache');
echo $template->render(compact('all_classes', 'all_students'));
?>