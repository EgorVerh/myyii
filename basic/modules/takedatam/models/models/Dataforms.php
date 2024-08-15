<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "dataforms".
 *
 * @property int $id
 * @property string $titel
 * @property string|null $link
 * @property int $fieldsforms_id
 * @property int $enabled
 * @property string $position
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Fieldsforms[] $fieldsforms
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
            [['titel', 'fieldsforms_id', 'position'], 'required'],
            [['titel', 'position'], 'string'],
            [['fieldsforms_id', 'enabled'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            ['link','url'],
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
            'link' => 'Link',
            'fieldsforms_id' => 'Fieldsforms ID',
            'enabled' => 'Enabled',
            'position' => 'Position',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
