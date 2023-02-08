<?php

namespace app\controllers;
use app\models\Command;
use app\models\Result;

class FootballController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $commands = Result::find()->joinWith('command1')->joinWith('command2')->all();
        $namecommands = Command::find()->all();
        return $this->render('index',[ 'commands' =>$commands,'namecommands' =>$namecommands]);
    }

}
