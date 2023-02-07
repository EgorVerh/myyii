<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%football_players}}`.
 */
class m230124_103822_create_football_players_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%football_players}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'id_command'=>$this->integer()->notNull(),
            'goals'=>$this->integer()->unsigned(),
            'penalty'=>$this->integer()->unsigned(),
            'games'=>$this->integer()->unsigned(),
        ]);
        $this->addForeignKey(
            'fk-football_players-id_command',
            'football_players',
            'id_command',
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
        $this->dropTable('{{%football_players}}');
    }
}
