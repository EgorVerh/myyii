$(document).ready(function(){
    // Добавление и удаление главной строки
    $("#add_row").click(function(){
        var k;
        if (typeof $('#div_add_row').prev().attr("value") !== 'undefined')
        {
            k=Number($('#div_add_row').prev().attr("value"))+1;
            $("#div_add_row").before('<div class="row scriprow" id="0" value='+k+'><div class="col-sm-1"><ul><li><button type="button" id="btn_up" class="btn scripbtn">^</button></li><li><button type="button" id="btn_down" class="btn scripbtn">v</button></li><li><button type="button" id="remove_row" class="btn btn-danger">X</button></li></ul></div><input type="hidden" name="id[]" value="0"><div class="col-sm-2"><textarea class="form-control" id="Textarea1" name="Massrows['+k+'][0][]"></textarea></div><div class="col-sm-2"><textarea class="form-control" id="Textarea2" name="Massrows['+k+'][0][]"></textarea></div><div class="col-sm-2"><textarea class="form-control" id="Textarea3" name="Massrows['+k+'][0][]"></textarea></div><div class="col-sm-3 idsaytaddress" id="address"><button type="button" id="add_address" class="btn btn-success" name="'+k+'">+ Добавить</button></div><div class="col-sm-2 idsaytaddress" id="sayt"><button type="button" id="add_sayt" class="btn btn-success" name="'+k+'">+ Добавить</button></div></div>');
        }
        else
        {
            $("#div_add_row").before('<div class="row scriprow" id="0" value="0"><div class="col-sm-1"><ul><li><button type="button" id="btn_up" class="btn scripbtn">^</button></li><li><button type="button" id="btn_down" class="btn scripbtn">v</button></li><li><button type="button" id="remove_row" class="btn btn-danger">X</button></li></ul></div><input type="hidden" name="id[]" value="0"><div class="col-sm-2"><textarea class="form-control" id="Textarea1" name="Massrows[0][0][]"></textarea></div><div class="col-sm-2"><textarea class="form-control" id="Textarea2" name="Massrows[0][0][]"></textarea></div><div class="col-sm-2"><textarea class="form-control" id="Textarea3" name="Massrows[0][0][]"></textarea></div><div class="col-sm-3 idsaytaddress" id="address"><button type="button" id="add_address" class="btn btn-success" name="0">+ Добавить</button></div><div class="col-sm-2 idsaytaddress" id="sayt"><button type="button" id="add_sayt" class="btn btn-success" name="0">+ Добавить</button></div></div>');
        }
        
        // Стиль для вставки самой первой строки
        // if($("#row"+i).prev().attr("id")=="no")
        // {
        //     $("#row"+i).find("#btn_up").removeClass("btn-danger");
        //     $("#row"+i).find("#btn_up").css({'background-color':'blue'}); 
        // }

        // // Смена стиля кнопок строки после вставки новой
        // if($("#row"+i).prev().prev().attr("id")=="no")
        // {
        //     $("#row"+i).prev().find("#btn_down").addClass("btn-danger");
           
        // }
        // else
        // {
        //     $("#row"+i).prev().find("#btn_up").addClass("btn-danger");
        //     $("#row"+i).prev().find("#btn_down").addClass("btn-danger");
        // }
    });
    $(document).on('click','#remove_row', function(){ 
               $(this).closest('.row').remove();
             });
    //Конец Добавления и удаления главной строки( нужно доработать для смены стиля кнопок в зависимости от оставшихся строк)

    //Добавление и удаление адреса почты
    $(document).on('click','#add_address',function(){
        var i=0;
        var k;
        var numberrow=$(this).attr("name");
        if (typeof $(this).prev().attr("value") !== 'undefined')
        {
            k=Number($(this).prev().attr("value"))+1;
            $(this).before('<div class="row textsaytaddres"  value='+k+'><div class="col-sm-10"><textarea class="form-control" id="textaddres'+k+'"name="Massrows['+numberrow+'][1][]"></textarea></div><button type="button" id="remove_address" class="btn btn-danger col-sm-2">X</button></div>');
        }
        else
        {
            $(this).before('<div class="row textsaytaddres" value='+i+'><div class="col-sm-10"><textarea class="form-control" id="textaddres'+i+'"  name="Massrows['+numberrow+'][1][]"></textarea></div><button type="button" id="remove_address" class="btn btn-danger col-sm-2">X</button></div>');
        }
    })
    $(document).on('click','#remove_address', function(){ 
               $(this).closest('.row').remove();
            });
    //Конец Добавление и удаление адреса сайтата

    //Добавление и удаление адреса сайтата
    $(document).on('click','#add_sayt',function(){
        var i=0;
        var k;
        var numberrow=$(this).attr("name");
        if (typeof $(this).prev().attr("value") !== 'undefined')
        {
            k=Number($(this).prev().attr("value"))+1;
            $(this).before('<div class="row textsaytaddres" value='+k+'><div class="col-sm-10"><textarea class="form-control" id="textsayt'+k+'" name="Massrows['+numberrow+'][2][]"></textarea></div><button type="button" id="remove_address" class="btn btn-danger col-sm-2">X</button></div>');
        }
        else
        {
            $(this).before('<div class="row textsaytaddres" value='+i+'><div class="col-sm-10"><textarea class="form-control" id="textsayt'+i+'" name="Massrows['+numberrow+'][2][]"></textarea></div><button type="button" id="remove_address" class="btn btn-danger col-sm-2">X</button></div>');
        }   
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