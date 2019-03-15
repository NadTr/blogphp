<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// PDO database library
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO("pgsql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'],
        $settings['user'], $settings['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
$container['view'] = function ($container) {

	$dir = dirname(__dir__);

    $view = new \Slim\Views\Twig($dir . '/app/views', [
        'cache' => false, //$dir . '/temp/cache'
        'debug' => true
    ]);
    $view->addExtension(new \Twig\Extension\DebugExtension());
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

    $categories = $container->db->query('
            SELECT *
            FROM categories ')->fetchAll();
    $authors = $container->db->query('
            SELECT *
            FROM users
            WHERE permission <= 2')->fetchAll();

    $view->getEnvironment()->addGlobal("categoriesAll", $categories);
    $view->getEnvironment()->addGlobal("authorsAll", $authors);

    $view->offsetSet('session', $_SESSION);
    
    return $view;
};
