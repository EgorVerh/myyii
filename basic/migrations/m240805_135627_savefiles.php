<?php

use yii\db\Schema;
use yii\db\Migration;

class m240805_135627_savefiles extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%savefiles}}',
            [
                'id'=> $this->primaryKey(11),
                'fieldsforms_id'=> $this->integer(11)->notNull(),
                'titel'=> $this->text()->notNull(),
                'link'=> $this->text()->null()->defaultValue(null),
                'position'=> $this->text()->notNull(),
                'enabled'=> $this->integer(10)->unsigned()->notNull()->defaultValue(1),
                'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'updated_at'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('savefiles_fieldsforms_id_fieldsforms_id_idx','{{%savefiles}}',['fieldsforms_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('savefiles_fieldsforms_id_fieldsforms_id_idx', '{{%savefiles}}');
        $this->dropTable('{{%savefiles}}');
    }
}
