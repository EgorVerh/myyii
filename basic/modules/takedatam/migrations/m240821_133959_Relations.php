<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_133959_Relations extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('fk_extra_fields_dataforms_id',
            '{{%extra_fields}}','dataforms_id',
            '{{%dataforms}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_extra_fields_fieldsforms_id',
            '{{%extra_fields}}','fieldsforms_id',
            '{{%fieldsforms}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_extra_fields_dataforms_id', '{{%extra_fields}}');
        $this->dropForeignKey('fk_extra_fields_fieldsforms_id', '{{%extra_fields}}');
    }
}
