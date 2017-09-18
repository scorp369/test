<?php

/**
 * страница регистрации пользователя
 *
 * @var View             $this
 * @var UserRegisterForm $userRegisterForm - форма пользователя
 */

use app\modules\user\forms\UserRegisterForm;
use app\modules\user\UserModule;
use yii\helpers\Html;
use app\components\mvc\view\View;
use yii\widgets\ActiveForm;

$formConfig = [
    'id'     => 'user-register-form',
    'action' => createUrl(UserModule::USER_REGISTER),
    'method' => 'POST',
]

?>

<?php $form = ActiveForm::begin($formConfig) ?>
<div>
    <?= $form->field($userRegisterForm, 'login')->input('text') ?>
</div>
<div>
    <?= $form->field($userRegisterForm, 'password')->input('password') ?>
</div>
<div>
    <?= $form->field($userRegisterForm, 'email')->input('text') ?>
</div>
<div>
    <?= Html::submitButton('зарегистрироваться', ['class' => 'btn']) ?>
</div>
<?php $form->end(); ?>
