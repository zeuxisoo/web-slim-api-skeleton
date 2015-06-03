<?php
date_default_timezone_set("Asia/Hong_Kong");

use Phpmig\Adapter;
use Illuminate\Database\Capsule\Manager as Capsule;

$config    = require_once 'config/default.php';
$databases = $config['databases'];
$capsule   = new Capsule;

foreach($databases as $name => $database) {
    $capsule->addConnection($database, $name);
}

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container = new ArrayObject();
$container['phpmig.adapter'] = new Adapter\Illuminate\Database($capsule, 'migrations');
$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

return $container;
