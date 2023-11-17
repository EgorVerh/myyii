<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dataforms".
 *
 * @property int $iddataforms
 * @property string $Namefildsforms
 * @property string|null $Datafilds
 *
 * @property Form2addres[] $form2addres
 * @property Form2email[] $form2emails
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
            [['Namefildsforms'], 'required'],
            [['Namefildsforms', 'Datafilds'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddataforms' => 'Iddataforms',
            'Namefildsforms' => 'Namefildsforms',
            'Datafilds' => 'Datafilds',
        ];
    }

    /**
     * Gets query for [[Form2addres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm2addres()
    {
        return $this->hasMany(Form2addres::class, ['iddataforms' => 'iddataforms']);
    }

    /**
     * Gets query for [[Form2emails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm2emails()
    {
        return $this->hasMany(Form2email::class, ['iddata' => 'iddataforms']);
    }
}
