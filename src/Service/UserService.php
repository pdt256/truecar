<?php
namespace pdt256\truecar\Service;

use pdt256\truecar\Entity\User;
use pdt256\truecar\Entity\Vehicle;
use pdt256\truecar\EntityRepository\MakeRepositoryInterface;
use pdt256\truecar\EntityRepository\UserRepositoryInterface;
use pdt256\truecar\EntityRepository\VehicleRepositoryInterface;

class UserService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var MakeRepositoryInterface */
    private $makeRepository;

    /** @var VehicleRepositoryInterface */
    private $vehicleRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        MakeRepositoryInterface $makeRepository,
        VehicleRepositoryInterface $vehicleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->makeRepository = $makeRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return User
     * @throws UserLoginException
     */
    public function login($email, $password)
    {
        $user = $this->userRepository->findOneByEmail($email);

        if ($user === null) {
            throw UserLoginException::userNotFound();
        }

        if (! $user->verifyPassword($password)) {
            throw UserLoginException::invalidPassword();
        }

        return $user;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param User $user
     * @param string $makeName
     * @param int $mpg
     */
    public function addVehicle(User & $user, $makeName, $mpg)
    {
        $make = $this->getMakeAndThrowExceptionIfNotFound($makeName);

        $vehicle = new Vehicle;
        $vehicle->setMake($make);
        $vehicle->setMPG($mpg);

        $user->addVehicle($vehicle);

        $this->vehicleRepository->create($vehicle);
    }

    public function editVehicle(User $user, Vehicle & $vehicle)
    {
        $this->validateUser($user, $vehicle);
        $this->vehicleRepository->update($vehicle);
    }

    public function deleteVehicle(User & $user, Vehicle $vehicle)
    {
        $this->validateUser($user, $vehicle);
        $user->removeVehicle($vehicle);
        $this->userRepository->update($user);
    }

    private function getMakeAndThrowExceptionIfNotFound($makeName)
    {
        $make = $this->makeRepository->findOneByName($makeName);

        if ($make === null) {
            throw new \LogicException('Make not found');
        }

        return $make;
    }

    private function validateUser(User $user, Vehicle $vehicle)
    {
        $serverVehicle = $this->vehicleRepository->find($vehicle->getId());

        if ($user->getId() !== $serverVehicle->getUser()->getId()) {
            throw new \LogicException('Invalid User');
        }
    }
}
