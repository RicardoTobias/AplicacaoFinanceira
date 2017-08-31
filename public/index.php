<?php

//
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Application;
use SONFin\Plugins\AuthPlugin;
use SONFin\Plugins\DbPlugin;
use SONFin\Plugins\RoutePlugin;
use SONFin\Plugins\ViewPlugin;
use SONFin\ServiceContainer;
use Dotenv\Dotenv;

//
require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = new Dotenv(__DIR__ . '/../');
    $dotenv->overload();
}

require_once __DIR__ . '/../src/helpers.php';

//
$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

//
$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

//
$app->get('/', function(RequestInterface $request) use($app) {
    $response = new Response();
    $response->getBody()->write('response com emitter do diactoros');
    return $response;
});

//
$app->get('/home/{name}/{id}', function(ServerRequestInterface $request) {
    $response = new Response();
    $response->getBody()->write('response com emitter do diactoros');
    return $response;
});

//
require_once __DIR__ . '/../src/controllers/category-costs.php';
require_once __DIR__ . '/../src/controllers/users.php';
require_once __DIR__ . '/../src/controllers/auth.php';
require_once __DIR__ . '/../src/controllers/bill-receives.php';
require_once __DIR__ . '/../src/controllers/bill-pays.php';
require_once __DIR__ . '/../src/controllers/statements.php';
require_once __DIR__ . '/../src/controllers/charts.php';

//
$app->start();
