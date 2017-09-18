<?php

namespace app\modules\user\models\register;

use app\modules\user\models\User;
use Webmozart\Assert\Assert;
use yii\helpers\Url;

/**
 * активация пользователя
 */
class UserActivate
{
    /**
     * получить токен активации
     *
     * @return string
     */
    public static function getToken()
    {
        $token = app()->security->generateRandomString(15);

        return $token;
    }

    /**
     * проверить токен активации
     *
     * @param $token - токен
     *
     * @return User|null
     */
    public static function getUserByToken($token)
    {
        $user = User::findOne(['activateToken' => $token]);

        return $user ? $user : null;
    }

    /**
     * получить токен активации
     *
     * @param $userId - идентификатор пользователя
     *
     * @return string
     */
    public static function getUrl($userId)
    {
        $user = User::findOne($userId);
        Assert::notNull($user, 'Пользователь не найден в БД');

        return $user->activateToken ? Url::home('http') . 'register/confirm/' . $user->activateToken : '';
    }

    /**
     * активировать пользователя
     *
     * @param User $user - пользователя для активации
     */
    public static function activateUser($user)
    {
        $user->activated = 1;
        $user->update();
    }
}