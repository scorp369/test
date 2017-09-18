<?php

/**
 * @return string
 */
function createUrl($params)
{
    return Yii::$app->get('urlManager')->createUrl($params);
}

/**
 * @return string
 */
function createAbsoluteUrl($params, $scheme = null)
{
    return Yii::$app->get('urlManager')->createAbsoluteUrl($params, $scheme);
}

/**
 * дамп
 */
function ddd($dump)
{
    d($dump);
    die();
}