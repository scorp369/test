<?php

/**
 * страница аутентификации пользователя
 *
 * @var View          $this
 * @var UserLoginForm $userLoginForm - форма пользователя
 */

use app\modules\user\forms\UserLoginForm;
use yii\helpers\Html;
use app\components\mvc\view\View;
use yii\widgets\ActiveForm;

$formConfig = [
    'id'     => 'user-login-form',
    'action' => \yii\helpers\Url::to('/login'),
    'method' => 'POST',
]

?>

<?php $form = ActiveForm::begin($formConfig) ?>

<div class="row">

    <!-- логин -->
    <div class="col-xs-12">
        <?= $form->field($userLoginForm, 'login')->input('text') ?>
    </div>

    <!-- пароль -->
    <div class="col-xs-12">
        <?= $form->field($userLoginForm, 'password')->input('password') ?>
    </div>

    <?= Html::submitButton('войти', ['class' => 'btn']) ?>
</div>

<?php $form->end(); ?>
