<?php

use backend\controller\visitor\VisitorController;

ini_set("display_errors", 1);
error_reporting(E_ALL);

$autoloader = require_once '../vendor/autoload.php';

$c = new VisitorController();
echo $c->actionIndex();
