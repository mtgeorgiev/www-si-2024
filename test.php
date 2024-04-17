<?php

require_once 'bootstrap.php';

$ivan = new User("Ivan", "1234");

echo $ivan->getName();
