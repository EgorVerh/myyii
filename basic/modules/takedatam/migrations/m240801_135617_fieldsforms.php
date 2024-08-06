<?php

use yii\db\Schema;
use yii\db\Migration;

class m240801_135617_fieldsforms extends Migration
{
    public function safeUp()
    {
        

        $this->createTable(
            '{{%fieldsforms}}',
            [
                'id'=> $this->primaryKey(11),
                'nameform'=> $this->text()->notNull(),
                'fieldform'=> $this->text()->notNull(),
                'count_upload_doc'=> $this->integer(10)->unsigned()->notNull()->defaultValue(0),
            ],
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%fieldsforms}}');
    }
}
