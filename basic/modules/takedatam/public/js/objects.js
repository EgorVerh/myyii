$(document).ready(function () {
    $(document).on('click', '#add_url', function () {
        k = Number($("#count_url").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_url").val(k + 1);
        $(this).closest("div").before('<div class="row oform_row" value=' + k + '><input type="hidden" name="paid_educational[' + k + '][]" value="0"><input type="hidden" name="paid_educational[' + k + '][]" value=' + r + '><div class="col-sm-11"><label for="text'+k+'">Название для ссылки</label><input class="no_wrong_input" type="text" name="paid_educational[' + k + '][]" placeholder="Статья" required><br><label for="url'+k+'">Ссылка</label><input class="no_wrong_input" type="url" name="paid_educational[' + k + '][]" placeholder="https://example.com" pattern="https://.*" required></div><div><button type="button" id="delurl" class="btn btn-danger delbutton" tabindex="-1">X</button></div></div>');
    });
    $(document).on('click', '#delurl', function () {
        if (($(this).attr("value") != null)) {
            if (confirm('Удалить?')) {
                k = Number($("#count_url").attr("value"));
                $(document).find("#count_url").val(k - 1);
                $(this).closest('.row').remove();
                var data = $('form').serialize();
                $.ajax({
                    url: '/delete_objects',
                    type: 'POST',
                    data: data,
                });
            }
        }else {
            k = Number($("#count_url").attr("value"));
            $(document).find("#count_url").val(k - 1);
            $(this).closest('.row').remove();
        }
    });
    $(document).on('click', '#hide_url', function () {
        if (($(this).attr("value") != null)) {
            if (confirm('Скрыть файл?')) {
                k = Number($("#count_url").attr("value"));
                $(document).find("#count_url").val(k - 1);
                $(this).closest('.row').remove();
                var addenabledval = {
                    enabled: 1
                };
                var data = $('form').serialize() + '&' + $.param(addenabledval);
                $.ajax({
                    url: '/delete_objects',
                    type: 'POST',
                    data: data,
                });
            }
        }
    })
    $(document).on('click', '#add_row_tabel', function () {
        k = Number($("#count_rows_tabels").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_rows_tabels").val(k + 1);
        $(this).closest("div").before('<input type="hidden" name="tableobj['+k+'][0][]" value=0><input type="hidden" name="tableobj['+k+'][0][]" value="'+r+'"><div class="row oform_row temporarystyle"><div class="col-sm-3"><label for="NameObject"> Наименование объекта</label><input type="hidden" name="tableobj['+k+'][0][]" value=51><input type="text" class="form-control input_margin_top_whit_short_text" id="NameObject" name="tableobj['+k+'][0][]" required></div><div class="col-sm-3"><label for="LegaLaddressFounder">Адрес места нахождения объекта</label><input type="hidden" name="tableobj['+k+'][0][]" value=52><input type="text" class="form-control input_margin_top_whit_long_text" id="LegaLaddressFounder" name="tableobj['+k+'][0][]" required></div><div class="col-sm-2"><label for="Square">Площадь объекта</label><input type="hidden" name="tableobj['+k+'][0][]" value=53><input type="number" min="0" step="0.01" class="form-control input_margin_top_whit_short_text" id="Square" name="tableobj['+k+'][0][]"></div><div class="col-sm-2"><label for="Amount">Количество мест</label><input type="hidden" name="tableobj['+k+'][0][]" value=54><input type="number" min="0" class="form-control input_margin_top_whit_short_text" id="Amount" name="tableobj['+k+'][0][]"></div><div class="col-sm-2"><label for="OVZ">Приспособленность для лиц с ОВЗ</label><input type="hidden" name="tableobj['+k+'][0][]" value=55><input type="number" min="0" max="2" class="form-control input_margin_top_whit_long_text" id="OVZ" name="tableobj['+k+'][0][]"></div><button type="button" id="delrowtabel" class="btn btn-danger delbutton" tabindex="-1">X</button></div>');
});
    $(document).on('click', '#delrowtabel', function () {
        if (($(this).attr("value") != null)) {
            if (confirm('Удалить?')) {
                $csfr = $('#csfr').attr("value");
                k = Number($("#count_rows_tabels").attr("value"));
                $(document).find("#count_rows_tabels").val(k - 1);
                $(this).closest('.row').remove();
                var add_data = {
                    id:$(this).attr("value")
                };
                $.ajaxSetup({
                    headers: { 'X-CSRF-Token': $csfr }
                });
                var data = $.param(add_data);
                $.ajax({
                    url: '/delete_inter',
                    type: 'POST',
                    data: data,
                });
            }
        } else {
                k = Number($("#count_rows_tabels").attr("value"));
                $(document).find("#count_rows_tabels").val(k - 1);
                $(this).closest('.row').remove();
        }
    });
    $('form').on('submit',function(){
        $('button[type="submit"]').prop('disabled', true);
    })
})

