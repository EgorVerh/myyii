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
            if (isset($tabledata)) {
                $i = 0;
                foreach ($tabledata as $table) { ?>
                    <div class="row scriptrow samebackground" type value=<?php echo $i ?>><b>Назначение документа</b>
                        <textarea class="form-control" name="Textarea[]"
                            placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"]?></textarea>
                        <?php if ($table["Link"] == '') { ?>
                            <div class="col-md-11"><label class="control-label" for="File<?php echo $i ?>">Документ для
                                    загрузки</label><input type="hidden" name="upload_file[<?php echo $i ?>]" value=<?php echo $table["Position"] ?>><input type="file" id="File<?php echo $i ?>"
                                    class="form-control file-loading" name="upload_file[]" multiple="" data-krajee-fileinput="fileinput_4efc2035">
                            <?php } else { ?>
                                <div class="labeloform"><a target="_blank" href="<?php echo $table["Link"] ?>">Ссылка на загруженный
                                        файл</a></div>
                                <div class="col-md-11"><label class="control-label" for="File<?php echo $i ?>">Заменить загруженный
                                        файл</label><input type="hidden" name="upload_file[<?php echo $i ?>]" value=<?php echo $table["Position"] ?>><input type="file" id="File<?php echo $i ?>"
                                        class="form-control file-loading" name="upload_file[]" multiple=""
                                        data-krajee-fileinput="fileinput_4efc2035">
                                <?php } ?>
                            </div>
                            <?php echo Html::a('X', ['/deleteform3', 'post' => $table["Position"]], ['type' => 'button', 'id' => 'remove_row', 'class' => 'btn btn-danger col-md-1']); ?>
                        </div>
                        <?php $i++;
                }
            }
            ?>
                <button type="button" id="add_row" class="btn btn-success">+ Добавить</button>
            </div>
        </div>
        <div class="borderrow"></div>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
</form>