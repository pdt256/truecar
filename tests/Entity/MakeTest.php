<?php
namespace pdt256\truecar\Entity;

class MakeTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $make = new Make;
        $make->setName('Ford');

        $this->assertSame('Ford', $make->getName());
    }
}
