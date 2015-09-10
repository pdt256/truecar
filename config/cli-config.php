<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use pdt256\truecar\Lib\DoctrineTestCase;

require_once __DIR__ . '/../vendor/autoload.php';

class DoctrineTest extends DoctrineTestCase
{
    public function getEntityManager()
    {
        return $this->entityManager;
    }
};

$doctrineTest = new DoctrineTest;
$doctrineTest->setupEntityManager();
$entityManager = $doctrineTest->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
