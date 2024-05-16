<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "fildsforms".
 *
 * @property int $idfieldsforms
 * @property string|null $nameform
 * @property string|null $fieldform
 */
class Fildsform extends \yii\db\ActiveRecord
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfieldsforms' => 'Idfieldsforms',
            'nameform' => 'Nameform',
            'fieldform' => 'Fieldform',
        ];
    }
}
