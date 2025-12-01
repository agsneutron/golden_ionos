<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('golden_clean', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=127.0.0.1;dbname=goldenti_db',
  'user' => 'goldenti_user',
  'password' => 'ps6)]FZLmXya&Ctt',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('golden_clean');
$serviceContainer->setConnectionManager('golden_clean', $manager);
$serviceContainer->setDefaultDatasource('golden_clean');
require_once __DIR__ . '/./loadDatabase.php';
