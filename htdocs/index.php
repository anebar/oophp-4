<?php
/**
 * Bootstrap the framework and handle the request.
 */

// Were are all the files?
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
define("ANAX_APP_PATH", ANAX_INSTALL_PATH);

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Add all resources to $app
$di  = new \Anax\DI\DIFactoryConfig("di.php");
$app = new \Anax\App\AppDIMagic();
$di->setShared("app", $app);
$app->setDI($di);

// Start session
// https://stackoverflow.com/questions/23103517/use-of-session-id-and-session-name?answertab=votes#tab-top
session_name(md5(__FILE__));
// $sessionName = substr(preg_replace('/[^a-z\d]/i', '', __DIR__), -30);
// session_name($sessionName);
session_start();

// Include user defined routes using $app-style.
foreach (glob(__DIR__ . "/../src/route/*.php") as $filename) {
    require $filename;
}

// Leave to router to match incoming request to routes
$app->router->handle(
    $app->request->getRoute(),
    $app->request->getMethod()
);
