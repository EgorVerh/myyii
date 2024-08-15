<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "form2addres".
 *
 * @property int $id
 * @property string|null $addres
 * @property int|null $iddataforms
 *
 * @property Dataforms $iddataforms0
 */
class Form2addres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form2addres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['addres'], 'string', 'max' => 255],
            [['iddataforms'], 'exist', 'skipOnError' => true, 'targetClass' => Dataforms::class, 'targetAttribute' => ['iddataforms' => 'iddataforms']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Idform2addres',
            'addres' => 'Addres',
            'iddataforms' => 'Iddataforms',
        ];
    }

    /**
     * Gets query for [[Iddataforms0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIddataforms0()
    {
        return $this->hasOne(Dataforms::class, ['iddataforms' => 'iddataforms']);
    }
}
