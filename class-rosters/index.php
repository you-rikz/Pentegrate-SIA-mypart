
<?php
include ("../init.php");
use Models\ClassRoster;

$roster= new ClassRoster('', '', '', '', '', '');
$roster->setConnection($connection);
$all_rosters = $roster->displayClassRoster();

$template = $mustache->loadTemplate('classroster/index.mustache');
echo $template->render((compact('all_rosters')));

