<?php

namespace app\modules\user\controllers;

use app\controllers\SiteController;
use app\modules\user\forms\UserEditForm;
use app\modules\user\forms\UserRegisterForm;
use app\modules\user\models\filter\UserFilter;
use app\modules\user\models\User;
use app\modules\user\UserModule;
use app\rbac\Permissions;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * контроллер для управления пользователями
 */
class UserManageController extends SiteController
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['list', 'edit', 'create'],
                        'allow'   => true,
                        'roles'   => [Permissions::USER_MANAGE],
                    ],
                ],
            ],
        ];
    }

    /**
     * список пользователей
     */
    public function actionList()
    {
        $userFilter = new UserFilter();
        $userFilter->load(app()->request->get());

        $userEditForm = new UserEditForm();

        $userList = $userFilter->getFiltered();

        return $this->render('list', ['userList' => $userList, 'userFilter' => $userFilter, 'userEditForm' => $userEditForm]);
    }

    /**
     * создать
     */
    public function actionCreate()
    {
        $userRegisterForm = new UserRegisterForm();

        // ajax валидация
        if (app()->request->isAjax && $userRegisterForm->load(app()->request->post())) {
            return $this->asJson(ActiveForm::validate($userRegisterForm));
        }

        // сохранение пользователя
        if ($userRegisterForm->load(app()->request->post()) && $userRegisterForm->save()) {
            return $this->redirect(createUrl(UserModule::USER_CREATE));
        }

        return $this->render('user-create', ['userRegisterForm' => $userRegisterForm]);
    }

    /**
     * редактировать
     *
     * @param $userId - идентификатор пользователя
     *
     * @return array|Response
     */
    public function actionEdit($userId = null)
    {
        if ($userId && $user = User::findOne($userId)) {
            return $this->asJson(['id' => $userId, 'login' => $user->login, 'email' => $user->email, 'activated' => $user->activated, 'role' => $user->role]);
        }

        $userEditForm = new UserEditForm;
        $userEditForm->load(app()->request->post());

        if ($userEditForm->validate()) {
            $userEditForm->updateUser();
        }

        return $this->asJson(ActiveForm::validate($userEditForm));
    }
}