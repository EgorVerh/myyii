$(document).ready(function () {
    $(document).on('click', '#add_row', function () {
        k = Number($("#count_row").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_row").val(k + 1);
        $(this).closest("div").before('<div class="row oform_row" value=' + k + '><input type="hidden" name="paid_educational[' + k + '][]" value="0"><input type="hidden" name="paid_educational[' + k + '][]" value=' + r + '><div class="col-sm-11"><label for="text'+k+'">Название для ссылки</label><input class="no_wrong_input" type="text" name="paid_educational[' + k + '][]" placeholder="Статья" required><br><label for="url'+k+'">Ссылка</label><input class="no_wrong_input" type="url" name="paid_educational[' + k + '][]" placeholder="https://example.com" pattern="https://.*" required></div><div><button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1">X</button></div></div>');
    });
    $(document).on('click', '#delrow', function () {
        if (($(this).attr("value") != null)) {
            if (confirm('Удалить?')) {
                k = Number($("#count_row").attr("value"));
                $(document).find("#count_row").val(k - 1);
                $(this).closest('.row').remove();
                var data = $('form').serialize();
                $.ajax({
                    url: $(this).attr("value"),
                    type: 'POST',
                    data: data,
                });
            }
        }else {
            k = Number($("#count_row").attr("value"));
            $(document).find("#count_row").val(k - 1);
            $(this).closest('.row').remove();
        }
    });
    $(document).on('click', '#hide_button', function () {
        if (($(this).attr("value") != null)) {
            if (confirm('Скрыть файл?')) {
                k = Number($("#count_row").attr("value"));
                $(document).find("#count_row").val(k - 1);
                $(this).closest('.row').remove();
                var addenabledval = {
                    enabled: 1
                };
                var data = $('form').serialize() + '&' + $.param(addenabledval);
                $.ajax({
                    url: $(this).attr("value"),
                    type: 'POST',
                    data: data,
                });
            }
        }
    })
});   
