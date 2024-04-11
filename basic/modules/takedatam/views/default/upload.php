<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<button>Отправить</button>

<?php ActiveForm::end() ?>
<?php 
if(isset($urlminio))
{
    echo'<div>'.$urlminio.'</div>';
}
?>