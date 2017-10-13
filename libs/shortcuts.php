<?php

/**
 * @return string
 */
if (!function_exists('createUrl')) {
    function createUrl($params)
    {
        return Yii::$app->get('urlManager')->createUrl($params);
    }
}

/**
 * @return string
 */
if (!function_exists('createUrl')) {
    function createAbsoluteUrl($params, $scheme = null)
    {
        return Yii::$app->get('urlManager')->createAbsoluteUrl($params, $scheme);
    }
}

/**
 * дамп
 */
if (!function_exists('createUrl')) {
    function ddd($dump)
    {
        d($dump);
        die();
    }
}
