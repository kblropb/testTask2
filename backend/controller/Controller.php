<?php

namespace backend\controller;

use backend\exception\render\RenderException;

class Controller
{
    const VIEW_PATH = '/../../backend/view/';
    const VIEW_EXT = '.php';

    public $layout = __DIR__ . self::VIEW_PATH . 'layout/base.php';
    public $view;

    /**
     * @param string $view
     * @param array $params
     *
     * @return false|string
     * @throws RenderException
     */
    public function render($view = 'index', $params = [])
    {
        ob_start();

        if (is_array($params)) {
            extract($params);
        }

        if (!file_exists($viewPath = $this->getViewPath($view))) {
            throw new RenderException('View not found "' . $view . '"');
        }
        include($viewPath);
        $viewContent = ob_get_contents();
        ob_end_clean();

        include($this->layout);
        $pageContent = ob_get_contents();



        ob_end_clean();

        return $pageContent;
    }

    /**
     * @param string $view
     *
     * @return string
     */
    private function getViewPath($view = null)
    {
        try {
            $controllerShortName = (new \ReflectionClass($this))->getShortName();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        $controllerFolder = str_replace('controller', '', strtolower($controllerShortName));
        $path = self::VIEW_PATH . $controllerFolder . '/';
        $viewName = $view ? $view . self::VIEW_EXT : 'index.php';

        return __DIR__ . $path . $viewName;
    }
}
