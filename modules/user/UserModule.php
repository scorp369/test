<?php

namespace app\modules\user;

use yii\base\Module;

/**
 * модуль пользователей
 */
class UserModule extends Module
{
    /** действия пользователя */
    const USER_REGISTER = 'user/user/register';
    const USER_CONFIRM = 'user/user/confirm';
    const USER_LOGIN = 'user/user/login';
    const USER_LOGOUT = 'user/user/logout';

    /** управление пользователями */
    const USER_LIST = 'user/user-manage/list';
    const USER_EDIT = 'user/user-manage/edit';
    const USER_CREATE = 'user/user-manage/create';

    /**
     * получить маршруты этого модуля
     */
    public function getUrlRules()
    {
        return [
            // действия пользователя
            '/register'                               => self::USER_REGISTER,
            '/register/confirm/<activateToken:[^/]*>' => self::USER_CONFIRM,
            '/login'                                  => self::USER_LOGIN,
            '/logout'                                 => self::USER_LOGOUT,

            // управление пользователями
            '/user/list'                              => self::USER_LIST,
            '/user/<userId:\d+>/edit'                 => self::USER_EDIT,
            '/user/edit'                              => self::USER_EDIT,
            '/user/create'                            => self::USER_CREATE,
        ];
    }
}