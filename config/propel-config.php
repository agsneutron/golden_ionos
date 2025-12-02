<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('golden_clean', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=127.0.0.1;dbname=goldenti_db',
  'user' => 'goldenti_user',
  'password' => 'VTH7tJ5K',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' => [
        __DIR__ . '/generated-classes', // <-- aquí van los modelos generados
    ],
));
$manager->setName('golden_clean');
$serviceContainer->setConnectionManager('golden_clean',$manager);
$serviceContainer->setDefaultDatasource('golden_clean');
// Registrar explícitamente los TableMap
\Propel\Runtime\Map\TableMap::addClassMap(__DIR__ . '/generated-classes/Map');