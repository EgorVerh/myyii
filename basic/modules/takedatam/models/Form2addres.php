<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "form2addres".
 *
 * @property int $idform2addres
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
            [['iddataforms'], 'integer'],
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
            'idform2addres' => 'Idform2addres',
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
