<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "form2email".
 *
 * @property int $idform2email
 * @property string|null $email
 * @property int|null $iddata
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
            [['iddata'], 'integer'],
            [['email'], 'string', 'max' => 45],
            [['iddata'], 'exist', 'skipOnError' => true, 'targetClass' => Dataforms::class, 'targetAttribute' => ['iddata' => 'iddataforms']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idform2email' => 'Idform2email',
            'email' => 'Email',
            'iddata' => 'Iddata',
        ];
    }

    /**
     * Gets query for [[Iddata0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIddata0()
    {
        return $this->hasOne(Dataforms::class, ['iddataforms' => 'iddata']);
    }
}
