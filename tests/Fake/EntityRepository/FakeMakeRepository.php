<?php
namespace pdt256\truecar\tests\Fake\EntityRepository;

use pdt256\truecar\Entity\Make;
use pdt256\truecar\EntityRepository\MakeRepositoryInterface;

class FakeMakeRepository extends AbstractFakeRepository implements MakeRepositoryInterface
{
    public function __construct()
    {
        $this->setReturnValue(new Make);
    }

    public function find($id)
    {
        return $this->getReturnValue();
    }

    public function findOneByName($makeName)
    {
        return $this->getReturnValue();
    }
}
