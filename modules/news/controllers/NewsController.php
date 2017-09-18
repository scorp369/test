<?php

namespace app\modules\news\controllers;

use app\controllers\SiteController;
use app\modules\news\models\News;
use yii\filters\AccessControl;

/**
 * контроллер новостей
 */
class NewsController extends SiteController
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * отобразить новости
     *
     * @param $newsId - идентификатор новостей
     *
     * @return string
     */
    public function actionView($newsId)
    {
        $news = News::findOne($newsId);

        return $this->render('view', ['news' => $news]);
    }
}