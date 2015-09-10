<?php
namespace pdt256\truecar\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class User implements EntityInterface
{
    use TimeTrait, IdTrait;

    /** @var string */
    protected $email;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $firstName;

    /** @var string */
    protected $lastName;

    /** @var UserRole[]|ArrayCollection */
    protected $roles;

    /** @var Vehicle[]|ArrayCollection */
    protected $vehicles;

    public function __construct()
    {
        $this->setCreated();
        $this->roles = new ArrayCollection;
        $this->vehicles = new ArrayCollection;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password = null)
    {
        if (empty($password)) {
            $password = uniqid();
        }

        $this->passwordHash = password_hash((string) $password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->passwordHash);
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function addRole(UserRole $role)
    {
        $this->roles[] = $role;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function hasRoles(array $roleNames)
    {
        $userRoles = [];
        foreach ($this->roles as $role) {
            $userRoles[$role->getName()] = true;
        }

        foreach ($roleNames as $roleName) {
            if (! isset($userRoles[$roleName])) {
                return false;
            }
        }

        return true;
    }

    public function addVehicle(Vehicle $vehicle)
    {
        $vehicle->setUser($this);
        $this->vehicles[] = $vehicle;
    }

    public function getVehicles()
    {
        return $this->vehicles;
    }

    public function removeVehicle(Vehicle $vehicle)
    {
        return $this->vehicles->removeElement($vehicle);
    }
}
