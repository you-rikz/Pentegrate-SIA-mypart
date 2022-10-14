<?php

include ("../init.php");
use Models\ClassRoster;

$rosters= new ClassRoster('', '', '', '', '', '');
$rosters->setConnection($connection);
$list_rosters = $rosters->displayClassRoster();
var_dump($list_rosters);

?>
