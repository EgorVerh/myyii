$(document).ready(function(){
    $('#add_row').click(function(){
        var i=0;
        var k;
        if (typeof $('#add_row').prev().attr("value") !== 'undefined')
        {
            k=Number($('#add_row').prev().attr("value"))+1;
            $('#add_row').before('<div class="row scriptrow same_background" value='+k+'><b>Назначение документа</b><textarea class="form-control" name="Textarea[]"  placeholder = "Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."></textarea><div class="col-md-11"><label class="control-label" for="File'+k+'">Документ для загрузки</label><input type="hidden" name="upload_file['+k+']" value=""><input type="file" id="File'+k+'" class="form-control file-loading" name="upload_file[]" multiple="" data-krajee-fileinput="fileinput_4efc2035"></div><button type="button" id="remove_row_form3" class="btn btn-danger col-md-1">X</button></div>');
        }
        else
        {
            $('#add_row').before('<div class="row scriptrow same_background" value='+i+'><b>Назначение документа</b><textarea class="form-control" name="Textarea[]"  placeholder = "Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."></textarea><div class="col-md-11"><label class="control-label" for="File'+i+'">Документ для загрузки</label><input type="hidden" name="upload_file['+i+']" value=""><input type="file" id="File'+i+'" class="form-control file-loading" name="upload_file[]" multiple="" data-krajee-fileinput="fileinput_4efc2035"></div><button type="button" id="remove_row_form3" class="btn btn-danger col-md-1">X</button></div>');
        }
    })
$(document).on('click','#remove_row_form3', function(){ 
        $(this).closest('.row').remove();
    });
})

