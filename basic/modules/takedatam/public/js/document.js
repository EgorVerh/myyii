$(document).ready(function () {
    $(document).on('click', '#add_row', function () {
        k = Number($("#count_row").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_row").val(k + 1);
        $(this).before('<div class="row temporarystyle" value=' + k + '><input type = "hidden" name = "document[' + k + '][]" value = 0 ><input type="hidden" name="document[' + k + '][]" value=' + r + '><div class="col-sm-1"><button type="button" id="delrow" class="btn btn-danger">X</button></div><div class="col-sm-11"><textarea class="form-control" name="document[' + k + '][]" placeholder="Назначение документа:Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."></textarea><div class="col-md-11"><label class="control-label" for="File' + k + '">Документ для загрузки</label><input type="file" id="File' + k + '" class="form-control file-loading" name="document[' + k + ']" multiple="" data-krajee-fileinput="fileinput_4efc2035"></div></div></div>');
    });
    $(document).on('click', '#delrow', function () {
        k = Number($("#count_row").attr("value"));
        $(document).find("#count_row").val(k - 1);
        $(this).closest('.row').remove();
    });
})

