<?php

/**
 * страница списка новостей
 *
 * @var View         $this
 * @var News[]       $newsList     - список новостей
 * @var NewsFilter   $newsFilter   - фильтр новостей
 * @var NewsEditForm $newsEditForm - форма редактирования новости
 */

use app\components\mvc\view\View;
use app\modules\news\forms\NewsEditForm;
use app\modules\news\models\filter\NewsFilter;
use app\modules\news\models\News;
use app\modules\news\NewsModule;
use yii\helpers\Html;

$this->title = 'Список новостей';

$this->registerModuleAssets(['newsEdit.js']);

?>

<h1>Список новостей</h1>

<!-- фильтр новостей -->
<?= $this->render('_news-filter', ['newsFilter' => $newsFilter]) ?>

<!-- ссылка создания новости -->
<div class="panel">
    <?= Html::a('создать новость', createUrl(NewsModule::NEWS_CREATE), ['class' => 'btn btn-default']) ?>
</div>

<!-- пагинация -->
<?= $this->render('_pagination', ['pagination' => $newsFilter->pagination]) ?>

<!-- список новостей -->
<?= $this->render('_news-list', ['newsList' => $newsList]) ?>

<!-- модельной окно редактирования новости -->
<?= $this->render('_news-edit', ['newsEditForm' => $newsEditForm]) ?>
