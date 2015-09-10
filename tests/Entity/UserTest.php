<?php
namespace pdt256\truecar\Entity;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $user = new User;
        $user->setId(1);
        $user->setEmail('test@example.com');
        $user->setPassword('xxxx');
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->addRole(new UserRole);
        $user->addVehicle(new Vehicle);

        $this->assertSame(null, $user->getUpdated());

        $user->setUpdated();
        $user->preUpdate();

        $this->assertSame(1, $user->getId());
        $this->assertTrue($user->getCreated() instanceof \DateTime);
        $this->assertTrue($user->getUpdated() instanceof \DateTime);
        $this->assertSame('test@example.com', $user->getEmail());
        $this->assertSame('John', $user->getFirstName());
        $this->assertSame('Doe', $user->getLastName());
        $this->assertTrue($user->getRoles()[0] instanceof UserRole);
        $this->assertTrue($user->getVehicles()[0] instanceof Vehicle);
    }

    public function testSetPasswordEmpty()
    {
        $user = new User;
        $user->setPassword();
    }

    public function testVerifyPassword()
    {
        $user = new User;
        $user->setPassword('qwerty');
        $this->assertTrue($user->verifyPassword('qwerty'));
        $this->assertFalse($user->verifyPassword('wrong'));
    }

    public function testHasRoles()
    {
        $adminRole = new UserRole;
        $adminRole->setName('admin');

        $user = new User;
        $user->addRole($adminRole);

        $this->assertTrue($user->hasRoles(['admin']));
        $this->assertFalse($user->hasRoles(['developer']));
    }
}
