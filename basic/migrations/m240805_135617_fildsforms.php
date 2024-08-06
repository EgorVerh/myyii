<?php

use yii\db\Schema;
use yii\db\Migration;

class m240805_135617_fildsforms extends Migration
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
            '{{%fildsforms}}',
            [
                'id'=> $this->primaryKey(11),
                'nameform'=> $this->text()->notNull(),
                'fieldform'=> $this->text()->notNull(),
                'count_upload_doc'=> $this->integer(10)->unsigned()->notNull()->defaultValue(0),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%fildsforms}}');
    }
}
