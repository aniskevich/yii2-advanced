<?php

use yii\db\Migration;

/**
 * Class m190917_075327_add_fk_project_id_to_task_table
 */
class m190917_075327_add_fk_project_id_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-task-project_id', 'task', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task-project_id', 'task');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_075327_add_fk_project_id_to_task_table cannot be reverted.\n";

        return false;
    }
    */
}
