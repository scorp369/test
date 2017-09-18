<?php

namespace app\models;

/**
 * Отправка email
 */
class EmailSend
{
    static $EMAIL_FROM = 'scorp36912@yandex.ru';

    /**
     * отрпавить письмо
     *
     * @param $email        - адрес почты для отправки письма
     * @param $emailSubject - тема письма
     * @param $message      - сообщение письма в формате html
     *
     * @return bool
     */
    public static function send($email, $emailSubject, $message)
    {
        $mailer = app()->mailer->compose();
        $mailer->setFrom(static::$EMAIL_FROM)
            ->setTo($email)
            ->setSubject($emailSubject)
            ->setHtmlBody($message);

        if (!$mailer->send()) {
            return false;
        }

        return true;
    }
}