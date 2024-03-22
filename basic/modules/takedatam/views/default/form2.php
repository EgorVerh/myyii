<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
use frontend\modules\takedatam\assets\AppAsset;
AppAsset::register($this);
//стиль дисплей блок
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/form2.js');
$this->registerCssFile('@modulestakedatamcss/form2.css');
?>
<h4><b>Сведения о каждом учредителе образовательной организации</h4>
<div class="row" id="no">
<div class="col-sm-3 hightrow"><b >Наименование учредителя образовательной организации</b></div>
<div class="col-sm-2 hightrow"><b>Юридический адрес учредителя</b></div>
<div class="col-sm-2 hightrow"><b>Контактный телефон учредителя</b></div>
<div class="col-sm-3 hightrow"><b>Адрес электронной почты учредителя</b></div>
<div class="col-sm-2 hightrow"><b>Адрес сайта учредителя в сети &laquo;Интернет&raquo;</b></div>
</div>  
<form>
    <!-- Проверка на введенные данные, если есть то будут показаны -->
    <!-- Доделать кнопки -->
    <?php
     $get=Yii::$app->request->get('Massrows');
     if(isset($get))
    {
        $i=1;
        $e=1;
        $s=1;
        foreach($get as $row){
        echo'<div class="row scriprow" id="row'.$i.'"><div class="col-sm-1"><ul><li><button type="button" id="btn_up" class="btn scripbtn">^</button></li><li><button type="button" id="btn_down" class="btn scripbtn">v</button></li><li><button type="button" id="remove_row" class="btn btn-danger">X</button></li></ul></div><div class="col-sm-2"><textarea class="form-control" id="Textarea1" name="Massrows['.$i.'][0][]">'.$row[0][0].'</textarea></div><div class="col-sm-2"><textarea class="form-control" id="Textarea2" name="Massrows['.$i.'][0][]">'.$row[0][1].'</textarea></div><div class="col-sm-2"><textarea class="form-control" id="Textarea3" name="Massrows['.$i.'][0][]">'.$row[0][2].'</textarea></div>';
        
        echo'<div class="col-sm-3 idsaytaddress" id="address">';
        if(isset($row[1])){
        foreach($row[1] as $row1)
        {
            echo '<div class="row textsaytaddres"><div class="col-sm-10"><textarea class="form-control" id="textaddres'.$e.'" name="Massrows['.$i.'][1][]">'.$row1.'</textarea></div><button type="button" id="remove_address" class="btn btn-danger col-sm-2">X</button></div>';
            $e++;
        }
    }
        echo'<button type="button" id="add_address" class="btn btn-success" name="'.$i.'">+ Добавить</button></div>';

        echo'<div class="col-sm-2 idsaytaddress" id="sayt">';
        if(isset($row[2])){
            foreach($row[2] as $row2)
                {
                    echo'<div class="row textsaytaddres"><div class="col-sm-10"><textarea class="form-control" id="textsayt'.$s.'" name="Massrows['.$i.'][2][]">'.$row2.'</textarea></div><button type="button" id="remove_address" class="btn btn-danger col-sm-2">X</button></div>';
                }
        }
        echo'<button type="button" id="add_sayt" class="btn btn-success" name="'.$i.'">+ Добавить</button></div></div>';
        $i++;
    }
    }
    ?>
<div id="div_add_row"><button type="button" id="add_row" class="btn btn-success">+ Добавить</button></div>
<div class="form-group">
<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>
</form>
<!-- Подключение скриптов и сами скрипты -->
