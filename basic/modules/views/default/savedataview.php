<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Savedatadb $model */
/** @var ActiveForm $form */
?>
<div class="savedataview">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'age') ?>
        <?= $form->field($model, 'about') ?>
        <div class="form-group" style="margin-top:10px">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- savedataview -->
