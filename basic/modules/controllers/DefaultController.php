<?php

namespace app\modules\controllers;

use app\models\Savedatadb;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `newmodules` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model =Savedatadb::find()->orderBy("id DESC")->all();
        return $this->render('index',['model' => $model]);
    }
    public function actionSavedataview()
    {
    $model = new Savedatadb();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            $model->save();
            // form inputs are valid, do something here
            return $this->render('saveadd');
        }
    }

    return $this->render('savedataview', ['model' => $model]);
    }

}
