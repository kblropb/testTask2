<?php

namespace backend\controller\visitor;

use backend\controller\Controller;
use backend\exception\render\RenderException;
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

        return $this->render('', ['visits' => $visits]);
    }
}