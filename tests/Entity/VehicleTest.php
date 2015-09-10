<?php
namespace pdt256\truecar\Entity;

class VehicleTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $vehicle = new Vehicle;
        $vehicle->setMPG(25);
        $vehicle->setUser(new User);
        $vehicle->setMake(new Make);

        $this->assertSame(25, $vehicle->getMPG());
        $this->assertTrue($vehicle->getUser() instanceof User);
        $this->assertTrue($vehicle->getMake() instanceof Make);
    }
}
