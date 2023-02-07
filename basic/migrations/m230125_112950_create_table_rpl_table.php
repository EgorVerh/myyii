<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%table_rpl}}`.
 */
class m230125_112950_create_table_rpl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%table_rpl}}', [
            'id' => $this->primaryKey(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%table_rpl}}');
    }
}
