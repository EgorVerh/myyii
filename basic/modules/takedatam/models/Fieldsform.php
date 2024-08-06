<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "fieldsforms".
 *
 * @property int $id
 * @property string|null $nameform
 * @property string|null $fieldform
 * @property int $count_upload_doc
 */
class Fieldsform extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fieldsforms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nameform', 'fieldform'], 'string'],
            ['count_upload_doc','integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'nameform' => 'Nameform',
            'fieldform' => 'Fieldform',
            'count_upload_doc'=>'Count_upload_doc'
        ];
    }
}
