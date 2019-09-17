<?php

use yii\db\Migration;

/**
 * Class m190917_074014_add_project_id_to_task_table
 */
class m190917_074014_add_project_id_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'project_id', $this->integer(11)->notNull()->after('reporter_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('task', 'project_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_074014_add_project_id_to_task_table cannot be reverted.\n";

        return false;
    }
    */
}
