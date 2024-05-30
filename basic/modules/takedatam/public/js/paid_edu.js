$(document).ready(function () {
    $(document).on('click', '#add_row', function () {
        k = Number($("#count_row").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_row").val(k + 1);
        $(this).closest("div").before('<div class="row oform_row" value=' + k + '><input type="hidden" name="paid_educational[' + k + '][]" value="0"><input type="hidden" name="paid_educational[' + k + '][]" value=' + r + '><div class="col-sm-11"><label for="text'+k+'">Название для ссылки</label><input type="text" name="paid_educational[' + k + '][]" placeholder="Статья" required><br><label for="url'+k+'">Ссылка</label><input type="url" name="paid_educational[' + k + '][]" placeholder="https://example.com" pattern="https://.*" required></div><div><button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1">X</button></div></div>');
    });
    $(document).on('click', '#delrow', function () {
        k = Number($("#count_row").attr("value"));
        $(document).find("#count_row").val(k - 1);
        $(this).closest('.row').remove();
    });
});
