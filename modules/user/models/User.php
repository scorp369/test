<?php

namespace app\modules\user\models;

use app\rbac\Roles;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * пользователь
 *
 * @property int    $id                 [int(11)]  идентификатор пользователя
 * @property string $login              [varchar(50)]  логин
 * @property string $password_hash      [varchar(50)]  пароль
 * @property string $email              [char(50)]  email
 * @property string $access_token       [char(15)]  токен доступа
 * @property string $role               [varchar(20)]  роль
 * @property string $createdAt          [datetime]  дата создания
 * @property string $lastAuthenticateAt [datetime]  дата крайней аутентификации
 * @property string $activateToken      [char(15)]  токен для активации пользователя после регистрации
 * @property bool   $activated          [tinyint(1)]  флаг активации пользователя после подтверждения по email, 0 - не активирован, 1 - активирован
 * @property bool   $deleted            [tinyint(1)]  флаг удаления пользователя, 0 - не удален, 1 - удален
 */
class User extends ActiveRecord implements IdentityInterface
{
    /** @inheritdoc */
    public static function tableName()
    {
        return 'user';
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['login', 'email', 'password_hash'], 'required'],
            ['email', 'email'],
            [['login'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'length' => 60],
            [['login', 'email'], 'unique'],
            ['role', 'in', 'range' => Roles::getList()],
            [['activated', 'deleted'], 'in', 'range' => ['0', '1']]
        ];
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return app()->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = app()->security->generatePasswordHash($password);
    }

    /** @inheritdoc */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /** @inheritdoc */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /** @inheritdoc */
    public function getId()
    {
        return $this->id;
    }

    /** @inheritdoc */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /** @inheritdoc */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}