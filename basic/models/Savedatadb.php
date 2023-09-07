<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "savedatadb".
 *
 * @property int $id
 * @property string $name
 * @property int $age
 * @property string $about
 */
class Savedatadb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'savedatadb';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'age', 'about'], 'required'],
            [['age'], 'integer'],
            [['about'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'age' => 'Age',
            'about' => 'About',
        ];
    }
}
