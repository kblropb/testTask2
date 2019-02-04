<?php

namespace backend\model\visitor;

class VisitsFilterDTO
{
    /** @var string */
    private $name;
    /** @var int[] */
    private $clientCities = [];
    /** @var string */
    private $dateFrom;
    /** @var string */
    private $dateTo;
    /** @var int[] */
    private $visitedCities = [];
    /** @var string */
    private $orderBy;
    /** @var string */
    private $orderDir;

    /**
     * @param array $params
     * @return VisitsFilterDTO
     */
    public function fromArray($params = [])
    {
        $props = get_object_vars($this);
        foreach ($props as $name => $value) {
            if (array_key_exists($name, $params)) {
                $this->$name = $params[$name];
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @return string
     */
    public function getOrderDir()
    {
        return $this->orderDir;
    }

    /**
     * @return int[]
     */
    public function getClientCities()
    {
        return array_map('intval', $this->clientCities);
    }

    /**
     * @return int[]
     */
    public function getVisitedCities()
    {
        return array_map('intval', $this->visitedCities);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDateFrom()
    {
        return $this->dateFrom ? $this->dateFrom : $this->getYearAgoDate();
    }

    /**
     * @return string
     */
    public function getDateTo()
    {
        return $this->dateTo ? $this->dateTo : gmdate('Y-m-d H:i:s');
    }

    private function getYearAgoDate()
    {
        return (new \DateTime())
            ->setTimestamp(time())
            ->setTimezone(new \DateTimeZone('UTC'))
            ->modify('-10 year')
            ->format('Y-m-d H:i:s');
    }
}
