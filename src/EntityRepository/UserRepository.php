<?php
namespace pdt256\truecar\EntityRepository;

use pdt256\truecar\Entity;

class UserRepository extends AbstractEntityRepository implements UserRepositoryInterface
{
    public function findOneByEmail($email)
    {
        $qb = $this->getQueryBuilder();

        $user = $qb
            ->select('user')
            ->from('truecar:User', 'user')

            ->addSelect('userRole')
            ->leftJoin('user.roles', 'userRole')

            ->where('user.email = :email')->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();

        return $user;
    }
}
