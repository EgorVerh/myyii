<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_133727_extra_fields extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            '{{%extra_fields}}',
            [
                'id'=> $this->primaryKey(11),
                'data'=> $this->text()->notNull(),
                'type'=> $this->text()->notNull(),
                'dataforms_id'=> $this->integer(11)->null()->defaultValue(null),
                'fieldsforms_id'=> $this->integer(11)->null()->defaultValue(null),
            ],
        );
        $this->createIndex('extra_fields_data_all_forms_id_data_all_forms_id_idx','{{%extra_fields}}',['dataforms_id'],false);
        $this->createIndex('extra_fields_fieldsforms_id_fieldsforms_id_idx','{{%extra_fields}}',['fieldsforms_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('extra_fields_data_all_forms_id_data_all_forms_id_idx', '{{%extra_fields}}');
        $this->dropIndex('extra_fields_fieldsforms_id_fieldsforms_id_idx', '{{%extra_fields}}');
        $this->dropTable('{{%extra_fields}}');
    }
}
