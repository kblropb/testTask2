<?php

namespace backend\model\city;

use backend\model\DB;
use PDO;

class CitySearchModel
{
    public function search()
    {
        $db = DB::connect();
        return $db
            ->query('SELECT id, name FROM city')
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}
