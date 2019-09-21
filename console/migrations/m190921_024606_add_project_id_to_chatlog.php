<?php

use yii\db\Migration;

/**
 * Class m190921_024606_add_project_id_to_chatlog
 */
class m190921_024606_add_project_id_to_chatlog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('chat_log', 'project_id', $this->integer(11)->after('message'));
        $this->addForeignKey('fk-chat-project_id', 'chat_log', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('chat_log', 'project_id');
        $this->dropForeignKey('fk-chat-project_id', 'chat_log');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190921_024606_add_project_id_to_chatlog cannot be reverted.\n";

        return false;
    }
    */
}
