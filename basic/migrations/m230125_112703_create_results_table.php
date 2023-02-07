<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%results}}`.
 */
class m230125_112703_create_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%results}}', [
            'id' => $this->primaryKey(),
            'datetime'=>$this->dateTime()->notNull(),
            'id_command1'=>$this->integer()->notNull(),
            'goals_command1'=>$this->integer()->unsigned()->defaultValue(0),
            'id_command2'=>$this->integer()->notNull(),
            'goals_command2'=>$this->integer()->unsigned()->defaultValue(0),
        ]);
        $this->addForeignKey(
            'fk-results-id_command1',
            'results',
            'id_command1',
            'commands',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-results-id_command2',
            'results',
            'id_command2',
            'commands',
            'id',
            'CASCADE'
        );
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%results}}');
    }
}
