<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m200415_102533_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'title' => $this->string(),
            'text' => $this->string(),
            'rating' => $this->integer(),
            'image' => $this->string(),
            'user_id' => $this->integer(),
            'created_at' => $this->date(),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey('fk-city-id', 'comment', 'city_id',
            'city', 'id', 'CASCADE');

        // add foreign key for table `article`
        $this->addForeignKey('fk-user-id', 'comment', 'user_id',
            'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-id',
            'comment');
        $this->dropForeignKey('fk-city-id',
            'comment');
        $this->dropTable('{{%comment}}');
    }
}
