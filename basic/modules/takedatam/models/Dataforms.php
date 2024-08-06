<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "dataforms".
 *
 * @property int $id
 * @property string $namefieldsforms
 * @property string|null $datafields
 * @property int $fieldsforms_id
 * 
 * @property Form2addres[] $form2addresdatafilds
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
            [['namefieldsforms'],'required'],
            [['fieldsforms_id'], 'required'],
            [['fieldsforms_id'], 'number'],
            [['datafields'],'required'],
            [['datafields'],'url','message'=>'Это не ссылка'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'namefieldsforms' => 'namefieldsforms',
            'datafields' => 'Datafilds',
            'fieldsforms_id' => 'fieldsforms_id',
        ];
    }

    /**
     * Gets query for [[Form2addres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm2addres()
    {
        return $this->hasMany(Form2addres::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[Form2emails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm2emails()
    {
        return $this->hasMany(Form2email::class, ['id' => 'id']);
    }
}
