<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "savefiles".
 *
 * @property int $idsavefiles
 * @property string|null $Titel
 * @property string|null $NameFile
 * @property string|null $Link
 * @property string|null $Position
 */
class Savefiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'savefiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Titel', 'NameFile', 'Link', 'Position'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idsavefiles' => 'Idsavefiles',
            'Titel' => 'Titel',
            'NameFile' => 'Name File',
            'Link' => 'Link',
            'Position' => 'Position',
        ];
    }
}
