<?php
namespace pdt256\truecar\EntityRepository;

use pdt256\truecar\Entity\Make;

interface MakeRepositoryInterface extends EntityRepositoryInterface
{
    /**
     * @param int $id
     * @return Make
     */
    public function find($id);

    /**
     * @param string $email
     * @return Make|null
     */
    public function findOneByName($email);
}
