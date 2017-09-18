<?php

namespace app\rbac;

/**
 * разрешения
 */
class Permissions
{
    /**
     * редактирование пользователей
     */
    const USER_MANAGE = 'user_manage';

    /**
     * редактирование новостей
     */
    const NEWS_MANAGE = 'news_manage';

    /**
     * получить список
     *
     * @return string[]
     */
    public static function getList()
    {
        return [
            self::USER_MANAGE => self::USER_MANAGE,
            self::NEWS_MANAGE => self::NEWS_MANAGE,
        ];
    }

    /**
     * получить список названий
     *
     * @return string[]
     */
    public static function getLabels()
    {
        return [
            self::USER_MANAGE => 'редактирование пользователей',
            self::NEWS_MANAGE => 'редактирование новостей',
        ];
    }
}