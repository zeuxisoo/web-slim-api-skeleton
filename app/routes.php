<?php
if (defined('APP_ROOT') === false) exit('Access Denied');

$app->get('/', 'App\Controllers\HomeController:index');
