<?php
namespace pdt256\truecar\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Make implements EntityInterface
{
    use TimeTrait, IdTrait;

    /** @var string */
    protected $name;

    /** @var Vehicle[] */
    protected $vehicles;

    public function __construct($name = null)
    {
        $this->setCreated();
        $this->setname($name);
        $this->vehicles = new ArrayCollection;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }
}
