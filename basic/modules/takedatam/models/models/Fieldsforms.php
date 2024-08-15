<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "fieldsforms".
 *
 * @property int $id
 * @property string $nameform
 * @property string $fieldform
 * @property int $count_upload_doc
 *
 * @property Dataforms[] $dataforms
 */
class Fieldsforms extends \yii\db\ActiveRecord
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
            [['nameform', 'fieldform'], 'required'],
            [['nameform', 'fieldform'], 'string'],
            [['count_upload_doc'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nameform' => 'Nameform',
            'fieldform' => 'Fieldform',
            'count_upload_doc' => 'Count Upload Doc',
        ];
    }

    /**
     * Gets query for [[Dataforms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataforms()
    {
        return $this->hasMany(Dataforms::class, ['fieldsforms_id' => 'id']);
    }
}
