<?php

/**
 * @var View       $this
 * @var News[]     $newsList   - список новостей
 * @var NewsFilter $newsFilter - фильтр новостей
 */

use app\components\mvc\view\View;
use app\modules\news\models\filter\NewsFilter;
use app\modules\news\models\News;
use app\modules\news\NewsModule;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Новостной сайт';

$formConfig = [
    'id'     => 'news-list-site-form',
    'method' => "GET",
    'action' => createUrl('/'),
];
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Новости</h1>
    </div>

    <!-- фильтр новостей -->
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <?php $form = \yii\widgets\ActiveForm::begin($formConfig) ?>

                <div class="col-xs-3">
                    <?= $form->field($newsFilter, 'pageSize')->input('text') ?>
                </div>

                <div class="col-xs-3">
                    <?= Html::submitButton('изменить кол-во новостей', ['class' => 'btn']) ?>
                </div>

                <?php $form->end() ?>
            </div>
        </div>
    </div>

    <!-- пагинация -->

    <div class="panel">
        <div class="col m6">
            <div class="pagination-total">
                Всего новостей: <?= $newsFilter->pagination->totalCount ?>
            </div>
        </div>
        <div class="col m6">
            <div class="pagination-links">
                <?= LinkPager::widget(['pagination' => $newsFilter->pagination]); ?>
            </div>
        </div>
    </div>

    <div class="body-content">
        <?php if ($newsList): ?>
            <?php foreach ($newsList as $news): ?>
                <div class="panel panel-default">
                    <div class="row panel-body">

                        <!-- картинка -->
                        <div class="col-xs-2">
                            <?= Html::a(Html::img($news->pictureFile, ['width' => '150px']), createUrl([createUrl(NewsModule::NEWS_VIEW), 'newsId' => $news->id])) ?>
                        </div>

                        <!-- название -->
                        <div class="col-xs-2">
                            <?= Html::a(Html::encode($news->name), createUrl([createUrl(NewsModule::NEWS_VIEW), 'newsId' => $news->id])) ?>
                        </div>

                        <!-- описание -->
                        <div class="col-xs-8 description">
                            <?= Html::encode($news->description) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Новостей нет.</p>
        <?php endif; ?>
    </div>
</div>
