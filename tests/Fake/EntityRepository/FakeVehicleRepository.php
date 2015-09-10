<?php
namespace pdt256\truecar\tests\Fake\EntityRepository;

use pdt256\truecar\Entity\MPGReport;
use pdt256\truecar\Entity\Vehicle;
use pdt256\truecar\EntityRepository\VehicleRepositoryInterface;

class FakeVehicleRepository extends AbstractFakeRepository implements VehicleRepositoryInterface
{
    public function __construct()
    {
        $this->setReturnValue(new Vehicle);
    }

    public function find($id)
    {
        return $this->getReturnValue();
    }

    public function getMakeMPGReport()
    {
        return [new MPGReport];
    }
}
