<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Hong_Kong");

define('WWW_ROOT', dirname(__FILE__));
define('APP_ROOT', WWW_ROOT.'/app');

require_once WWW_ROOT.'/vendor/autoload.php';

use Slim\Slim;
use Zeuxisoo\Laravel\Database\Eloquent\ModelMiddleware;

$config = require('config/default.php');
$app    = new Slim([
    'debug'               => $config['debug'],
    'cookies.encrypt'     => true,
    'cookies.lifetime'    => $config['cookie']['life_time'],
    'cookies.path'        => $config['cookie']['path'],
    'cookies.domain'      => $config['cookie']['domain'],
    'cookies.secure'      => $config['cookie']['secure'],
    'cookies.httponly'    => $config['cookie']['httponly'],
    'cookies.secret_key'  => $config['cookie']['secret_key'],
    'cookies.cipher'      => MCRYPT_RIJNDAEL_256,
    'cookies.cipher_mode' => MCRYPT_MODE_CBC,
]);

$app->config('databases', $config['databases']);
$app->add(new ModelMiddleware);

require_once APP_ROOT.'/routes.php';

$request   = $app->request();
$site_url  = $request->getUrl().$request->getRootUri();

$app->config('app.config',   $config);
$app->config('app.site_url', $site_url);

$app->run();
