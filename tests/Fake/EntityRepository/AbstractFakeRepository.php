<?php
namespace pdt256\truecar\tests\Fake\EntityRepository;

use pdt256\truecar\Entity;
use pdt256\truecar\Entity\EntityInterface;
use Exception;

class AbstractFakeRepository
{
    /** @var Entity\EntityInterface */
    public $returnValue;

    /** @var Exception|null */
    public $crudExceptionToThrow;

    protected function getReturnValue()
    {
        return $this->returnValue;
    }

    protected function getReturnValueAsArray()
    {
        if ($this->returnValue === null) {
            return [];
        }

        return [$this->returnValue];
    }

    public function setReturnValue(Entity\EntityInterface $returnValue = null)
    {
        $this->returnValue = $returnValue;
    }

    public function setCrudException(Exception $exception)
    {
        $this->crudExceptionToThrow = $exception;
    }

    public function throwCrudExceptionIfSet()
    {
        if ($this->crudExceptionToThrow !== null) {
            throw $this->crudExceptionToThrow;
        }
    }

    public function create(EntityInterface & $entity)
    {
    }

    public function update(EntityInterface & $entity)
    {
    }

    public function delete(EntityInterface $entity)
    {
    }

    public function flush()
    {
    }
}
