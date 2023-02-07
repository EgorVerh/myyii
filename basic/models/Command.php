<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commands".
 *
 * @property int $id
 * @property string|null $command
 *
 * @property FootballPlayer[] $footballPlayers
 * @property Result[] $results
 * @property Result[] $results0
 */
class Command extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['command'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'command' => 'Command',
        ];
    }

    /**
     * Gets query for [[FootballPlayers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFootballPlayers()
    {
        return $this->hasMany(FootballPlayer::class, ['id_command' => 'id']);
    }

    /**
     * Gets query for [[Results]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::class, ['id_command1' => 'id']);
    }

    /**
     * Gets query for [[Results0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResults0()
    {
        return $this->hasMany(Result::class, ['id_command2' => 'id']);
    }
}
