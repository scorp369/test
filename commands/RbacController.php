<?php

namespace app\commands;

use app\rbac\Permissions;
use app\rbac\Roles;
use app\rbac\UserRoleRule;
use yii\console\Controller;

/*
 * контроллер для создания rbac правил
 */
class RbacController extends Controller
{
    /**
     * инициализировать
     */
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;
        $authManager->removeAll();

        // создание правила
        $rule = new UserRoleRule();

        // создание ролей
        $roles = [];
        foreach (Roles::getList() as $role) {
            $roles                    += [$role => $authManager->createRole($role)];
            $roles[ $role ]->ruleName = $rule->name;
        }

        // создание разрешений
        $permissions = [];
        foreach (Permissions::getList() as $permission) {
            $permissions += [$permission => $authManager->createPermission($permission)];
        }

        // добавить правило
        $authManager->add($rule);

        // добавить роли
        foreach ($roles as $role) {
            $authManager->add($role);
        }

        // добавить разрешения
        foreach ($permissions as $permission) {
            $authManager->add($permission);
        }

        $authManager->addChild($roles[ Roles::MANAGER ], $roles[ Roles::USER ]);
        $authManager->addChild($roles[ Roles::MANAGER ], $permissions[ Permissions::USER_MANAGE ]);
        $authManager->addChild($roles[ Roles::MANAGER ], $permissions[ Permissions::NEWS_MANAGE ]);

        $authManager->addChild($roles[ Roles::ADMIN ], $roles[ Roles::USER ]);
    }
}