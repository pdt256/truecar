<?php
namespace pdt256\truecar\Entity;

trait IdTrait
{
    /** @var int */
    protected $id;

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
