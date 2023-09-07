<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%savedatadb}}`.
 */
class m230804_084150_create_savedatadb_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%savedatadb}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'age'=>$this->integer()->unsigned()->notNull(),
            'about'=>$this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%savedatadb}}');
    }
}
