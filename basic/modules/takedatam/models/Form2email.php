<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "form2email".
 *
 * @property int $id
 * @property string|null $email
 * @property int|null $iddataforms
 *
 * @property Dataforms $iddata0
 */
class Form2email extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form2email';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddataforms'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['iddataforms'], 'exist', 'skipOnError' => true, 'targetClass' => Dataforms::class, 'targetAttribute' => ['iddataforms' => 'iddataforms']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Idform2email',
            'email' => 'Email',
            'iddataforms' => 'Iddataforms',
        ];
    }

    /**
     * Gets query for [[Iddata0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIddata0()
    {
        return $this->hasOne(Dataforms::class, ['iddataforms' => 'iddataforms']);
    }
}
