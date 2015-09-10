<?php
namespace pdt256\truecar\tests\Helper;

use Doctrine;
use pdt256\truecar\Lib\DoctrineHelper;
use pdt256\truecar\Lib\FactoryRepository;

abstract class DoctrineTestCase extends \PHPUnit_Framework_TestCase
{
    /** @var Doctrine\ORM\EntityManager */
    protected $entityManager;

    /** @var CountSQLLogger */
    protected $countSQLLogger;

    /** @var DoctrineHelper */
    protected $doctrineHelper;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->setupEntityManager();
    }

    public function setupEntityManager()
    {
        $this->getConnection();
        $this->setupTestSchema();
    }

    private function getConnection()
    {
        $this->doctrineHelper = new DoctrineHelper(new Doctrine\Common\Cache\ArrayCache());
        $this->doctrineHelper->setup([
            'driver' => 'pdo_sqlite',
            'memory' => true,
        ]);

        $this->entityManager = $this->doctrineHelper->getEntityManager();
    }

    private function setupTestSchema()
    {
        $this->entityManager->clear();

        $classes = $this->entityManager->getMetaDataFactory()->getAllMetaData();

        $tool = new Doctrine\ORM\Tools\SchemaTool($this->entityManager);
        // $tool->dropSchema($classes);
        $tool->createSchema($classes);
    }

    public function setEchoLogger()
    {
        $this->setSqlLogger(new Doctrine\DBAL\Logging\EchoSQLLogger);
    }

    public function setCountLogger()
    {
        $this->countSQLLogger = new CountSQLLogger;
        $this->setSqlLogger($this->countSQLLogger);
    }

    private function setSqlLogger(Doctrine\DBAL\Logging\SQLLogger $sqlLogger)
    {
        $this->doctrineHelper->setSQLLogger($sqlLogger);
    }

    protected function getTotalQueries()
    {
        return $this->countSQLLogger->getTotalQueries();
    }

    protected function repository()
    {
        return new FactoryRepository($this->entityManager);
    }

    protected function beginTransaction()
    {
        $this->entityManager->getConnection()->beginTransaction();
    }

    protected function rollback()
    {
        $this->entityManager->getConnection()->rollback();
    }
}
