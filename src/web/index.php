<?php

/**
 * Application entrypoint
 */


use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

/**
 * Register container dependencies
 */

$container->set('db', function (\Psr\Container\ContainerInterface $container)  {
    $dbManager = new \Illuminate\Database\Capsule\Manager();

    $dbManager->addConnection([
        'driver' => 'mysql',
        'host' => 'mysql',
        'database' => 'api',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);

    $dbManager->bootEloquent();

    return $dbManager->getConnection('default');
});

$container->set(\App\Contracts\GaragesFetcherContract::class, function (\Psr\Container\ContainerInterface $container) {
    return new \App\Services\GaragesFetcher($container);
});

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->redirect('/', '/garages');

$app->get('/garages[/{criteria:owner|country|location}[/{criteriaValue}]]', function ($request, $response, $args) use ($container) {
    return \App\Services\ContainerProxy::withContainer(
        $request,
        $response,
        $args,
        $container,
        \App\Controllers\GetAllGaragesController::class
    );
});


// cors from docs
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


$app->run();