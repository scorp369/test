<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170917_060534_create_table_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = 'COMMENT="пользователь" CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('user', [
            'id'                 => $this->primaryKey(10)->unsigned()->comment('идентификатор пользователя'),
            'login'              => $this->string(50)->unique()->notNull()->comment('логин'),
            'password_hash'      => $this->string(60)->notNull()->comment('пароль'),
            'email'              => $this->string(50)->unique()->notNull()->comment('email'),
            'access_token'       => $this->string(15)->defaultValue(null)->comment('токен доступа'),
            'role'               => $this->string(20)->notNull()->defaultValue('user')->comment('роль'),
            'createdAt'          => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('дата регистрации'),
            'lastAuthenticateAt' => $this->dateTime()->defaultValue(null)->comment('дата крайней аутентификации'),
            'activateToken'      => $this->string(15)->defaultValue(null)->comment('токен для активации пользователя после регистрации'),
            'activated'          => $this->boolean()->unsigned()->notNull()->defaultValue(false)->comment('флаг активации пользователя после подтверждения по email, 0 - не активирован, 1 - активирован'),
            'deleted'            => $this->boolean()->unsigned()->notNull()->defaultValue(false)->comment('флаг удаления пользователя, 0 - неудален, 1 - удален'),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
