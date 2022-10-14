
<?php

include "init.php";

$class = new Todo('');
$class->setConnection($connection);
$class->getById(1);
$class->delete();