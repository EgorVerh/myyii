$(document).ready(function () {
    $(document).on('click', '#add_expand', function () {
        if (typeof $(this).prev().attr("value") !== 'undefined') {
            $rownumber = Number($(this).prev().attr("value")) + 1;
            $(this).before('<div class="row" value="' + $rownumber + '"><input type="hidden" name="id[]" value="0"><div class="col-sm-1"><button type="button" id="delrow" class="btn btn-danger">X</button></div><div class="col-sm-11"><textarea name="Fildsurl[' + $rownumber + '][]"  placeholder="Название для ссылки" style="width:100%;height:45px;"></textarea><textarea name="Fildsurl[' + $rownumber + '][]"  placeholder="Вставьте ссылку" style="width:100%;height:45px;"></textarea></div></div>');
        } else {
            $(this).before('<div class="row" value="0"><input type="hidden" name="id[]" value="0"><div class="col-sm-1"><button type="button" id="delrow" class="btn btn-danger">X</button></div><div class="col-sm-11"><textarea name="Fildsurl[0][]"  placeholder="Название для ссылки" style="width:100%;height:45px;"></textarea><textarea name="Fildsurl[0][]"  placeholder="Вставьте ссылку" style="width:100%;height:45px;"></textarea></div></div>');
        }
    })
    $(document).on('click', '#delrow', function () {
        $(this).closest('.row').remove();
    })
});