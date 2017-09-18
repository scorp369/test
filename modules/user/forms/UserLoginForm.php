<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use yii\base\Model;
use yii\db\Expression;

/**
 * форма аутентификации пользователя
 */
class UserLoginForm extends Model
{
    /**
     * логин
     */
    public $login;

    /**
     * пароль
     */
    public $password;

    /**
     * пользователь найденный по логину
     *
     * @var User
     */
    private $user;

    /** @inheritdoc */
    public function rules()
    {
        return [
            ['login', 'exist', 'targetClass' => User::className(), 'message' => 'Логин не найден'],
            [['password'], 'string'],
            ['password', 'validatePassword']
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'login'    => 'Логин',
            'password' => 'Пароль',
        ];
    }

    /**
     * проверить пароль пользователя
     *
     * @param $attribute
     * @param $params
     *
     * @return bool
     */
    public function validatePassword($attribute, $params)
    {
        $this->user = User::findOne(['login' => $this->login]);

        if (!$this->user->validatePassword($this->password)) {
            $this->addError($attribute, 'Введен неверный пароль.');
        }
    }

    /**
     * активирован ли пользователь
     *
     * @return bool
     */
    private function userActivated()
    {
        return $this->user ? $this->user->activated : false;
    }

    /**
     * авторизовать пользователя
     *
     * @return bool
     */
    public function login()
    {
        if (!$this->userActivated()) {
            $this->addError('login', 'Для активации пользователя вам необходимо перейти по ссылке из письма, отправленного вам на почту');

            return false;
        }

        // изменить дату крайней аутентификации
        $this->user->lastAuthenticateAt = (new Expression('NOW()'));
        $this->user->update();

        app()->user->login($this->user);

        return true;
    }
}