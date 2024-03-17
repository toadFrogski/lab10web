<?php
session_start();

set_include_path(__DIR__ . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'Templates');
define('BASEDIR', __DIR__);

require_once 'autoload.php';
require_once(__DIR__ . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Config" . DIRECTORY_SEPARATOR . "Settings.php");
require_once(__DIR__ . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Config" . DIRECTORY_SEPARATOR . "Routing.php");
