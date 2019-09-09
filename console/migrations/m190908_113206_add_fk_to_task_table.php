<?php

use yii\db\Migration;

/**
 * Class m190908_113206_add_fk_to_task_table
 */
class m190908_113206_add_fk_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-task-author_id', 'task', 'author_id', 'user', 'id');
        $this->addForeignKey('fk-task-reporter_id', 'task', 'reporter_id', 'user', 'id');
        $this->addForeignKey('fk-task-status_id', 'task', 'status_id', 'status', 'id');
        $this->addForeignKey('fk-task-priority_id', 'task', 'priority_id', 'priority', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task-author_id', 'task');
        $this->dropForeignKey('fk-task-reporter_id', 'task');
        $this->dropForeignKey('fk-task-status_id', 'task');
        $this->dropForeignKey('fk-task-priority_id', 'task');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190908_113206_add_fk_to_task_table cannot be reverted.\n";

        return false;
    }
    */
}
