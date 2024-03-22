<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use frontend\modules\takedatam\assets\AppAsset;
AppAsset::register($this);
$this->registerCssFile('@modulestakedatamcss/index.css');
?>
<div class="takedatam">
    <h2 class="h2center">Редактирование страницы</h2>
    <p>ФГБОУ ВО &laquo;ВГСПУ&raquo;</p>
<!-- Первая форма ввода -->
<form> 
<div class="row">
<b class="col-md-4">О полном наименовании образовательной организации</b>
    <div class="form col-md-8"> 
    <textarea class="form-control" name="Textarea1"><?php echo Yii::$app->request->get("Textarea1")?></textarea>
  </div>
</div>
<!-- Конец Первая форма ввода -->

<!-- Вторая форма ввода -->
<div class="row">
    <b class="col-md-4">Сокращенное (при наличии) наименование образовательной организации</b>
    <div class="form col-md-8">
    <textarea class="form-control" name="Textarea2"><?php echo Yii::$app->request->get("Textarea2")?></textarea>
  </div>
</div>
<!-- Коненц Вторая форма ввода -->

<!-- Третья форма ввода -->
<div class="row">
    <b class="col-md-4">Дата создания образовательной организации</b>
    <div class="form col-md-8">
    <textarea class="form-control" name="Textarea3"><?php echo Yii::$app->request->get("Textarea3")?></textarea>
  </div>
</div>
<!-- Конец Третья форма ввода -->
<div class="form-group">
<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>
</form>
</div>
<!-- Ссылка ввиде имени -->