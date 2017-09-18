<?php

/**
 * часть страницы с пагинацией
 *
 * @var \yii\data\Pagination $pagination - пагинация
 */

use yii\widgets\LinkPager;

?>

<div class="panel">
    <div class="col m6">
        <div class="pagination-total">
            Всего: <?= $pagination->totalCount ?>
        </div>
    </div>
    <div class="col m6">
        <div class="pagination-links">
            <?= LinkPager::widget(['pagination' => $pagination]); ?>
        </div>
    </div>
</div>
