<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_tag}}`.
 */
class m190908_112052_create_task_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_tag}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(11)->notNull(),
            'tag_id' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_tag}}');
    }
}
