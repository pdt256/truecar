<?php
namespace pdt256\truecar\EntityRepository;

use pdt256\truecar\Entity\User;
use pdt256\truecar\tests\Helper;

class UserRepositoryTest extends Helper\DoctrineTestCase
{
    /** @var UserRepositoryInterface */
    protected $userRepository;

    public function setUp()
    {
        $this->userRepository = $this->repository()->getUser();
    }

    public function testCRUD()
    {
        $user = $this->setupUser();

        $this->assertSame(1, $user->getId());

        $user->setFirstName('James');

        $this->assertSame(null, $user->getUpdated());
        $this->userRepository->update($user);
        $this->assertTrue($user->getUpdated() instanceof \DateTime);

        $this->userRepository->delete($user);
        $this->assertSame(null, $user->getId());
    }

    public function testFind()
    {
        $this->setupUser();

        $this->setCountLogger();

        $user = $this->userRepository->find(1);

        $user->getRoles()->toArray();
        $user->getVehicles()->toArray();

        $this->assertTrue($user instanceof User);
        $this->assertSame(3, $this->getTotalQueries());
    }

    public function testFindByEmail()
    {
        $this->setupUser();

        $this->setCountLogger();

        $user = $this->userRepository->findOneByEmail('john@example.com');

        $user->getRoles()->toArray();

        $this->assertTrue($user instanceof User);
        $this->assertSame(1, $this->getTotalQueries());
    }

    public function testFindByEmailMissing()
    {
        $this->setupUser();
        $user = $this->userRepository->findOneByEmail('james@example.com');
        $this->assertSame(null, $user);
    }

    private function setupUser()
    {
        $user = new User;
        $user->setEmail('john@example.com');
        $user->setFirstname('John');
        $user->setLastName('Doe');

        $this->userRepository->create($user);

        $this->entityManager->clear();

        return $user;
    }
}
