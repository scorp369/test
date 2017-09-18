<?php

/**
 * часть страницы с фильтром пользователей
 *
 * @var View       $this
 * @var UserFilter $userFilter - фильтр пользователей
 */

use app\modules\user\models\filter\UserFilter;
use yii\helpers\Html;
use app\components\mvc\view\View;
use yii\widgets\ActiveForm;

$formConfig = [
    'id'     => 'user-filter-form',
    'action' => '/user/list',
    'method' => 'GET',
];

?>

<?php $form = ActiveForm::begin($formConfig) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <p class="caption">Фильтр пользователей</p>
    </div>
    <div class="row panel-body">


        <!-- фильтр по идентификатору -->
        <div class="col-xs-2">
            <?= $form->field($userFilter, 'id')->input('text') ?>
        </div>

        <!-- фильтр по логину -->
        <div class="col-xs-2">
            <?= $form->field($userFilter, 'login')->input('text') ?>
        </div>

        <!-- фильтр по email -->
        <div class="col-xs-2">
            <?= $form->field($userFilter, 'email')->input('text') ?>
        </div>

        <!-- фильтр по дате созданию от -->
        <div class="col-xs-3">
            <?= $form->field($userFilter, 'createdAtFrom')->input('time') ?>
        </div>

        <!-- фильтр по дате созданию до -->
        <div class="col-xs-3">
            <?= $form->field($userFilter, 'createdAtTo')->input('time') ?>
        </div>

        <!-- фильтр по дате крайней аутентификации от -->
        <div class="col-xs-3">
            <?= $form->field($userFilter, 'lastAuthenticateAtFrom')->input('time') ?>
        </div>

        <!-- фильтр по дате крайней аутентификации до -->
        <div class="col-xs-3">
            <?= $form->field($userFilter, 'lastAuthenticateAtTo')->input('time') ?>
        </div>

        <div class="col-xs-12">
            <?= Html::submitButton('фильтровать', ['class' => 'btn']) ?>
        </div>
    </div>
</div>
<?php $form->end() ?>
