<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
?>

<!-- <form name="form" method="post"  enctype="multipart/form-data">
<input type="file" name="upload_file" title="Выберите файл"/></br>
<input type="submit" value = "Загрузить файл" name="button" /></br>
</form>  -->

<h2 style="text-align: center;">Редактирование страницы</h2>
<p>ФГБОУ ВО &laquo;ВГСПУ&raquo;</p>
<form method="post" enctype="multipart/form-data">
    <div class="row">
    <b class="col-3">Устав образовательной организации</b>
    <div style="border: 1px solid #F0F0F0;" id="div_add_row" class="col-9"><button style="margin-top: 10px;" type="button" id="add_row" class="btn btn-success">+ Добавить</button></div>
    </div>
    <div style="margin-top:15px;border-bottom:2px solid #d7c97c;"></div>
    <div class="form-group" style="margin-top:10px">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
</form>

<script "assets/e52bf38b/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var i=0;
    $('#add_row').click(function(){
        ++i;
        $('#add_row').before('<div style="margin:10px 5px 0 5px; padding:10px; border: 1px solid #F0F0F0;" class="row"><div class="col-11"><input type="file" class="form-control-file" id="File'+i+'" name="upload_file[]"></div><button style="width:30px; height:30px; text-align:centre; font-size:10px" type="button" id="remove_row" class="btn btn-danger col-1">X</button></div>');
    })
$(document).on('click','#remove_row', function(){ 
        $(this).closest('.row').remove();
    });
})
</script>
