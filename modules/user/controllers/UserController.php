<?php

namespace app\modules\user\controllers;

use app\controllers\SiteController;
use app\modules\user\forms\UserLoginForm;
use app\modules\user\forms\UserRegisterForm;
use app\modules\user\models\register\UserActivate;

/**
 * контроллер пользователей
 */
class UserController extends SiteController
{
    /**
     * зарегистрировать пользователя
     */
    public function actionRegister()
    {
        $userRegisterForm = new UserRegisterForm();

        if ($userRegisterForm->load(app()->request->post()) && $userRegisterForm->validate()) {
            $userRegisterForm->save();

            return $this->render('email-confirm');
        }

        return $this->render('register', ['userRegisterForm' => $userRegisterForm]);
    }

    /**
     * зарегистрировать пользователя
     *
     * @param $activateToken - токен активации пользователя
     *
     * @return string
     */
    public function actionConfirm($activateToken)
    {
        if ($user = UserActivate::getUserByToken($activateToken)) {
            UserActivate::activateUser($user);

            app()->user->login($user);

            return $this->render('user-activated');
        }

        return $this->goHome();
    }

    /**
     * авторизовать пользователя
     */
    public function actionLogin()
    {
        $userLoginForm = new UserLoginForm();

        if ($userLoginForm->load(app()->request->post())
            && $userLoginForm->validate()
            && $userLoginForm->login()) {
            $this->goHome();
        }

        return $this->render('login', ['userLoginForm' => $userLoginForm]);
    }

    /**
     * разавторизовать пользователя
     */
    public function actionLogout()
    {
        if (!app()->user->isGuest) {
            app()->user->logout();
        }

        return $this->goHome();
    }

}