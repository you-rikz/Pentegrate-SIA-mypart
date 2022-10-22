<?php
include ("../init.php");
use Models\ClassRoster;
use Models\Classes;

$roster= new ClassRoster('', '', '', '', '', '');
$roster->setConnection($connection);
$all_rosters = $roster->displayClassRosters();  

$template = $mustache->loadTemplate('classroster/index.mustache');
echo $template->render((compact('all_rosters')));
?>

