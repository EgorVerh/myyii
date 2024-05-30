$(document).ready(function () {
    $(document).on('click', '#add_row', function () {
        k = Number($("#count_row").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_row").val(k + 1);
        $(this).closest("div").before('<div class="row oform_row" value=' + k + '><input type = "hidden" name = "document[' + k + '][]" value = 0 ><input type="hidden" name="document[' + k + '][]" value=' + r + '><div class="col-sm-11"><label for="document_purpose'+ k +'"> Назначение докумета</label><input class="form-control" type="text" name="document[' + k + '][]" placeholder="Назначение документа:Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д." required><div><br><label class="control-label" for="File' + k + '">Документ для загрузки</label><input type="file" id="File' + k + '" class="form-control file-loading" name="document[' + k + ']" multiple="" data-krajee-fileinput="fileinput_4efc2035"></div></div><div><button type="button" id="delrow" class="btn btn-danger delbutton", tabindex="-1">X</button></div></div>');
    });
    $(document).on('click', '#delrow', function () {
        k = Number($("#count_row").attr("value"));
        $(document).find("#count_row").val(k - 1);
        $(this).closest('.row').remove();
    });
})

