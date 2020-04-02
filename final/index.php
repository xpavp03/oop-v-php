<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$autoloadingBasePath = __DIR__ . '/classes';
require_once $autoloadingBasePath . '/services/Autoloader.php';

$autoloader = new Autoloader($autoloadingBasePath, '.php');
$autoloader->register();


$db = new Database( __DIR__ . '/../db/database.sq3');
$factory = new CustomerFactory;
$repo = new CustomerRepository($db);
$template = new Template(__DIR__ . '/templates');


$app = new IndexController($db, $repo, $factory, $template);
$app->process($_POST, $_SERVER['PHP_SELF']);
$app->render($_GET);