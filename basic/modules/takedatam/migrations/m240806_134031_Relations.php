<?php

use yii\db\Schema;
use yii\db\Migration;

class m240806_134031_Relations extends Migration
{

    public function safeUp()
    {
        $this->addForeignKey('fk_dataforms_fieldsforms_id',
            '{{%dataforms}}','fieldsforms_id',
            '{{%fieldsforms}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_dataforms_fieldsforms_id', '{{%dataforms}}');
    }
}
