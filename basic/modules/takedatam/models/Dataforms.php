<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "dataforms".
 *
 * @property int $id
 * @property string $titel
 * @property string|null $data
 * @property int $fieldsforms_id
 * @property int $enabled
 * @property string|null $position
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property ExtraFields[] $extraFields
 * @property Fieldsforms $fieldsforms
 */
class Dataforms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dataforms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titel', 'fieldsforms_id'], 'required'],
            [['titel', 'data', 'position'], 'string'],
            [['fieldsforms_id', 'enabled'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'titel' => 'Titel',
            'data' => 'Data',
            'fieldsforms_id' => 'Fieldsforms ID',
            'enabled' => 'Enabled',
            'position' => 'Position',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ExtraFields]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtraFields()
    {
        return $this->hasMany(ExtraFields::class, ['dataforms_id' => 'id']);
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
