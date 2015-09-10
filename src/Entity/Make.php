<?php
namespace pdt256\truecar\Entity;

class Make implements EntityInterface
{
    use TimeTrait, IdTrait;

    /** @var string */
    protected $name;

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
