<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use pdt256\truecar\Lib\DoctrineHelper;

require_once __DIR__ . '/../vendor/autoload.php';

$doctrine = new DoctrineHelper(new Doctrine\Common\Cache\ArrayCache());
$doctrine->setup([
    'driver' => 'pdo_sqlite',
    'memory' => true,
]);

$entityManager = $doctrine->getEntityManager();

// Fix MySQL enum
$platform = $entityManager->getConnection()->getDatabasePlatform();
$platform->registerDoctrineTypeMapping('enum', 'string');

return ConsoleRunner::createHelperSet($entityManager);
