$(document).ready(function () {
    $(document).on('click', '#add_row_tabel', function () {
        k = Number($("#count_rows_tabels").attr("value"));
        r = Number($(this).attr("value"));
        $(document).find("#count_rows_tabels").val(k + 1);
        $(this).closest("div").before('<input type="hidden" name="tableobj['+k+'][0][]" value=0><input type="hidden" name="tableobj['+k+'][0][]" value="'+r+'"><div class="row oform_row temporarystyle"><div class="col-sm-2"><label for="Code">Код</label><input type="hidden" name="tableobj['+k+'][0][]" value=76><input type="text" class="form-control margin_for_code" id="Code" name="tableobj['+k+'][0][]" required></div><div class="col-sm-3"><label for="NameProfession">Наименование профессии, специальности, в том числе научной, направления подготовки</label><input type="hidden" name="tableobj['+k+'][0][]" value=77><input type="text" class="form-control input_margin_top_whit_short_text" id="NameProfession" name="tableobj['+k+'][0][]" required></div><div class="col-sm-3"><label for="EducationalProgramme">Образовательная программа, направленность, профиль, шифр и наименование научной специальности</label><input type="hidden" name="tableobj['+k+'][0][]" value=78><input type="text" class="form-control input_margin_top_whit_short_text" id="EducationalProgramme" name="tableobj['+k+'][0][]"></div><div class="col-sm-2"><label for="NumberGraduates">Численность выпускников прошлого учебного года</label><input type="hidden" name="tableobj['+k+'][0][]" value=79><input type="number" min="0" class="form-control input_margin_top_whit_short_text" id="NumberGraduates" name="tableobj['+k+'][0][]"></div><div class="col-sm-2"><label for="NumberEmployed">Численность трудоустроенных выпускников прошлого учебного года</label><input type="hidden" name="tableobj['+k+'][0][]" value=80><input type="number" min="0"class="form-control input_margin_top_whit_long_text" id="NumberEmployed" name="tableobj['+k+'][0][]"></div><button type="button" id="delrowtabel" class="btn btn-danger delbutton" tabindex="-1">X</button></div>');
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
})