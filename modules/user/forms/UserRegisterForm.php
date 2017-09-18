<?php

namespace app\modules\user\forms;

use app\modules\user\models\register\EmailConfirm;
use app\modules\user\models\register\UserActivate;
use app\modules\user\models\User;
use Webmozart\Assert\Assert;
use yii\base\Model;

/**
 * форма пользователя
 */
class UserRegisterForm extends Model
{
    /**
     * логин пользователя
     *
     * @var string
     */
    public $login;

    /**
     * email пользователя
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'email'], 'required'],
            [['login', 'password'], 'string'],
            ['login', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'login'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login'    => 'логин',
            'password' => 'пароль',
            'email'    => 'email',
        ];
    }

    /**
     * сохранить пользователя
     *
     * @return bool
     */
    public function save()
    {
        $user = new User();
        $user->load(['User' => $this->attributes]);

        $user->setPassword($this->password);
        $user->activateToken = UserActivate::getToken();

        if (!$user->validate()) {
            $this->addErrors($user->getErrors());

            return false;
        }

        Assert::true($user->save(), 'Ошибка сохранения пользователя');

        EmailConfirm::sendUserActivationEmail($user->email, $user->id);

        return true;
    }
}