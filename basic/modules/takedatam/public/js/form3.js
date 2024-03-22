$(document).ready(function(){
    var i=0;
    $('#add_row').click(function(){
        $('#add_row').before('<div class="row scriptrow samebackground"><b>Назначение документа</b><textarea class="form-control" name="Textarea[]"  placeholder = "Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."></textarea><div class="col-md-11"><label class="control-label" for="File'+i+'">Документы для загрузки</label><input type="hidden" name="upload_file[]" value=""><input type="file" id="File'+i+'" class="form-control file-loading" name="upload_file[]" multiple="" data-krajee-fileinput="fileinput_4efc2035"></div><button type="button" id="remove_row" class="btn btn-danger col-md-1">X</button></div>');
        ++i;
    })
$(document).on('click','#remove_row', function(){ 
        $(this).closest('.row').remove();
    });
})

