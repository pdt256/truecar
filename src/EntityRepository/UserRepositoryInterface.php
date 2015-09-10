<?php
namespace pdt256\truecar\EntityRepository;

use pdt256\truecar\Entity\User;

interface UserRepositoryInterface extends EntityRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function find($id);

    /**
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail($email);
}
