<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_log}}`.
 */
class m190913_123614_create_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat_log}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'message' => $this->string(255),
            'created_at' => $this->integer(11)
        ]);

        $this->addForeignKey('fk-chat-user_id', 'chat_log', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat_log}}');
    }
}
