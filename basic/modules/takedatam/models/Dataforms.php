<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "dataforms".
 *
 * @property int $iddataforms
 * @property string $namefildsforms
 * @property string|null $datafilds
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
            [['namefildsforms'], 'required'],
            [['namefildsforms', 'datafilds'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddataforms' => 'Iddataforms',
            'namefildsforms' => 'Namefildsforms',
            'datafilds' => 'Datafilds',
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
        return $this->hasMany(Form2email::class, ['iddataforms' => 'iddataforms']);
    }
}
