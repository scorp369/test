<?php

namespace app\modules\news\models;

use app\modules\user\models\User;
use yii\db\ActiveRecord;

/**
 * новости
 *
 * @property int    $id          [int(10) unsigned]  идентификатор новости
 * @property int    $userId      [int(10) unsigned]  пользователь создавший новость
 * @property string $name        [varchar(50)]  название новости
 * @property string $description описание новости
 * @property bool   $state       [tinyint(1)]  статус новости, 0 - неактивен, 1 - активен
 * @property string $pictureFile [varchar(50)]  картинка
 * @property string $createdAt   [datetime]  дата создания
 */
class News extends ActiveRecord
{
    /** @inheritdoc */
    public static function tableName()
    {
        return 'news';
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            ['userId', 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'id'],
            [['name', 'description'], 'required'],
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
            'state'       => 'статус',
            'pictureFile' => 'картинка',
        ];
    }
}