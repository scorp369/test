<?php

/**
 * часть страницы с модальной формой редактирования новости
 *
 * @var View         $this
 * @var NewsEditForm $newsEditForm
 */

use app\components\mvc\view\View;
use app\modules\news\forms\NewsEditForm;
use app\modules\news\NewsModule;
use app\widgets\modalWindow\ModalWindow;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$formConfig = [
    'id'                   => 'news-edit-form',
    'method'               => 'POST',
    'action'               => createUrl(NewsModule::NEWS_EDIT),
    'enableAjaxValidation' => true,
];

?>

<?= ModalWindow::renderBodyBegin('Редактировать новости') ?>

<?php $form = ActiveForm::begin($formConfig) ?>
<div class="panel panel-default">
    <div class="panel-body">

        <!-- идентификатор -->
        <div class="hidden">
            <?= $form->field($newsEditForm, 'id')->input('text') ?>
        </div>

        <!-- название -->
        <div class="col-xs-2">
            <?= $form->field($newsEditForm, 'name')->input('text') ?>
        </div>

        <!-- описание -->
        <div class="col-xs-3">
            <?= $form->field($newsEditForm, 'description')->textarea() ?>
        </div>

        <!-- картинка -->
        <div class="col-xs-3">
            <?= $form->field($newsEditForm, 'pictureFile')->fileInput() ?>
        </div>

        <!-- статус активности -->
        <div class="col-xs-2">
            <?= $form->field($newsEditForm, 'state')->checkbox() ?>
        </div>

        <!-- кнопка submit -->
        <div class="col-xs-2">
            <?= Html::submitButton('изменить', ['class' => 'btn js-news-edit']) ?>
        </div>

    </div>
</div>
<?php $form->end() ?>

<?= ModalWindow::renderBodyEnd() ?>
