<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_131737_dataforms extends Migration
{
    public function safeUp()
    {
        
        $this->createTable(
            '{{%dataforms}}',
            [
                'id'=> $this->primaryKey(11),
                'titel'=> $this->text()->notNull(),
                'data'=> $this->text()->null()->defaultValue(null),
                'fieldsforms_id'=> $this->integer(11)->notNull(),
                'enabled'=> $this->integer(10)->unsigned()->notNull()->defaultValue(1),
                'position'=> $this->text()->null()->defaultValue(null),
                'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'updated_at'=> $this->datetime()->null()->defaultValue(null),
            ],
        );
        $this->createIndex('dataforms_fieldsforms_id_fieldsforms_id _idx','{{%dataforms}}',['fieldsforms_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('dataforms_fieldsforms_id_fieldsforms_id _idx', '{{%dataforms}}');
        $this->dropTable('{{%dataforms}}');
    }
}
