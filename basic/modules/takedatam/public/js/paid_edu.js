$(document).ready(function () {
    $(document).on('click', '#add_row', function () {
        k = Number($("#count_row").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_row").val(k + 1);
        $(this).before('<div class="row" value=' + k + '><input type="hidden" name="paid_educational[' + k + '][]" value="0"><input type="hidden" name="paid_educational[' + k + '][]" value=' + r + '><div class="col-sm-1"><button type="button" id="delrow" class="btn btn-danger">X</button></div><div class="col-sm-11"><textarea name="paid_educational[' + k + '][]" placeholder="Название для ссылки" style="width:100%;height:45px;"></textarea><textarea name="paid_educational[' + k + '][]" placeholder="Вставьте ссылку" style="width:100%;height:45px;"></textarea></div></div>');
    });
    $(document).on('click', '#delrow', function () {
        k = Number($("#count_row").attr("value"));
        $(document).find("#count_row").val(k - 1);
        $(this).closest('.row').remove();
    });
});
