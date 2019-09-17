<?php

use yii\db\Migration;

/**
 * Class m190917_074114_add_fk_to_project_tag_table
 */
class m190917_074114_add_fk_to_project_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-project_tag-project_id', 'project_tag', 'project_id', 'project', 'id');
        $this->addForeignKey('fk-project_tag-tag_id', 'project_tag', 'tag_id', 'tag', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-project_tag-project_id', 'project_tag');
        $this->dropForeignKey('fk-project_tag-tag_id', 'project_tag');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_074114_add_fk_to_project_tag_table cannot be reverted.\n";

        return false;
    }
    */
}
