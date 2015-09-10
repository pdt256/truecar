<?php
namespace pdt256\truecar\EntityRepository;

use pdt256\truecar\Entity\EntityInterface;

interface EntityRepositoryInterface
{
    public function create(EntityInterface & $entity);
    public function update(EntityInterface & $entity);
    public function delete(EntityInterface $entity);
}
