<?php
namespace pdt256\truecar\EntityRepository;

use Doctrine;
use Doctrine\ORM\QueryBuilder;
use pdt256\truecar\Entity\EntityInterface;

abstract class AbstractEntityRepository extends Doctrine\ORM\EntityRepository implements EntityRepositoryInterface
{
    public function create(EntityInterface & $entity)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($entity);
        $entityManager->flush();
    }

    public function update(EntityInterface & $entity)
    {
        $entityManager = $this->getEntityManager();
        $entity = $entityManager->merge($entity);
        $entityManager->flush();
    }

    public function delete(EntityInterface $entity)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($entity);
        $entityManager->flush();
    }

    public function getQueryBuilder()
    {
        return new QueryBuilder($this->getEntityManager());
    }
}
