<?php

namespace app\widgets;

use yii\bootstrap\Widget;

/**
 * виджет модуля
 */
class ModuleWidget extends Widget
{
    /**
     * опубликовать и зарегистрировать асетсы виджета
     *
     * @param array $jsFiles  - список  javascript`ов для регистрации и публикации
     * @param array $cssFiles - список  Cascading Style Sheets (CSS) для регистрации и публикации
     */
    public function registerWidgetAssets($jsFiles = [], $cssFiles = [])
    {
        $published = app()->assetManager->publish($this->getAssetsPath());
        $basePath  = $published[1] . '/';

        foreach ($jsFiles as $jsFile) {
            $this->view->registerJsFile($basePath . $jsFile);
        }

        foreach ($cssFiles as $cssFile) {
            $this->view->registerCssFile($basePath . $cssFile);
        }
    }

    /**
     * получить полный путь до директории с ассетсами виджета
     *
     * @return string
     */
    public function getAssetsPath()
    {
        $class = new \ReflectionClass($this);

        return dirname($class->getFileName()) . DIRECTORY_SEPARATOR . 'assets';
    }
}