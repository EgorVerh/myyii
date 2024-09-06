$(document).ready(function () {
    $(document).on('click', '#add_row', function () {
        k = Number($("#count_row").attr("value"));
        $(document).find("#count_row").val(k + 1);
        $(this).closest("div").before('<div class="row oform_row temporarystyle" value=' + k + '><input type="hidden" name="inter[' + k + '][0][]" value=0><input type="hidden" name="inter[' + k + '][0][]" value=31><div class="col-sm-3"><label for="NameofState">Название государства</label><input type="text"class="form-control label_text" id="NameofState" name="inter[' + k + '][0][]"placeholder="Название государства" required></div><div class="col-sm-4"><label for="NameoftheOrganisation">Наименование организации</label><input type="text"class="form-control label_text" id="NameoftheOrganisation" name="inter[' + k + '][0][]"placeholder="Наименование организации" required></div><div class="col-sm-5"><label for="ContractDetails">Реквизиты договора</label><div class="rightbuttonposition_text"><button type="button" id="add_dop" class="btn btn-success">+Добавить</button></div></div><button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1">X</button></div>');
    });
    $(document).on('click', '#add_dop', function () {
        k = Number($(this).closest(".row").attr("value"));
        $(this).closest("div").before('<div class="row rightbuttonposition margin_for_dop"><div class="col-sm-9"><input type="text" class="form-control input_margin_extra_phone "id="ContractDetails" name="inter[' + k + '][1][]" placeholder="Реквизиты договора"></div><div class="col-sm-3"><button type="button" id="delrow" name="false" class="btn btn-danger delbutton margin_for_dop" tabindex="-1">X</button></div></div>');
    });
    $(document).on('click', '#delrow', function () {
        if (($(this).attr("value") != null) && ($(this).attr("name") != "false")) {
            if (confirm('Удалить?')) {
                $csfr = $('#csfr').attr("value");
                k = Number($("#count_row").attr("value"));
                $(document).find("#count_row").val(k - 1);
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
            if ($(this).attr("name") != "false") {
                k = Number($("#count_row").attr("value"));
                $(document).find("#count_row").val(k - 1);
                $(this).closest('.row').remove();
            } else {
                if (($(this).attr("value") != null)) {
                    if (confirm('Удалить?')) {
                        $csfr = $('#csfr').attr("value");
                        $(this).closest('.row').remove();
                        var add_data = {
                            id:$(this).attr("value"),
                            name:$(this).attr("name")
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
                } else { $(this).closest('.row').remove(); }
            }
        }
    });
    $('form').on('submit', function () {
        $('button[type="submit"]').prop('disabled', true);
    })
})

