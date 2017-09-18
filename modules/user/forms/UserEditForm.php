<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use app\rbac\Roles;
use yii\base\Model;
use yii\validators\UniqueValidator;

/**
 * форма редактирования пользователя
 */
class UserEditForm extends Model
{
    /**
     * логин
     *
     * @var string
     */
    public $login;

    /**
     * email
     *
     * @var string
     */
    public $email;

    /**
     * пароль пользователя
     *
     * @var string
     */
    public $password;

    /**
     * флаг об активации пользователя
     *
     * @var integer
     */
    public $activated;

    /**
     * роль пользователя
     *
     * @var string
     */
    public $role;

    /**
     * идентификатор редактируемого пользователя
     *
     * @var integer
     */
    public $id;

    /** @inheritdoc */
    public function rules()
    {
        return [
            ['activated', 'in', 'range' => ['0', '1']],
            [['login', 'password'], 'string'],
            ['login', 'validateLogin'],
            ['id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'id'],
            ['role', 'in', 'range' => Roles::getList()],
            ['email', 'email'],
            ['email', 'validateEmail']
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'login'     => 'логин',
            'password'  => 'пароль',
            'activated' => 'флаг активации',
            'role'      => 'роль',
        ];
    }

    /**
     * изменить пользователя
     */
    public function updateUser()
    {
        if (!$this->id) {
            return false;
        }

        $user = User::findOne($this->id);

        // загрузить атрибуты формы
        $user->load(['User' => $this->attributes]);

        // указать новый пароль
        if ($this->password) {
            $user->setPassword($this->password);
        }

        $user->update();

        return true;
    }

    /**
     * проверить логин пользователя
     *
     * @param $attribute
     * @param $params
     *
     * @return bool
     */
    public function validateLogin($attribute, $params)
    {
        // ошибка валидации при отсутствии или неверном значении идентификатора пользователя
        if (!$this->id || !$user = User::findOne($this->id)) {
            $this->addError($attribute, 'Ошибка валидации');

            return false;
        }

        // ошибка валидации при указании занятого логина
        if ($user->login != $this->{$attribute} && User::findOne(['login' => $this->{$attribute}])) {
            $this->addError($attribute, 'Указанный логин занят');
        }

        return true;
    }

    /**
     * проверить email пользователя
     *
     * @param $attribute
     * @param $params
     *
     * @return bool
     */
    public function validateEmail($attribute, $params)
    {
        // ошибка валидации при отсутствии или неверном значении идентификатора пользователя
        if (!$this->id || !$user = User::findOne($this->id)) {
            $this->addError($attribute, 'Ошибка валидации');

            return false;
        }

        // ошибка валидации при указании занятого логина
        if ($user->email != $this->{$attribute} && User::findOne(['email' => $this->{$attribute}])) {
            $this->addError($attribute, 'Указанный email занят');
        }

        return true;
    }
}