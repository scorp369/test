<?php

/**
 * страница создания пользователя
 *
 * @var View             $this
 * @var UserRegisterForm $userRegisterForm - форма создания пользователя
 */

use app\components\mvc\view\View;
use app\modules\user\forms\UserRegisterForm;
use app\modules\user\UserModule;
use app\widgets\modalWindow\ModalWindow;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Создать пользователя';

$formConfig = [
    'id'                   => 'manager-user-register-form',
    'method'               => 'POST',
    'action'               => createUrl(UserModule::USER_CREATE),
    'enableAjaxValidation' => true,
];

?>

<?= Html::button('создать пользователя', ['class' => 'btn js-toggle-modal-window']) ?>

<!-- виджет модального окна -->
<?= ModalWindow::widget() ?>
<?= ModalWindow::renderBodyBegin('Создать пользователя') ?>

<?php $form = ActiveForm::begin($formConfig) ?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- логин -->
        <div class="col-xs-2">
            <?= $form->field($userRegisterForm, 'login')->input('text') ?>
        </div>

        <!-- пароль -->
        <div class="col-xs-2">
            <?= $form->field($userRegisterForm, 'password')->input('text') ?>
        </div>

        <!-- email -->
        <div class="col-xs-2">
            <?= $form->field($userRegisterForm, 'email')->input('text') ?>
        </div>

        <!-- кнопка submit -->
        <div class="col-xs-2">
            <?= Html::submitButton('создать', ['class' => 'btn']) ?>
        </div>

    </div>
</div>
<?php $form->end() ?>

<?= ModalWindow::renderBodyEnd() ?>
