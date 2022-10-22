<?php

include ("../init.php");
use Models\Teacher;

$teacher_id = $_GET['teacher_id'] ?? null;

$teacher = new Teacher('','','','','','');
$teacher->setConnection($connection);
$teacher->getById($teacher_id);
$teacher->deleteTeacher();

echo "<script>window.location.href='index.php';</script>";
exit;