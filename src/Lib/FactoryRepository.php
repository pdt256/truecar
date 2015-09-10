<?php
namespace pdt256\truecar\Lib;

use Doctrine\ORM\EntityManager;
use pdt256\truecar\EntityRepository\UserRepositoryInterface;

class FactoryRepository
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return UserRepositoryInterface
     */
    public function getUser()
    {
        return $this->entityManager->getRepository('truecar:User');
    }
}
