<?php
namespace pdt256\truecar\Entity;

class UserRoleTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $userRole = new UserRole;
        $userRole->setName('Administrator');
        $userRole->setDescription('Admin account with access to everything.');

        $this->assertSame('Administrator', $userRole->getName());
        $this->assertSame('Admin account with access to everything.', $userRole->getDescription());
    }
}
