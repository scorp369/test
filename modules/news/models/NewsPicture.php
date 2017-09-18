<?php

namespace app\modules\news\models;

use yii\web\UploadedFile;

/**
 * картинка новости
 */
class NewsPicture
{
    /**
     * путь к картинке
     *
     * @var string
     */
    private $picturePath;

    /**
     * сохранить
     *
     * @param UploadedFile $file - файл картинки
     * @param News         $news - новости
     *
     * @return $this
     */
    public function save($file, $news)
    {
        $dir      = 'images/news/' . $news->id . '/';
        $fileName = $file->getBaseName() . '.' . $file->extension;

        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        } else {
            foreach (glob($dir . '*') as $oldFile) {
                unlink($oldFile);
            }
        }

        $file->saveAs($dir . $fileName);

        $this->picturePath = '/' . $dir . $fileName;

        return $this;
    }

    /**
     * получить путь картинки
     *
     * @return string|null
     */
    public function getPath()
    {
        return $this->picturePath ? $this->picturePath : null;
    }
}