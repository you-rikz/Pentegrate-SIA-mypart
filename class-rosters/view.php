<?php

include ("../init.php");
use Models\ClassRoster;
use Models\Classes;

$roster_id = intval($_GET['roster_id']);

$class_id = intval($_GET['roster_id']);
$class= new Classes('', '', '', '','', '');
$class->setConnection($connection);
$class->getById($class_id);
$class_code = $class->getClassCode();
$all_classes = $class->displayClassRoster($class_id);

$roster= new ClassRoster('', '', '', '', '', '');
$roster->setConnection($connection);

$all_rosters = $roster->viewRoster($class_code);

$template = $mustache->loadTemplate('classroster/view.mustache');
echo $template->render((compact('all_classes','all_rosters','roster_id')));
?>
