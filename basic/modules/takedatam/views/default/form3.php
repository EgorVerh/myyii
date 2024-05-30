<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/form3.js');
$this->registerCssFile('@modulestakedatamcss/styles.css');
?>

<h2>Редактирование страницы</h2>
<p>ФГБОУ ВО &laquo;ВГСПУ&raquo;</p>
<form method="post" enctype="multipart/form-data" class="same_background">
    <div class="row same_background">
        <b class="col-md-3 same_background">Устав образовательной организации</b>
        <div id="div_add_row_form3" class="col-md-9 div_add_row">
            <?php
            if (isset($tabledata)) {
                $i = 0;
                foreach ($tabledata as $table) { ?>
                    <div class="row scriptrow same_background" type value=<?php echo $i ?>><b>Назначение документа</b>
                        <textarea class="form-control" name="Textarea[]"
                            placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"]?></textarea>
                        <?php if ($table["Link"] == '') { ?>
                            <div class="col-md-11"><label class="control-label" for="File<?php echo $i ?>">Документ для
                                    загрузки</label><input type="hidden" name="upload_file[<?php echo $i ?>]" value=<?php echo $table["Position"] ?>><input type="file" id="File<?php echo $i ?>"
                                    class="form-control file-loading" name="upload_file[]" multiple="" data-krajee-fileinput="fileinput_4efc2035">
                            <?php } else { ?>
                                <div class="label_oform"><a target="_blank" href="<?php echo $table["Link"] ?>">Ссылка на загруженный
                                        файл</a></div>
                                <div class="col-md-11"><label class="control-label" for="File<?php echo $i ?>">Заменить загруженный
                                        файл</label><input type="hidden" name="upload_file[<?php echo $i ?>]" value=<?php echo $table["Position"] ?>><input type="file" id="File<?php echo $i ?>"
                                        class="form-control file-loading" name="upload_file[]" multiple=""
                                        data-krajee-fileinput="fileinput_4efc2035">
                                <?php } ?>
                            </div>
                            <?php echo Html::a('X', ['/deleteform3', 'post' => $table["Position"]], ['type' => 'button', 'id' => 'remove_row_form3', 'class' => 'btn btn-danger col-md-1']); ?>
                        </div>
                        <?php $i++;
                }
            }
            ?>
                <button type="button" id="add_row" class="btn btn-success">+ Добавить</button>
            </div>
        </div>
        <div class="border_row"></div>
        <div class="form-group form_group_margin">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
</form>