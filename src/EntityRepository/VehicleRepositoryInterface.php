<?php
namespace pdt256\truecar\EntityRepository;

use pdt256\truecar\Entity\MPGReport;
use pdt256\truecar\Entity\Vehicle;

interface VehicleRepositoryInterface extends EntityRepositoryInterface
{
    /**
     * @param int $id
     * @return Vehicle
     */
    public function find($id);

    /**
     * @return MPGReport[]
     */
    public function getMakeMPGReport();
}
