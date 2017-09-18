<?php

namespace app\rbac;

/**
 * роли пользователя
 */
class Roles
{
    /**
     * администратор
     */
    const ADMIN = 'admin';

    /**
     * менеджер
     */
    const MANAGER = 'manager';

    /**
     * пользователь с минимальными правами
     */
    const USER = 'user';

    /**
     * получить список ролей
     *
     * @return string[]
     */
    public static function getList()
    {
        return [
            self::ADMIN   => self::ADMIN,
            self::MANAGER => self::MANAGER,
            self::USER    => self::USER,
        ];
    }

    /**
     * получить список названий ролей пользователя
     *
     * @return string[]
     */
    public static function getLabels()
    {
        return [
            self::ADMIN   => 'администратор',
            self::MANAGER => 'менеджер',
            self::USER    => 'пользователь',
        ];
    }
}