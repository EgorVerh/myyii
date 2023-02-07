<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "results".
 *
 * @property int $id
 * @property string $datetime
 * @property int $id_command1
 * @property int|null $goals_command1
 * @property int $id_command2
 * @property int|null $goals_command2
 *
 * @property Command $command1
 * @property Command $command2
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datetime', 'id_command1', 'id_command2'], 'required'],
            [['datetime'], 'safe'],
            [['id_command1', 'goals_command1', 'id_command2', 'goals_command2'], 'integer'],
            [['id_command1'], 'exist', 'skipOnError' => true, 'targetClass' => Command::class, 'targetAttribute' => ['id_command1' => 'id']],
            [['id_command2'], 'exist', 'skipOnError' => true, 'targetClass' => Command::class, 'targetAttribute' => ['id_command2' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime' => 'Datetime',
            'id_command1' => 'Id Command1',
            'goals_command1' => 'Goals Command1',
            'id_command2' => 'Id Command2',
            'goals_command2' => 'Goals Command2',
        ];
    }

    /**
     * Gets query for [[Command1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommand1()
    {
        return $this->hasOne(Command::class, ['id' => 'id_command1']);
    }

    /**
     * Gets query for [[Command2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommand2()
    {
        return $this->hasOne(Command::class, ['id' => 'id_command2']);
    }
}
