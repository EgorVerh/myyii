<?php

/** @var yii\web\View $this */


use app\models\Dataforms;
use yii\helpers\Html;

?>
    <h2 style="text-align: center;">Редактирование страницы</h2>
    <p>ФГБОУ ВО &laquo;ВГСПУ&raquo;</p>
<!-- Первая форма ввода -->
<form> 
<div class="row" style="margin-top:20px;border-bottom:2px solid #d7c97c;">
<b class="col-4" style="color:#686868;">О полном наименовании образовательной организации</b>
    <div class="form col-8"> 
    <textarea class="form-control" style="margin-bottom:20px ;" name="Textarea1"></textarea>
  </div>
</div>

<!-- Конец Первая форма ввода -->

<!-- Вторая форма ввода -->
<div class="row" style="margin-top:20px;border-bottom:2px solid #d7c97c;">
    <b class="col-4" style="color:#686868;">Сокращенное (при наличии) наименование образовательной организации</b>
    <div class="form col-8">
    <textarea class="form-control" style="margin-bottom:20px ;" name="Textarea2"></textarea>
  </div>
</div>
<!-- Коненц Вторая форма ввода -->

<!-- Третья форма ввода -->
<div class="row" style="margin-top:20px;border-bottom:2px solid #d7c97c;">
    <b class="col-4" style="color:#686868;">Дата создания образовательной организации</b>
    <div class="form col-8">
    <textarea class="form-control" style="margin-bottom:20px ;" name="Textarea3"></textarea>
  </div>
</div>
<!-- Конец Третья форма ввода -->
<div class="form-group" style="margin-top:10px">
<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>
</form>
