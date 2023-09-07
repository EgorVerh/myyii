<?php

namespace app\controllers;
use app\models\Command;
use app\models\FootballPlayer;
use app\models\Result;

class FootballController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $commands = Result::find()->joinWith('command1')->joinWith('command2')->all();
        $namecommands = Command::find()->all();
        return $this->render('index',[ 'commands' =>$commands,'namecommands' =>$namecommands]);
    }
    public function actionRfpl()
    {
        $commands = Command::find()->all();
        $resultat = Result::find()->all();
        return $this->render('rfpl',[ 'commands' =>$commands,'resultat'=>$resultat]);
    }
    public function actionPlayers()
    {
        $players = FootballPlayer::find()->joinWith('command')->all();
        return $this->render('players', ['players' => $players]);
    }
}
