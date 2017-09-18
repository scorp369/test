<?php

namespace app\components\mvc\view;

/**
 * класс расширяющий базовый
 */
class View extends \yii\web\View
{
    /**
     * опубликовать и зарегистрировать ассетсы модуля
     *
     * @param array $jsFiles  - список  javascript`ов для регистрации и публикации
     * @param array $cssFiles - список  Cascading Style Sheets (CSS) для регистрации и публикации
     */
    public function registerModuleAssets($jsFiles = [], $cssFiles = [])
    {
        $published = $this->assetManager->publish($this->context->module->getBasePath() . '/assets');
        $basePath  = $published[1] . '/';

        foreach ($jsFiles as $jsFile) {
            $this->registerJsFile($basePath . $jsFile);
        }

        foreach ($cssFiles as $cssFile) {
            $this->registerCssFile($basePath . $cssFile);
        }
    }
}