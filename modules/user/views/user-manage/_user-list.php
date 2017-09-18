<?php

/**
 * часть страницы со списком пользователей
 *
 * @var View   $this
 * @var User[] $userList
 */

use app\components\mvc\view\View;
use app\modules\user\models\User;
use app\modules\user\UserModule;
use yii\helpers\Html;

?>

<div class="panel-body">
    <?php if ($userList): ?>
        <table class="table js-user-list-table">
            <thead>
            <tr>
                <th>id</th>
                <th>логин</th>
                <th>email</th>
                <th>дата регистрации</th>
                <th>дата последней авторизации</th>
                <th>роль</th>
                <th>Флаг активации</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userList as $user): ?>
                <tr>
                    <!-- идентификатор -->
                    <td class="js-user-id" data-user-id="<?= $user->id ?>"><?= $user->id ?></td>

                    <!-- логин -->
                    <td class="js-user-login"><?= Html::encode($user->login) ?></td>

                    <!-- email -->
                    <td class="js-user-email"><?= $user->email ?></td>

                    <!-- дата регистрации -->
                    <td><?= $user->createdAt ?></td>

                    <!-- дата крайней аутентификации -->
                    <td><?= $user->lastAuthenticateAt ? $user->lastAuthenticateAt : '-' ?></td>

                    <!-- роль -->
                    <td class="js-user-role"><?= $user->role ?></td>

                    <!-- флаг активации -->
                    <td class="js-user-activated"><?= $user->activated ? 'активирован' : 'не активирован' ?></td>

                    <!-- кнопка открытия модального окна -->
                    <td><?= Html::button('редактировать', ['class' => 'btn js-user-edit-button', 'data' => ['user-edit-url' => createAbsoluteUrl([UserModule::USER_EDIT, 'userId' => $user->id])]]) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p class="caption">Пользователей не найдено</p>
    <?php endif ?>
</div>

