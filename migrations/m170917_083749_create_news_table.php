<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170917_083749_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'COMMENT="пользователь" CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('news', [
            'id'          => $this->primaryKey(10)->unsigned()->comment('идентификатор новости'),
            'userId'      => $this->integer(10)->unsigned()->notNull()->comment('пользователь создавший новость'),
            'name'        => $this->string(50)->notNull()->comment('название новости'),
            'description' => $this->text()->notNull()->comment('описание новости'),
            'state'       => $this->boolean()->unsigned()->notNull()->defaultValue(false)->comment('статус новости, 0 - не активен, 1 - активен'),
            'pictureFile' => $this->string(50)->defaultValue(null)->comment('картинка'),
            'createdAt'   => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('дата создания'),
        ], $tableOptions);

        $this->addForeignKey('FK_news_user', 'news', 'userId', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
