<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "football_players".
 *
 * @property int $id
 * @property string|null $name
 * @property int $id_command
 * @property int|null $goals
 * @property int|null $penalty
 * @property int|null $games
 *
 * @property Command $command
 */
class FootballPlayer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'football_players';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_command'], 'required'],
            [['id_command', 'goals', 'penalty', 'games'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_command'], 'exist', 'skipOnError' => true, 'targetClass' => Command::class, 'targetAttribute' => ['id_command' => 'id']],
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
            'id_command' => 'Id Command',
            'goals' => 'Goals',
            'penalty' => 'Penalty',
            'games' => 'Games',
        ];
    }

    /**
     * Gets query for [[Command]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommand()
    {
        return $this->hasOne(Command::class, ['id' => 'id_command']);
    }
}
