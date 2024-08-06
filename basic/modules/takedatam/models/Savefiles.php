<?php

namespace frontend\modules\takedatam\models;

use Yii;

/**
 * This is the model class for table "savefiles".
 *
 * @property int $id
 * @property string $titel
 * @property integer $fieldsforms_id
 * @property string|null $link
 * @property string $position
 * @property int $enabled
 * @property string $created_at
 * @property string|null $updated_at
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
            [['titel', 'position'], 'required'],
            [['titel','position'],'string'],
            [['enabled','fieldsforms_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [ 'link','url'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'titel' => 'Titel',
            'namefile' => 'Name File',
            'link' => 'Link',
            'position' => 'Position',
            'enabled' => 'Enabled',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
