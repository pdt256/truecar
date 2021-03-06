<?php
namespace pdt256\truecar\EntityRepository;

use pdt256\truecar\DataStructure\Report\MPGReport;

class VehicleRepository extends AbstractEntityRepository implements VehicleRepositoryInterface
{
    public function getMakeMPGReport()
    {
        $qb = $this->getQueryBuilder();

        $rows = $qb
            ->select('make')
            ->addSelect('AVG(vehicle.mpg) AS mpg_average')
            ->addSelect('MIN(vehicle.mpg) AS mpg_minimum')
            ->addSelect('MAX(vehicle.mpg) AS mpg_maximum')
            ->addSelect('COUNT(vehicle) AS vehicle_count')

            ->from('truecar:Make', 'make')
            ->innerJoin('make.vehicles', 'vehicle')
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
