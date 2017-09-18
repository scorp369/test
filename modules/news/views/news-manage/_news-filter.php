<?php

/**
 * часть страницы с фильтром новостей
 *
 * @var View       $this
 * @var NewsFilter $newsFilter - фильтр новостей
 */

use app\modules\news\models\filter\NewsFilter;
use yii\helpers\Html;
use app\components\mvc\view\View;
use yii\widgets\ActiveForm;

$formConfig = [
    'id'     => 'news-filter-form',
    'action' => '/news/list',
    'method' => 'GET',
];

?>

<?php $form = ActiveForm::begin($formConfig) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <p class="caption">Фильтр новостей</p>
    </div>
    <div class="row panel-body">

        <!-- фильтр по идентификатору -->
        <div class="col-xs-2">
            <?= $form->field($newsFilter, 'id')->input('text') ?>
        </div>

        <!-- фильтр по логину -->
        <div class="col-xs-2">
            <?= $form->field($newsFilter, 'name')->input('text') ?>
        </div>

        <!-- фильтр по email -->
        <div class="col-xs-2">
            <?= $form->field($newsFilter, 'description')->input('text') ?>
        </div>

        <!-- фильтр по login`у пользователя -->
        <div class="col-xs-2">
            <?= $form->field($newsFilter, 'userLogin')->input('text') ?>
        </div>

        <!-- фильтр по дате созданию до -->
        <div class="col-xs-2">
            <?= $form->field($newsFilter, 'createdAtFrom')->input('time') ?>
        </div>

        <!-- фильтр по дате созданию от -->
        <div class="col-xs-2">
            <?= $form->field($newsFilter, 'createdAtTo')->input('time') ?>
        </div>

        <div class="col-xs-12">
            <?= Html::submitButton('фильтровать', ['class' => 'btn']) ?>
        </div>
    </div>
</div>
<?php $form->end() ?>
