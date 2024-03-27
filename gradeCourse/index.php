<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set("display_errors", '1');

// composer SPRAWDZ!

spl_autoload_register( function(string $name) {
   $name = str_replace(['\\', 'App/'], ['/', ''], $name);
   $path = "src/$name.php";
   require_once($path);
});

require_once('src/utils/debug.php');
$configuration = require_once('config/config.php');

use App\Request;
use App\Exception\AppException;
use App\Exception\ConfigurationException;
use App\Controller\AbstractController;
use App\Controller\GradeController;
  
$request = new Request($_GET, $_POST, $_SERVER);

try {
   AbstractController::initConfiguration($configuration);
   (new GradeController($request))->run();
} catch (ConfigurationException $e) {
   echo "<h2>Błąd konfiguracji ConfigurationException</h2>";
   echo $e->getMessage();
} catch (AppException $e) {
   echo "<h2>Wystąpił błąd z rodziny AppException</h2>";
   echo $e->getMessage();
   dump($e);
} catch (\Throwable $e) {
   echo "<h2>Wystąpił błąd w aplikacji</h2>";
   dump($e);
}
