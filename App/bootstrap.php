<?php

spl_autoload_register(function ($class) {

  // replace namespace separators with directory separators and append with .php
  $file = str_replace('\\', '/', $class . '.php');

  if (file_exists($file)) {
    require $file;
  }
});

require_once "../vendor/autoload.php";

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);
