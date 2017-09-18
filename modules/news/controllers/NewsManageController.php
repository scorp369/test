<?php

namespace app\modules\news\controllers;

use app\modules\news\forms\NewsEditForm;
use app\modules\news\models\filter\NewsFilter;
use app\modules\news\models\News;
use app\modules\news\models\NewsPicture;
use app\modules\news\NewsModule;
use app\rbac\Permissions;
use Webmozart\Assert\Assert;
use yii\base\Response;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * контроллер управления новостями
 */
class NewsManageController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['list', 'create', 'edit', 'change-state'],
                        'allow'   => true,
                        'roles'   => [Permissions::NEWS_MANAGE],
                    ],
                ],
            ],
        ];
    }

    /**
     * список новостей
     */
    public function actionList()
    {
        $newsFilter = new NewsFilter();
        $newsFilter->load(app()->request->get());

        $newsList = $newsFilter->getFiltered();

        $newsEditForm = new NewsEditForm();

        return $this->render('list', ['newsList' => $newsList, 'newsFilter' => $newsFilter, 'newsEditForm' => $newsEditForm]);
    }

    /**
     * создать
     */
    public function actionCreate()
    {
        $news = new News();

        // ajax валидация
        if (app()->request->isAjax && $news->load(app()->request->post())) {
            return $this->asJson(ActiveForm::validate($news));
        }

        // сохранение новости
        if ($news->load(app()->request->post()) && $news->validate()) {
            $news->save();

            $file = UploadedFile::getInstance($news, 'pictureFile');
            if ($file) {
                $newsPicture = new NewsPicture();

                $news->pictureFile = $newsPicture->save($file, $news)->getPath();
                $news->update();
            }

            return $this->redirect(createUrl(NewsModule::NEWS_CREATE));
        }

        return $this->render('news-create', ['newsCreateForm' => $news]);
    }

    /**
     * редактировать
     *
     * @param $newsId - идентификатор новости
     *
     * @return array|Response
     */
    public function actionEdit($newsId = null)
    {
        if (app()->request->isAjax && $newsId && $news = News::findOne($newsId)) {
            return $this->asJson(['id' => $news->id, 'name' => $news->name, 'description' => $news->description, 'state' => $news->state]);
        }

        $newsEditForm = new NewsEditForm();
        $newsEditForm->load(app()->request->post());

        // редактирование менеджером только свои новости
        if (app()->user->identity->role == 'manager' && $news = News::findOne($newsEditForm->id)) {
            if (!(app()->user->identity->id == $news->userId)) {
                return $this->redirect(createUrl(NewsModule::NEWS_LIST));
            } else {
                app()->session->addFlash('error', 'У вас нет разрешений редактировать не свои новости');

                return $this->redirect(createUrl(NewsModule::NEWS_LIST));
            }
        }

        if (!app()->request->isAjax && $newsEditForm->validate() && $newsEditForm->updateNews()) {
            return $this->redirect(createUrl(NewsModule::NEWS_LIST));
        }

        return $this->asJson(ActiveForm::validate($newsEditForm));
    }

    /**
     * изменить статус активности
     *
     * @param $newsId - идентификатор новости
     *
     * @return \yii\web\Response
     */
    public function actionChangeState($newsId)
    {
        $news = News::findOne($newsId);
        Assert::notNull($news, 'Новости не найдены');

        $news->state = $news->state ? 0 : 1;

        if ($news->update()) {
            return $this->asJson($news->state);
        }
    }
}