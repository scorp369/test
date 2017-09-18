<?php

namespace app\rbac;

use yii\rbac\Rule;

/**
 * правило для проверки соответствия ролей пользователя с ролями заданными по-умолчанию
 */
class UserRoleRule extends Rule
{
    /** @inheritdoc */
    public $name = 'userGroup';

    /** @inheritdoc */
    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {

            $role = \Yii::$app->user->identity->role;

            // админ
            if ($item->name === Roles::ADMIN) {
                return $role == Roles::ADMIN;
            }

            // менеджер
            if ($item->name === Roles::MANAGER) {
                return $role == Roles::ADMIN || $role == Roles::MANAGER;
            }

            // пользователь
            if ($item->name === Roles::USER) {
                return $role == Roles::ADMIN || $role == Roles::MANAGER || $role == Roles::USER;
            }
        }

        return false;
    }
}
