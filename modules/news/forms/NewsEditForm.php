<?php

namespace app\modules\news\forms;

use app\modules\news\models\News;
use app\modules\news\models\NewsPicture;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * форма редактирования новости
 */
class NewsEditForm extends Model
{
    /**
     * идентификатор
     *
     * @var string
     */
    public $id;

    /**
     * название
     *
     * @var string
     */
    public $name;

    /**
     * описание
     *
     * @var string
     */
    public $description;

    /**
     * картинка
     *
     * @var string
     */
    public $pictureFile;

    /**
     * статус активности
     *
     * @var string
     */
    public $state;

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['name', 'description', 'id'], 'required'],
            ['id', 'exist', 'targetClass' => News::className()],
            ['description', 'string'],
            ['name', 'string', 'max' => 50],
            ['state', 'in', 'range' => ['0', '1']],
            ['pictureFile', 'file', 'extensions' => 'jpg, jpeg, png'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'name'        => 'название',
            'description' => 'описание',
            'state'       => 'статус активности',
            'pictureFile' => 'картинка',
        ];
    }

    /**
     * обновить новости
     */
    public function updateNews()
    {
        if (!$this->validate()) {
            return false;
        }

        $news = News::findOne($this->id);
        $news->load(['News' => $this->attributes]);

        $file = UploadedFile::getInstance($this, 'pictureFile');
        if ($file) {
            $newsPicture = new NewsPicture();

            $news->pictureFile = $newsPicture->save($file, $news)->getPath();
        } else {
            $news->pictureFile = $news->getOldAttribute('pictureFile');
        }

        $news->update();

        return true;
    }
}