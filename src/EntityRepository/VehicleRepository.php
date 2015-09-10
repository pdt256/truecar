<?php
namespace pdt256\truecar\EntityRepository;

use pdt256\truecar\Entity\MPGReport;

class VehicleRepository extends AbstractEntityRepository implements VehicleRepositoryInterface
{
    public function getMakeMPGReport()
    {
        $qb = $this->getQueryBuilder();

        $rows = $qb
            ->addSelect('AVG(vehicle.mpg) AS mpg_average')
            ->addSelect('MIN(vehicle.mpg) AS mpg_minimum')
            ->addSelect('MAX(vehicle.mpg) AS mpg_maximum')
            ->addSelect('COUNT(vehicle) AS vehicle_count')
            ->from('truecar:Vehicle', 'vehicle')

            ->from('truecar:Make', 'make')
            ->where('vehicle.make = make')

            ->addSelect('make')
            ->groupBy('make')

            ->getQuery()
            ->getResult();

        $report = [];
        foreach ($rows as $row) {
            $mpgReport = new MPGReport;
            $mpgReport->setMake($row[0]);
            $mpgReport->setAverage($row['mpg_average']);
            $mpgReport->setMinimum($row['mpg_minimum']);
            $mpgReport->setMaximum($row['mpg_maximum']);
            $mpgReport->setVehicleCount($row['vehicle_count']);

            $report[] = $mpgReport;
        }

        return $report;
    }
}
