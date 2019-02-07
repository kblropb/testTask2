<?php

namespace backend\controller\visitor;

use backend\controller\Controller;
use backend\exception\render\RenderException;
use backend\model\city\CitySearchModel;
use backend\model\visitor\VisitorSearchModel;
use backend\model\visitor\VisitsFilterDTO;

class VisitorController extends Controller
{
    /**
     * @return string
     * @throws RenderException
     */
    public function actionIndex()
    {
        $dto = (new VisitsFilterDTO())->fromArray($_GET);
        $searchModel = new VisitorSearchModel();
        $visits = $searchModel->search($dto);

        return $this->render('', [
            'visits' => $visits,
            'clientCities' => $this->getCities()
        ]);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function actionGetList($params = [])
    {
        $searchModel = new VisitorSearchModel();
        $visits = $searchModel->search($this->createDTO($params));

        return json_encode($visits, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $params
     *
     * @return VisitsFilterDTO
     */
    private function createDTO($params)
    {
        $params['clientCities'] = array_filter($params['clientCities']);
        $params['visitedCities'] = array_filter($params['visitedCities']);
        $dto = (new VisitsFilterDTO())->fromArray(array_filter($params));

        return $dto;
    }
    /**
     * @return array
     */
    private function getCities()
    {
        return (new CitySearchModel)->search();
    }
}