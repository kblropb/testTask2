<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

$autoloader = require_once '../vendor/autoload.php';

const INDEX_CONTROLLER_NAME = 'visitor';

$path = parse_url($_SERVER['REQUEST_URI']);
$routes = explode('/', $path['path']);

$controller = empty($routes[1]) ? INDEX_CONTROLLER_NAME : $routes[1];
$action = empty($routes[2]) ? 'index' : $routes[2];
parse_str($_SERVER['QUERY_STRING'], $params);

$controllerName = ucfirst($controller) . 'Controller';
$actionName = 'action' . ucfirst($action);

$controllerClass = 'backend\controller\\' . $controller . '\\' . $controllerName;
$controller = new $controllerClass();

$params = $_SERVER['REQUEST_METHOD'] === 'POST'
    ? json_decode(file_get_contents("php://input"), true)
    : $_GET;

echo $controller->$actionName($params);