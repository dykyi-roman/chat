<?php

namespace Dykyi;

use Dotenv\Dotenv;
use Dykyi\Common\Config;

$pos              = strripos($_SERVER['DOCUMENT_ROOT'], '/');
$documentRootPath = mb_strcut($_SERVER['DOCUMENT_ROOT'], 0, $pos);
define('ROOT_DIR', $documentRootPath);

require_once '../vendor/autoload.php';

session_start();

$dotenv = new Dotenv('../');
$dotenv->load();

$app = new Application();
$app->run(Config::env('DEBUG'));