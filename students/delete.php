<?php

include ("../init.php");
use Models\Student;

$student_id = intval($_GET['student_id']) ?? null;

$student = new Student('','','','','','');
$student->setConnection($connection);
$student->getById($student_id);
$student->deleteStudent();

echo "<script>window.location.href='index.php';</script>";
exit;