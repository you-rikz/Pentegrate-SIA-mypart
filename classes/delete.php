<?php

include ("../init.php");
use Models\Classes;

$class_id = $_GET['class_id'] ?? null;

$class = new Classes('','','','','','');
$class->setConnection($connection);
$class->getById($class_id);
$class->deleteClass();

echo "<script>window.location.href='index.php';</script>";
exit;