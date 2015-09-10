<?php
namespace pdt256\truecar\Service;

use pdt256\truecar\Entity\Make;
use pdt256\truecar\Entity\User;
use pdt256\truecar\Entity\Vehicle;
use pdt256\truecar\tests\Fake\EntityRepository\FakeMakeRepository;
use pdt256\truecar\tests\Fake\EntityRepository\FakeUserRepository;
use pdt256\truecar\tests\Fake\EntityRepository\FakeVehicleRepository;
use pdt256\truecar\tests\Helper;

class UserServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserService */
    protected $userService;

    /** @var FakeUserRepository */
    protected $userRepository;

    /** @var FakeMakeRepository */
    protected $makeRepository;

    /** @var FakeVehicleRepository */
    protected $vehicleRepository;

    public function setUp()
    {
        $this->userRepository = new FakeUserRepository;
        $this->makeRepository = new FakeMakeRepository;
        $this->vehicleRepository = new FakeVehicleRepository;
        $this->userService = new UserService($this->userRepository, $this->makeRepository, $this->vehicleRepository);
    }

    public function testLogin()
    {
        $user = $this->getDummyUser();
        $this->userRepository->setReturnValue($user);

        $loginUser = $this->userService->login('test@example.com', 'xxxx');

        $this->assertTrue($loginUser instanceof User);
    }

    /**
     * @expectedException \pdt256\truecar\Service\UserLoginException
     * @expectedExceptionCode 0
     * @expectedExceptionMessage User not found
     */
    public function testUserLoginWithWrongEmail()
    {
        $this->userRepository->setReturnValue(null);
        $this->userService->login('zzz@example.com', 'xxxx');
    }

    /**
     * @expectedException \pdt256\truecar\Service\UserLoginException
     * @expectedExceptionCode 1
     * @expectedExceptionMessage User password not valid
     */
    public function testUserLoginWithWrongPassword()
    {
        $user = $this->getDummyUser();
        $this->userRepository->setReturnValue($user);

        $this->userService->login('test@example.com', 'zzz');
    }

    public function testFind()
    {
        $viewUser = $this->userService->find(1);
        $this->assertTrue($viewUser instanceof User);
    }

    public function testAddVehicle()
    {
        $user = $this->getDummyUser();

        $make = new Make;
        $make->setName('Ford');
        $this->makeRepository->setReturnValue($make);

        $this->userService->addVehicle($user, 'Ford', 25);

        $vehicle = $user->getVehicles()[0];

        $this->assertTrue($vehicle instanceof Vehicle);
        $this->assertSame(25, $vehicle->getMPG());
        $this->assertSame('Ford', $vehicle->getMake()->getName());
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Make not found
     */
    public function testAddVehicleWithMissingMake()
    {
        $user = $this->getDummyUser();
        $this->makeRepository->setReturnValue(null);

        $this->userService->addVehicle($user, 'Chevrolet', 25);
    }

    public function testEditVehicle()
    {
        $user = $this->getDummyUser(1);
        $vehicle = $this->getDummyVehicle();
        $user->addVehicle($vehicle);
        $this->vehicleRepository->setReturnValue($vehicle);

        $newMPG = 28;
        $this->assertNotSame($newMPG, $vehicle->getMPG());

        $vehicle->setMPG($newMPG);
        $this->userService->editVehicle($user, $vehicle);
        $this->assertSame($newMPG, $vehicle->getMPG());
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Invalid User
     */
    public function testEditVehicleFailsSecurity()
    {
        $user = $this->getDummyUser(1);
        $user2 = $this->getDummyUser(2);
        $vehicle = $this->getDummyVehicle();
        $user2->addVehicle($vehicle);

        $this->vehicleRepository->setReturnValue($vehicle);

        $vehicle->setMPG(32);
        $this->userService->editVehicle($user, $vehicle);
    }

    public function testDeleteVehicle()
    {
        $user = $this->getDummyUser(1);
        $vehicle = $this->getDummyVehicle();
        $user->addVehicle($vehicle);
        $this->vehicleRepository->setReturnValue($vehicle);

        $this->userService->deleteVehicle($user, $vehicle);
        $this->assertSame(0, count($user->getVehicles()));
    }
    private function getDummyUser($id = null)
    {
        $user = new User;
        $user->setId($id);
        $user->setEmail('john@example.com');
        $user->setFirstname('John');
        $user->setLastName('Doe');
        $user->setPassword('xxxx');

        return $user;
    }

    private function getDummyVehicle()
    {
        $make = new Make;
        $make->setName('Ford');

        $vehicle = new Vehicle;
        $vehicle->setId(2);
        $vehicle->setMake($make);
        $vehicle->setMPG(25);

        return $vehicle;
    }
}
