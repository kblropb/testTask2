<?php

namespace backend\model\visitor;

use backend\model\DB;
use PDO;

class VisitorSearchModel
{

    const AVAILABLE_ORDER_FIELDS = [
        'clientName',
        'clientCity',
        'numberOfVisits',
        'lastVisitDate',
        'lastVisitedCity'
    ];

    const AVAILABLE_ORDER_DIRS = [
        'ASC',
        'DESC'
    ];

    const DEFAULT_ORDER_BY = 'clientName';
    const DEFAULT_ORDER_DIR = 'ASC';

    /**
     * @param VisitsFilterDTO $visitsFilterDTO
     *
     * @return array
     */
    public function search($visitsFilterDTO)
    {
        $db = DB::connect();

        $sth = $db->prepare('SELECT 
                    cl.name AS clientName
                    ,clc.name AS clientCity
                    ,clc.id AS clientCityId
                    ,cld.name AS clientDistrict
                    ,nov.numberOfVisits 
                    , MAX(clv.visit_date) AS lastVisitDate
                    ,clvc.name AS lastVisitedCity
                    ,clvc.id AS lastVisitedCityId
                    ,clvd.name AS lastVisitedDistrict
                FROM client_visit AS clv
                LEFT JOIN `client` AS cl ON clv.`client` = cl.id
                LEFT JOIN city AS clc ON clc.id = cl.city
                LEFT JOIN district AS cld ON cld.id = clc.district
                  
                LEFT JOIN city AS clvc ON clvc.id = clv.city
                LEFT JOIN district AS clvd ON clvd.id = clvc.district
                
                LEFT JOIN (
                SELECT COUNT(*) AS numberOfVisits, clvn.`client`
                FROM client_visit as clvn WHERE clvn.visit_date > :clvnDateFrom AND clvn.visit_date < :clvnDateTo
                GROUP BY clvn.`client`) AS nov ON nov.client = cl.id

                WHERE clv.visit_date >= :dateFrom AND clv.visit_date <= :dateTo'

            . $this->compileFilterConditions($visitsFilterDTO) .

            ' GROUP BY cl.name' . $this->compileFilterOrderBy($visitsFilterDTO));

        $sth->bindValue(':clvnDateFrom', $visitsFilterDTO->getDateFrom(), PDO::PARAM_STR);
        $sth->bindValue(':clvnDateTo', $visitsFilterDTO->getDateTo(), PDO::PARAM_STR);
        $sth->bindValue(':dateFrom', $visitsFilterDTO->getDateFrom(), PDO::PARAM_STR);
        $sth->bindValue(':dateTo', $visitsFilterDTO->getDateTo(), PDO::PARAM_STR);

        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param VisitsFilterDTO $visitsFilterDTO
     *
     * @return string
     */
    protected function compileFilterConditions($visitsFilterDTO)
    {
        $filterConditions = '';
        if (!empty($clientCities = $visitsFilterDTO->getClientCities())) {
            $filterConditions .= ' AND clc.id IN (' . implode(',', $clientCities) . ')';
        }

        if (!empty($visitedCities = $visitsFilterDTO->getVisitedCities())) {
            $filterConditions .= ' AND clvc.id IN (' . implode(',', $visitedCities) . ')';
        }

        if ($name = $visitsFilterDTO->getName()) {
            $filterConditions .= ' AND cl.name = ' . $name;
        }
        return $filterConditions;
    }

    /**
     * @param VisitsFilterDTO $visitsFilterDTO
     *
     * @return string
     */
    protected function compileFilterOrderBy($visitsFilterDTO)
    {
        $orderBy = in_array($visitsFilterDTO->getOrderBy(), self::AVAILABLE_ORDER_FIELDS)
            ? $visitsFilterDTO->getOrderBy()
            : self::DEFAULT_ORDER_BY;
        $orderDir = in_array(strtoupper($visitsFilterDTO->getOrderDir()), self::AVAILABLE_ORDER_DIRS)
            ? $visitsFilterDTO->getOrderDir()
            : self::DEFAULT_ORDER_DIR;

        $filterOrderBy = ' ORDER BY ' . $orderBy . ' ' . $orderDir;
        return $filterOrderBy;
    }

}