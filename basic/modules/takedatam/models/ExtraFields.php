<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "extra_fields".
 *
 * @property int $id
 * @property string $data
 * @property string $type
 * @property int|null $dataforms_id
 * @property int|null $fieldsforms_id
 *
 * @property Dataforms $dataforms
 * @property Fieldsforms $fieldsforms
 */
class ExtraFields extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra_fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'type'], 'required'],
            [['data', 'type'], 'string'],
            [['dataforms_id', 'fieldsforms_id'], 'integer'],
            [['dataforms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dataforms::class, 'targetAttribute' => ['dataforms_id' => 'id']],
            [['fieldsforms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fieldsforms::class, 'targetAttribute' => ['fieldsforms_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'type' => 'Type',
            'dataforms_id' => 'Dataforms ID',
            'fieldsforms_id' => 'Fieldsforms ID',
        ];
    }

    /**
     * Gets query for [[Dataforms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataforms()
    {
        return $this->hasOne(Dataforms::class, ['id' => 'dataforms_id']);
    }

    /**
     * Gets query for [[Fieldsforms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFieldsforms()
    {
        return $this->hasOne(Fieldsforms::class, ['id' => 'fieldsforms_id']);
    }
}
