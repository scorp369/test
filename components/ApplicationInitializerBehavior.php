<?php

namespace app\components;

use app\modules\news\NewsModule;
use app\modules\user\UserModule;
use yii\base\Application;
use yii\base\Behavior;

/**
 * поведение инициализации всех активных модулей до запуска приложения
 */
class ApplicationInitializerBehavior extends Behavior
{
    /** @inheritdoc */
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest',
        ];
    }

    public function beforeRequest()
    {
        $this->enableModule('user', UserModule::className());
        $this->enableModule('news', NewsModule::className());
    }

    /**
     * @param string $className
     */
    private function enableModule($id, $className)
    {
        $this->enableModuleUrlRules($className);
    }

    /**
     * @param string $className
     */
    private function enableModuleUrlRules($className)
    {
        app()->urlManager->addRules($className::getUrlRules());
    }
}