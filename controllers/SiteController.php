<?php

namespace app\controllers;

use app\modules\news\models\filter\NewsFilter;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $newsFilter = new NewsFilter(['state' => 1]);
        $newsFilter->page = app()->request->get('page');
        $newsFilter->load(app()->request->get());

        $newsList = $newsFilter->getFiltered();

        return $this->render('index', ['newsList' => $newsList, 'newsFilter' => $newsFilter]);
    }
}
