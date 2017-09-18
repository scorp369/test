<?php

namespace app\modules\news;

use yii\base\Module;

/**
 * модуль новостей
 */
class NewsModule extends Module
{
    /** отображение новостей */
    const NEWS_VIEW = 'news/news/view';

    /** редактирование новостей */
    const NEWS_LIST = 'news/news-manage/list';
    const NEWS_CREATE = 'news/news-manage/create';
    const NEWS_EDIT = 'news/news-manage/edit';
    const NEWS_CHANGE_STATE = 'news/news-manage/change-state';

    /** @inheritdoc */
    public static function getUrlRules()
    {
        return [
            // редактирование новостей
            '/news/list'              => self::NEWS_LIST,
            '/news/create'            => self::NEWS_CREATE,
            '/news/change_state'      => self::NEWS_CHANGE_STATE,
            '/news/<newsId:\d+>/edit' => self::NEWS_EDIT,
            '/news/edit'              => self::NEWS_EDIT,

            // отображение новостей
            '/news/<newsId:\d+>/view' => self::NEWS_VIEW,
        ];
    }
}