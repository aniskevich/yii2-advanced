<?php

use yii\db\Migration;

/**
 * Class m190917_073709_add_fk_to_project_table
 */
class m190917_073709_add_fk_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-project-author_id', 'project', 'author_id', 'user', 'id');
        $this->addForeignKey('fk-project-reporter_id', 'project', 'reporter_id', 'user', 'id');
        $this->addForeignKey('fk-project-status_id', 'project', 'status_id', 'status', 'id');
        $this->addForeignKey('fk-project-priority_id', 'project', 'priority_id', 'priority', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-project-author_id', 'project');
        $this->dropForeignKey('fk-project-reporter_id', 'project');
        $this->dropForeignKey('fk-project-status_id', 'project');
        $this->dropForeignKey('fk-project-priority_id', 'project');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_073709_add_fk_to_project_table cannot be reverted.\n";

        return false;
    }
    */
}
