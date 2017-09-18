<?php

/**
 * Часть страницы со списком новостей
 *
 * @var View   $this
 * @var News[] $newsList - список новостей
 */

use app\components\mvc\view\View;
use app\modules\news\models\News;
use app\modules\news\NewsModule;
use app\modules\user\models\User;
use yii\helpers\Html;

?>

<?php if ($newsList): ?>
    <?php foreach ($newsList as $news): ?>
        <div class="panel panel-default">
            <div class="row panel-body">

                <!-- картинка -->
                <div class="col-xs-2">
                    <?= Html::img($news->pictureFile, ['width' => '150px']) ?>
                </div>

                <!-- название -->
                <div class="col-xs-2">
                    Название: <?= Html::encode($news->name) ?>
                </div>

                <!-- описание -->
                <div class="col-xs-2 description">
                    Описание: <?= Html::encode($news->description) ?>
                </div>

                <!-- дата создания -->
                <div class="col-xs-2">
                    <div class="row">
                        <div class="col-xs-12">
                            Дата создания: <?= Html::encode($news->createdAt) ?>
                        </div>
                        <div class="col-xs-12">
                            Владелец: <?= User::findOne($news->userId)->login ?>
                        </div>
                    </div>
                </div>

                <!-- статус активности -->
                <div class="col-xs-2">
                    Статус: <?= Html::button($news->state ? 'активен' : 'не активен', ['class' => 'btn js-news-change-state', 'data' => ['news-change-state-url' => createUrl([NewsModule::NEWS_CHANGE_STATE, 'newsId' => $news->id])]]) ?>
                </div>

                <div class="col-xs-2">
                    <?= Html::button('редактировать', ['class' => 'btn js-news-edit-modal-window-button', 'data' => ['news-edit-url' => createAbsoluteUrl([NewsModule::NEWS_EDIT, 'newsId' => $news->id])]]) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Новости не найдены</p>
<?php endif; ?>
