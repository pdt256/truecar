<?php
namespace pdt256\truecar\tests\Fake\EntityRepository;

use pdt256\truecar\Entity\User;
use pdt256\truecar\EntityRepository\UserRepositoryInterface;

class FakeUserRepository extends AbstractFakeRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        $this->setReturnValue(new User);
    }

    public function find($id)
    {
        return $this->getReturnValue();
    }

    public function findOneByEmail($email)
    {
        return $this->getReturnValue();
    }
}
