<?php

use yii\db\Schema;
use yii\db\Migration;

class m240805_134030_dataforms extends Migration
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
            '{{%dataforms}}',
            [
                'id'=> $this->primaryKey(11),
                'namefieldsforms'=> $this->text()->notNull(),
                'datafilds'=> $this->text()->null()->defaultValue(null),
                'fieldsforms_id'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('dataforms_fieldsforms_id_fieldsforms_id _idx','{{%dataforms}}',['fieldsforms_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('dataforms_fieldsforms_id_fieldsforms_id _idx', '{{%dataforms}}');
        $this->dropTable('{{%dataforms}}');
    }
}
