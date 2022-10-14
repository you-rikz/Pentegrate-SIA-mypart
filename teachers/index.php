<?php

include ("../init.php");
use Models\Teacher;

$teacher= new Teacher('', '', '', '', '', '');
$teacher->setConnection($connection);
$list_teachers = $teacher->displayTeachers();
var_dump($list_teachers);

?>
