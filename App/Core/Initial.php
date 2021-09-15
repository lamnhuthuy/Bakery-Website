<?php
defined('ROOT') ?:  define('ROOT', dirname(dirname(__DIR__)));


defined('DS') ?:  define('DS', DIRECTORY_SEPARATOR);

defined('APP') ?:  define('APP', ROOT . DS . 'App');
defined('CORE') ?:  define('CORE', APP . DS . 'Core');
defined('CONT') ?:  define('CONT', APP . DS . 'Controllers');
defined('MODEL') ?:  define('MODEL', APP . DS . 'Models');
defined('VIEW') ?:  define('VIEW', APP . DS . 'Views');
defined('CONF') ?:  define('CONF', APP . DS . 'Configs');
defined('PUB') ?:  define('PUB',  "http://" . $_SERVER['SERVER_NAME'] . ":81/bakery" . '/public');


$database = require(CONF . DS . 'database.php');

defined('DB_HOSTNAME') ?:  define('DB_HOSTNAME', $database['db_hostname']);
defined('DB_NAME') ?:  define('DB_NAME', $database['db_name']);
defined('DB_USERNAME') ?:  define('DB_USERNAME', $database['db_username']);
defined('DB_PASSWORD') ?:  define('DB_PASSWORD', $database['db_password']);

require_once(CORE . DS . "App.php");
require_once(CORE . DS . "Controller.php");
require_once(CORE . DS . "Database.php");
defined('DOCUMENT_ROOT') ?:  define('DOCUMENT_ROOT', "http://" . $_SERVER['SERVER_NAME'] . ":81/Bakery");

$adminSidebar = require(CONF . DS . 'admin_sidebar.php');

defined('ADMIN_SIDEBAR') ?:  define('ADMIN_SIDEBAR', $adminSidebar);
