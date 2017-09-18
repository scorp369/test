<?php

/**
 * страница отображения новостей
 *
 * @var View $this
 * @var News $news - новости
 */

use app\components\mvc\view\View;
use app\modules\news\models\News;
use yii\helpers\Html;

?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
                <?= Html::img($news->pictureFile, ['width' => '400px', 'class' => 'image pull-left']) ?>
                <p><?= Html::encode($news->name) ?></p>
                <p><?= Html::encode($news->description) ?></p>
            </div>
        </div>
    </div>
</div>
