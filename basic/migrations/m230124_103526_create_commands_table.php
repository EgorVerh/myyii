<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%commands}}`.
 */
class m230124_103526_create_commands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%commands}}', [
            'id' => $this->primaryKey(),
            'command'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%commands}}');
    }
}
