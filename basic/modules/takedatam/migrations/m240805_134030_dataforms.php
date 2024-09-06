<?php

use yii\db\Schema;
use yii\db\Migration;

class m240805_134030_dataforms extends Migration
{

    public function safeUp()
    {
        

        $this->createTable(
            '{{%dataforms}}',
            [
                'id'=> $this->primaryKey(11),
                'namefieldsforms'=> $this->text()->notNull(),
                'datafields'=> $this->text()->null()->defaultValue(null),
                'fieldsforms_id'=> $this->integer(11)->notNull(),
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
