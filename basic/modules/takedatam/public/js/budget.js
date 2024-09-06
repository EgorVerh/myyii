$(document).ready(function () {
    $(document).on('click', '#add_doc', function () {
        k = Number($("#count_doc").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_doc").val(k + 1);
        $(this).closest("div").before('<div class="row oform_row" value=' + k + '><input type = "hidden" name = "document[' + k + '][]" value = 0 ><input type="hidden" name="document[' + k + '][]" value=' + r + '><div class="col-sm-11"><label for="document_purpose' + k + '"> Назначение докумета</label><input class="form-control no_wrong_input" type="text" name="document[' + k + '][]" placeholder="Назначение документа:Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д." required><div><br><label class="control-label" for="File' + k + '">Документ для загрузки</label><input type="file" id="File' + k + '" class="form-control file-loading"  name="document[' + k + ']" accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"></div></div><div><button type="button" id="deldoc" class="btn btn-danger delbutton", tabindex="-1">X</button></div></div>');
    });
    $(document).on('click', '#deldoc', function () {
        if (($(this).attr("value") != null)) {
            if (confirm('Удалить?')) {
                k = Number($("#count_doc").attr("value"));
                $(document).find("#count_doc").val(k - 1);
                $(this).closest('.row').remove();
                var addwhatisurl = {
                    whatisurl: $("#whatisurl").attr("value")
                };
                var data = $('form').serialize() + '&' + $.param(addwhatisurl);
                $.ajax({
                    url: '/delete_document',
                    type: 'POST',
                    data: data,
                });
            }
        } else {
            k = Number($("#count_doc").attr("value"));
            $(document).find("#count_doc").val(k - 1);
            $(this).closest('.row').remove();
        }
    });
    $(document).on('click', '#hide_doc', function () {
        if (($(this).attr("value") != null)) {
            if (confirm('Скрыть файл?')) {
                k = Number($("#count_doc").attr("value"));
                $(document).find("#count_doc").val(k - 1);
                $(this).closest('.row').remove();
                var addenabledval = {
                    enabled: 1
                };
                var addwhatisurl = {
                    whatisurl: $("#whatisurl").attr("value")
                };
                var data = $('form').serialize() + '&' + $.param(addenabledval)+ '&' + $.param(addwhatisurl);
                $.ajax({
                    url: '/delete_document',
                    type: 'POST',
                    data: data
                });
            }
        }
    });
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
                    url: '/delete_budget',
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
                    url: '/delete_budget',
                    type: 'POST',
                    data: data,
                });
            }
        }
    })
    $(document).on('click', '#add_report', function () {
        k = Number($("#count_report").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_report").val(k + 1);
        $(this).closest("div").before('<div class="row oform_row temporarystyle"><input type="hidden" name="report['+k+'][]" value="0"><input type="hidden" name="report['+k+'][]" value=44><div class="col-sm-1"><label for="YearReporting" class="label_size">Год отчетности</label><input type="number" id="YearReporting" name="report['+k+'][]"></div><div class="col-sm-5"><label for="Income" class="label_size">Информация о поступлении финансовых и материальных средств</label><input type="hidden" name="report['+k+'][]"><input type="number" id="Income" name="report['+k+'][]" step="0.01"></div><div class="col-sm-5"><label for="Expenditure" class="label_size">Информация о расходовании финансовых и материальных средств</label><input type="hidden" name="report['+k+'][]"><input type="number" id="Expenditure" name="report['+k+'][]" step="0.01"></div><div class="col-sm-1"><button type="button" id="delreport" class="btn btn-danger delbutton" tabindex="-1">X</button></div></div>');});
    $(document).on('click', '#delreport', function () {
        if (($(this).attr("value") != null)) {
            if (confirm('Удалить?')) {
                $csfr = $('#csfr').attr("value");
                k = Number($("#count_report").attr("value"));
                $(document).find("#count_report").val(k - 1);
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
                k = Number($("#count_report").attr("value"));
                $(document).find("#count_report").val(k - 1);
                $(this).closest('.row').remove();
        }
    });
    $('form').on('submit',function(){
        $('button[type="submit"]').prop('disabled', true);
    })
})

