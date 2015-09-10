<?php
namespace pdt256\truecar\Entity;

class Vehicle implements EntityInterface
{
    use TimeTrait, IdTrait;

    /** @var User */
    protected $user;

    /** @var Make */
    protected $make;

    /** @var int */
    protected $mpg;

    public function __construct($make = null, $mpg = null)
    {
        $this->setCreated();

        if ($make !== null) {
            $this->setMake($make);
        }

        if ($mpg !== null) {
            $this->setMPG($mpg);
        }
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getMake()
    {
        return $this->make;
    }

    public function setMake(Make $make)
    {
        $this->make = $make;
    }

    /**
     * @param int $mpg
     */
    public function setMPG($mpg)
    {
        $this->mpg = (int) $mpg;
    }

    public function getMPG()
    {
        return $this->mpg;
    }
}
