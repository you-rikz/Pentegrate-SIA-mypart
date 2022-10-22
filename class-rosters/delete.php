<?php

include ("../init.php");
use Models\ClassRoster;

$roster_id = $_GET['roster_id'] ?? null;

$roster = new ClassRoster('','','','','','');
$roster->setConnection($connection);
$roster->getById($roster_id);
$roster->deleteStudent();

echo "<script>window.location.href='index.php';</script>";
exit;