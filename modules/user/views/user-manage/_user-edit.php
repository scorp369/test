<?php

/**
 * часть страницы с модальным окном редактирования пользователя
 *
 * @var View         $this
 * @var UserEditForm $userEditForm - форма редактирования пользователей
 */

use app\components\mvc\view\View;
use app\modules\user\forms\UserEditForm;
use app\modules\user\UserModule;
use app\rbac\Roles;
use app\widgets\modalWindow\ModalWindow;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$formConfig = [
    'id'                   => 'user-edit-form',
    'action'               => createUrl(UserModule::USER_EDIT),
    'method'               => 'POST',
    'enableAjaxValidation' => true,
];

// список ролей пользователя
$roles = Roles::getLabels();

?>

<!-- виджет модального окна -->
<?= ModalWindow::renderBodyBegin('Редактировать пользователя') ?>

<?php $form = ActiveForm::begin($formConfig) ?>
<div class="panel panel-default">
    <div class="panel-body">

        <!-- идентификатор -->
        <div class="col-xs-1 hidden">
            <?= $form->field($userEditForm, 'id')->input('text') ?>
        </div>

        <!-- логин -->
        <div class="col-xs-2">
            <?= $form->field($userEditForm, 'login')->input('text') ?>
        </div>

        <!-- email -->
        <div class="col-xs-2">
            <?= $form->field($userEditForm, 'email')->input('text') ?>
        </div>

        <!-- пароль -->
        <div class="col-xs-2">
            <?= $form->field($userEditForm, 'password')->input('text') ?>
        </div>

        <!-- флаг активации -->
        <div class="col-xs-2">
            <?= $form->field($userEditForm, 'activated')->checkbox() ?>
        </div>

        <!-- роль -->
        <div class="col-xs-2">
            <?= $form->field($userEditForm, 'role')->dropDownList($roles) ?>
        </div>

        <!-- кнопка submit -->
        <div class="col-xs-2">
            <?= Html::button('изменить', ['class' => 'btn js-user-edit']) ?>
        </div>

    </div>
</div>
<?php $form->end() ?>

<?= ModalWindow::renderBodyEnd() ?>
