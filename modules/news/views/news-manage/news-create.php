<?php

/**
 * страница создания новости
 *
 * @var View $this
 * @var News $newsCreateForm - форма создания новости
 */

use app\components\mvc\view\View;
use app\modules\news\models\News;
use app\modules\news\NewsModule;
use app\widgets\modalWindow\ModalWindow;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Создать новость';

$formConfig = [
    'id'      => 'news-create-form',
    'method'  => 'POST',
    'action'  => createUrl(NewsModule::NEWS_CREATE),
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
];

?>

<?= Html::button('создать новость', ['class' => 'btn js-toggle-modal-window']) ?>

<!-- виджет модального окна -->
<?= ModalWindow::widget() ?>
<?= ModalWindow::renderBodyBegin('Создать новость') ?>

<?php $form = ActiveForm::begin($formConfig) ?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- название -->
        <div class="col-xs-2">
            <?= $form->field($newsCreateForm, 'name')->input('text') ?>
        </div>

        <!-- картинка -->
        <div class="col-xs-2">
            <?= $form->field($newsCreateForm, 'pictureFile')->fileInput() ?>
        </div>

        <!-- описание -->
        <div class="col-xs-12">
            <?= $form->field($newsCreateForm, 'description')->textarea() ?>
        </div>

        <!-- кнопка submit -->
        <div class="col-xs-2">
            <?= Html::submitButton('создать', ['class' => 'btn']) ?>
        </div>

    </div>
</div>
<?php $form->end() ?>

<?= ModalWindow::renderBodyEnd() ?>
