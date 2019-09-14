<?php

use yii\db\Migration;

/**
 * Class m190908_113929_add_fk_to_task_tag_table
 */
class m190908_113929_add_fk_to_task_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-task_tag-task_id', 'task_tag', 'task_id', 'task', 'id');
        $this->addForeignKey('fk-task_tag-tag_id', 'task_tag', 'tag_id', 'tag', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task_tag-task_id', 'task_tag');
        $this->dropForeignKey('fk-task_tag-tag_id', 'task_tag');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190908_113929_add_fk_to_task_tag_table cannot be reverted.\n";

        return false;
    }
    */
}
