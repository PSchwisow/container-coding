<?php

define('BASE_PATH', realpath(__DIR__ . '/..'));

require_once(BASE_PATH . '/vendor/autoload.php');

$app = new \RKA\Slim([
    'view' => new \Slim\Views\Twig()
]);

// Set up databases
$config = new \Doctrine\DBAL\Configuration();
$dbParams = [
    'driver' => 'pdo_sqlite',
    'path' => BASE_PATH . '/containerdb.sqlite',
];
$conn = \Doctrine\DBAL\DriverManager::getConnection($dbParams, $config);
$app->container->set('connection', $conn);

// Set up ORM
$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    [BASE_PATH . '/src/Entity'],
    true,
    null,
    null,
    false
);
$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);
$app->container->set('entityManager', $entityManager);

// Set up view
$view = $app->view();
$view->parserOptions = [
    'debug' => true,
    'cache' => false
];
$view->parserExtensions = [
    new \Slim\Views\TwigExtension(),
];
$view->setTemplatesDirectory(BASE_PATH . '/views');

// Routing
$app->get(
    '/',
    'PSchwisow\ContainerCoding\Controller\IndexController:index'
);
$app->get(
    '/basic-mvc',
    'PSchwisow\ContainerCoding\Controller\BasicMvcController:addProductForm'
);
$app->post(
    '/basic-mvc',
    'PSchwisow\ContainerCoding\Controller\BasicMvcController:addProductSubmit'
);
$app->get(
    '/service-layer',
    'PSchwisow\ContainerCoding\Controller\ServiceLayerController:addProductForm'
);
$app->post(
    '/service-layer',
    'PSchwisow\ContainerCoding\Controller\ServiceLayerController:addProductSubmit'
);
$app->get(
    '/orm',
    'PSchwisow\ContainerCoding\Controller\OrmController:addProductForm'
);
$app->post(
    '/orm',
    'PSchwisow\ContainerCoding\Controller\OrmController:addProductSubmit'
);

// Run app
$app->run();
