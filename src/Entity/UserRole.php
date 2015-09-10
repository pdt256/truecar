<?php
namespace pdt256\truecar\Entity;

class UserRole implements EntityInterface
{
    use TimeTrait, IdTrait;

    /** @var string */
    protected $name;

    /** @var string */
    protected $description;

    public function __construct()
    {
        $this->setCreated();
    }

    public function setName($name)
    {
        $this->name = (string) $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
