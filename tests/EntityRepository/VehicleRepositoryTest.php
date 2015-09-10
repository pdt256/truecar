<?php
namespace pdt256\truecar\EntityRepository;

use MyProject\Proxies\__CG__\stdClass;
use pdt256\truecar\Entity\Make;
use pdt256\truecar\Entity\User;
use pdt256\truecar\Entity\Vehicle;
use pdt256\truecar\tests\Helper\DoctrineTestCase;

class VehicleRepositoryTest extends DoctrineTestCase
{
    /** @var VehicleRepositoryInterface */
    protected $vehicleRepository;

    public function setUp()
    {
        $this->vehicleRepository = $this->repository()->getVehicle();
    }

    public function testCRUD()
    {
        $vehicle = $this->setupVehicle();

        $this->assertSame(1, $vehicle->getId());

        $vehicle->setMPG(32);

        $this->assertSame(null, $vehicle->getUpdated());
        $this->vehicleRepository->update($vehicle);
        $this->assertTrue($vehicle->getUpdated() instanceof \DateTime);

        $this->vehicleRepository->delete($vehicle);
        $this->assertSame(null, $vehicle->getId());
    }

    public function testFind()
    {
        $this->setupVehicle();

        $this->setCountLogger();

        $vehicle = $this->vehicleRepository->find(1);

        $vehicle->getMake()->getCreated();
        $vehicle->getUser()->getCreated();

        $this->assertTrue($vehicle instanceof Vehicle);
        $this->assertSame(2, $this->getTotalQueries());
    }

    public function testGetMakeMPGReport()
    {
        $this->setupMPGReportData();

        $this->setCountLogger();

        $mpgReport = $this->vehicleRepository->getMakeMPGReport();

        $this->assertTrue($mpgReport[0]->getMake() instanceof Make);
        $this->assertSame('Ford', $mpgReport[0]->getMake()->getName());
        $this->assertSame(3, $mpgReport[0]->getVehicleCount());
        $this->assertSame(10, $mpgReport[0]->getMinimum());
        $this->assertSame(32, $mpgReport[0]->getMaximum());
        $this->assertEquals(18, $mpgReport[0]->getAverage(), null, FLOAT_DELTA);
    }

    private function setupVehicle()
    {
        $make = $this->getDummyMake();

        $vehicle = $this->getDummyVehicle();
        $vehicle->setMake($make);

        $user = $this->getDummyUser();
        $user->addVehicle($vehicle);

        $this->entityManager->persist($make);
        $this->entityManager->persist($user);

        $this->vehicleRepository->create($vehicle);

        $this->entityManager->clear();

        return $vehicle;
    }

    private function setupMPGReportData()
    {
        $ford = new Make('Ford');

        $vehicle1 = new Vehicle($ford, 10);
        $vehicle2 = new Vehicle($ford, 32);
        $vehicle3 = new Vehicle($ford, 12);

        $chevy = new Make('Chevrolet');

        $vehicle4 = new Vehicle($chevy, 10);
        $vehicle5 = new Vehicle($chevy, 33);

        $this->entityManager->persist($ford);
        $this->entityManager->persist($vehicle1);
        $this->entityManager->persist($vehicle2);
        $this->entityManager->persist($vehicle3);

        $this->entityManager->persist($chevy);
        $this->entityManager->persist($vehicle4);
        $this->entityManager->persist($vehicle5);

        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}
