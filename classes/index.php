<?php

include ("../init.php");
use Models\Classes;

$classes= new Classes('', '', '', '', '', '');
$classes->setConnection($connection);
$list_classes = $classes->displayClasses();
var_dump($list_classes);

?>
