<?php

use yii\db\Schema;
use yii\db\Migration;

class m240805_135628_Relations extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('fk_savefiles_fieldsforms_id',
            '{{%savefiles}}','fieldsforms_id',
            '{{%fildsforms}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_savefiles_fieldsforms_id', '{{%savefiles}}');
    }
}
