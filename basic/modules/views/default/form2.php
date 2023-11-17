<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
?>
<h4>Сведения о каждом учредителе образовательной организации</h4>
<div class="row" id="no">
<div class="col-3" style="font-size:12px;"><b>Наименование учредителя образовательной организации</b></div>
<div class="col-2" style="font-size:12px;"><b>Юридический адрес учредителя</b></div>
<div class="col-2" style="font-size:12px;"><b>Контактный телефон учредителя</b></div>
<div class="col-3" style="font-size:12px;"><b>Адрес электронной почты учредителя</b></div>
<div class="col-2" style="font-size:12px;"><b>Адрес сайта учредителя в сети &laquo;Интернет&raquo;</b></div>
</div>
<!-- <div class="row" id="row'+i+'" style="margin-top:20px;border-top:2px solid grey; padding-top: 20px;">
<div class="form col-3">
<textarea class="form-control" id="Textarea1" name="'+i+'Textarea1"></textarea>
</div>
<div class="form col-2">
<textarea class="form-control" id="Textarea2" name="'+i+'Textarea2"></textarea>
</div>
<div class="form col-2">
<textarea class="form-control" id="Textarea3" name="'+i+'Textarea3"></textarea>
</div>
<div style="font-size:35pt; border: 1px solid #F0F0F0;" class="col-3" id="address"><button type="button" id="add_address" class="btn btn-success">+ Добавить</button></div>
<div style="font-size:35pt; border: 1px solid #F0F0F0;" class="col-2" id="sayt"><button type="button" id="add_sayt" class="btn btn-success">+ Добавить</button></div>
</div> -->
<form>
<div style="font-size:35pt" id="div_add_row"><button type="button" id="add_row" class="btn btn-success">+ Добавить</button></div>
<div class="form-group" style="margin-top:10px">
<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>
</form>

