<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;
AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/form3.js');
$this->registerCssFile('@modulestakedatamcss/form3.css');
?>

<h2>Редактирование страницы</h2>
<p>ФГБОУ ВО &laquo;ВГСПУ&raquo;</p>
<form method="post" enctype="multipart/form-data" class="samebackground">
    <div class="row samebackground">
    <b class="col-md-3 samebackground">Устав образовательной организации</b>
    <div id="div_add_row" class="col-md-9">
        <?php
        if(isset($_FILES['upload_file']) && $_FILES['upload_file']['name'][0]!='')
        {
            $i=0;
            foreach ($_FILES['upload_file']['name'] as $file => $name)
            {
                echo '<div class="row scriptrow samebackground"><div class="col-md-11"><label class="control-label" for="File'.$i.'"><a href="downloads/Устав.pdf" download>'.$_POST['Textarea'][$i].'</a></label><input type="hidden" name="upload_file[]" value=""><input type="file" id="File'.$i.'" class="form-control file-loading" name="upload_file[]" multiple="" data-krajee-fileinput="fileinput_4efc2035">
                </div><button type="button" id="remove_row" class="btn btn-danger col-md-1">X</button></div>';
                $i++;
            }   
        }
        ?>
        <button type="button" id="add_row" class="btn btn-success">+ Добавить</button></div>
    </div>
    <div class="borderrow"></div>
    <div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
</form>