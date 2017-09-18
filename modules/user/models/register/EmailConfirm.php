<?php

namespace app\modules\user\models\register;

use app\models\EmailSend;
use yii\helpers\Url;

/**
 * подтверждение email
 */
class EmailConfirm
{
    /**
     * отправить письмо активации пользователя
     *
     * @param $email - email
     * @param $userId
     */
    public static function sendUserActivationEmail($email, $userId)
    {
        $emailSubject = 'Регистрация на сайте ' . Url::home('http');
        $message      = /** @lang HTML */
            'Здравствуйте, ваш адрес электронной почты был указан при регистрации на сайте <a href="' . Url::home('http') . '">' . Url::home('http') . '</a>,
            для завершения регистрации перейдите по <a href="' . UserActivate::getUrl($userId) . '">ссылке</a>';

        EmailSend::send($email, $emailSubject, $message);
    }
}