<!-- Подключение скриптов и сами скрипты -->
<script "assets/e52bf38b/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Добавление и удаление главной строки
    var i=0;
    $("#add_row").click(function(){
        i++;
        $("#div_add_row").before('<div class="row" id="row'+i+'" style="margin-top:20px;border-top:2px solid grey; padding-top: 20px;"><div class="col-1"><button type="button" style="font-size:10px; background-color:blue;" id="btn_down" class="btn">^</button><button type="button" style="font-size:10px; background-color:blue;" id="btn_down" class="btn">v</button><button style="text-align:centre; font-size:10px" type="button" id="remove_row" class="btn btn-danger">X</button></div><div class="col-2"><textarea class="form-control" id="Textarea1" name="Massrows['+i+'][0][]"></textarea></div><div class="col-2"><textarea class="form-control" id="Textarea2" name="Massrows['+i+'][0][]"></textarea></div><div class="col-2"><textarea class="form-control" id="Textarea3" name="Massrows['+i+'][0][]"></textarea></div><div style="font-size:35pt; border: 1px solid #F0F0F0;" class="col-3" id="address"><button type="button" id="add_address" class="btn btn-success" name="'+i+'">+ Добавить</button></div><div style="font-size:35pt; border: 1px solid #F0F0F0;" class="col-2" id="sayt"><button type="button" id="add_sayt" class="btn btn-success" name="'+i+'">+ Добавить</button></div></div>');
        // Стиль для вставки самой первой строки
        if($("#row"+i).prev().attr("id")=="no")
        {
            $("#row"+i).find("#btn_up").removeClass("btn-danger");
            $("#row"+i).find("#btn_up").css({'background-color':'blue'}); 
        }

        // Смена стиля кнопок строки после вставки новой
        if($("#row"+i).prev().prev().attr("id")=="no")
        {
            $("#row"+i).prev().find("#btn_down").addClass("btn-danger");
           
        }
        else
        {
            $("#row"+i).prev().find("#btn_up").addClass("btn-danger");
            $("#row"+i).prev().find("#btn_down").addClass("btn-danger");
        }
    });
    $(document).on('click','#remove_row', function(){ 
               $(this).closest('.row').remove();
             });
    //Конец Добавления и удаления главной строки( нужно доработать для смены стиля кнопок в зависимости от оставшихся строк)

    //Добавление и удаление адреса почты
    var e=0;
    $(document).on('click','#add_address',function(){
        ++e;
        var numberrow=$(this).attr("name");
        $(this).before('<div class="row" style="margin-bottom:5px"><div class="col-10"><textarea class="form-control" id="textaddres'+e+'" name="Massrows['+numberrow+'][1][]"></textarea></div><button style="width:30px; height:30px; margin-top:25px; text-align:centre; font-size:10px" type="button" id="remove_address" class="btn btn-danger col-2">X</button></div>');
    })
    $(document).on('click','#remove_address', function(){ 
               $(this).closest('.row').remove();
            });
    //Конец Добавление и удаление адреса сайтата

    //Добавление и удаление адреса сайтата
    var s=0;
    $(document).on('click','#add_sayt',function(){
        ++s;
        var numberrow=$(this).attr("name");
        $(this).before('<div class="row" style="margin-bottom:5px"><div class="col-10"><textarea class="form-control" id="textsayt'+s+'" name="Massrows['+numberrow+'][2][]"></textarea></div><button style="width:30px; height:30px; margin-top:25px; text-align:centre; font-size:10px" type="button" id="remove_address" class="btn btn-danger col-2">X</button></div>');
    })
    $(document).on('click','#remove_sayt', function(){ 
               $(this).closest('.row').remove();
            });
    //Конец Добавление и удаление адреса сайтата
    
    
    //вверх  
    $(document).on('click','#btn_up', function(){ 
              var idrow=$(this).closest('.row').attr("id"); 
              if($("#"+idrow).prev().attr("id")=='no'){}
              else{
                // Код для кнопки вверх у самого низа для активации кнопки вниз
                if($("#"+idrow).next().attr("id")=='div_add_row')
                        {
                            $(this).prev().addClass("btn-danger");// вовращаю кнопке вниз стиль активной
                            $("#"+idrow).prev().find("#btn_down").removeClass('btn-danger');// удаляю у верхней кнопки вниз класс
                            $("#"+idrow).prev().find("#btn_down").css({'background-color':'blue'});// даю кнопке вниз у верхнего блока стиль неактивной
                        }

                    $("#"+idrow).after($('#'+idrow).prev());

                    // Код для кнопки вверх пришедшей с самого верха
                    if($("#"+idrow).prev().attr("id")=='no')
                    {
                        $(this).removeClass("btn-danger");// удаляю у текущей кнопке вверх класс
                        $(this).css({'background-color':'blue'});// даю текущей кнопке вверх стиль неактивной
                        $("#"+idrow).next().find("#btn_up").addClass('btn-danger');// даю кнопке вверх у нижнего блока стиль активной
                    }
                }
             });
    //конец ввверх

    //вниз
    $(document).on('click','#btn_down', function(){
              var idrow=$(this).closest('.row').attr("id");
              if($("#"+idrow).next().attr("id")=='div_add_row'){} 
                    else{
                        // Код для кнопки вниз у самого верха для активации кнопки вверх
                        if($("#"+idrow).prev().attr("id")=='no')
                        {
                            $(this).next().addClass("btn-danger");//вовращаю кнопке вверх стиль активной
                            $("#"+idrow).next().find("#btn_up").removeClass('btn-danger');// удаляю у нижнего блока для кнопки вверх класс
                            $("#"+idrow).next().find("#btn_up").css({'background-color':'blue'});// даю кнопке вверх следующего блока стиль неактивной
                        }
                        
                        $("#"+idrow).before($('#'+idrow).next());

                        // Код для деактивации кнопки вниз пришедшей в конец списка
                        if($("#"+idrow).next().attr("id")=='div_add_row')
                        {
                            $(this).removeClass("btn-danger");// удаляю у текущей кнопке вниз класс
                            $(this).css({'background-color':'blue'});// даю текущей кнопке вниз стиль неактивной
                            $("#"+idrow).prev().find("#btn_down").addClass('btn-danger');// даю кнопке вниз у верхнего блока стиль активной
                        }
                    }
             });
    //конец вниз
});
</script>