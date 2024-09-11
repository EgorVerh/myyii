<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;
AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerCssFile('@modulestakedatamcss/styles.css');
$this->registerJsFile('@modulestakedatamscript/objects.js');
?>

<head>
    <title>Организация питания в образовательной деятельности</title>
</head>

<body>
    <?= $this->params["MenuSectionsWidget"] ?>
    <h1>Организация питания в образовательной деятельности</h1>
    <form method="post" enctype="multipart/form-data">
        <?php
        $count_rows_tabels = 0;
        ?>
        <?php if (isset($tables)) { ?>
            <h4>Сведения об условиях питания обучающихся</h4>
            <?php foreach ($tables as $number => $row) {
                if ($row["fieldsforms_id"] == 69) { ?>
                    <input type="hidden" name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["id"] ?>">
                    <input type="hidden" name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["fieldsforms_id"] ?>">
                    <div class="row oform_row temporarystyle">
                        <div class="col-sm-3"><label for="NameObject"> Наименование объекта</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][0]["id"] ?>">
                            <input type="text" class="form-control input_margin_top_whit_short_text" id="NameObject"
                                name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["extraFields"][0]["data"] ?>"
                                required>
                        </div>
                        <div class="col-sm-3"><label for="LegaLaddressFounder">Адрес места нахождения объекта</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][1]["id"] ?>">
                            <input type="text" class="form-control input_margin_top_whit_long_text" id="LegaLaddressFounder"
                                name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["extraFields"][1]["data"] ?>"
                                required>
                        </div>
                        <div class="col-sm-2"><label for="Square">Площадь объекта</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][2]["id"] ?>">
                            <input type="number" min="0" step="0.01" class="form-control input_margin_top_whit_short_text"
                                id="Square" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][2]["data"] ?>">
                        </div>
                        <div class="col-sm-2"><label for="Amount">Количество мест</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][3]["id"] ?>">
                            <input type="number" min="0" class="form-control input_margin_top_whit_short_text" id="Amount"
                                name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["extraFields"][3]["data"] ?>">
                        </div>
                        <div class="col-sm-2"><label for="OVZ">Приспособленность для лиц с ОВЗ</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][4]["id"] ?>">
                            <input type="number" min="0" max="2" class="form-control input_margin_top_whit_long_text" id="OVZ"
                                name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["extraFields"][4]["data"] ?>">
                        </div>
                        <button type="button" id="delrowtabel" class="btn btn-danger delbutton" value="<?php echo $row["id"] ?>"
                            tabindex="-1">X</button>
                    </div>
                    <?php $count_rows_tabels++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row_tabel" class="btn btn-success" value=69>+
                    Добавить</button></div>
            <h4>Сведения об условиях охраны здоровья обучающихся</h4>
            <?php foreach ($tables as $number => $row) {
                if ($row["fieldsforms_id"] == 70) { ?>
                    <input type="hidden" name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["id"] ?>">
                    <input type="hidden" name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["fieldsforms_id"] ?>">
                    <div class="row oform_row temporarystyle">
                        <div class="col-sm-3"><label for="NameObject"> Наименование объекта</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][0]["id"] ?>">
                            <input type="text" class="form-control input_margin_top_whit_short_text" id="NameObject"
                                name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["extraFields"][0]["data"] ?>"
                                required>
                        </div>
                        <div class="col-sm-3"><label for="LegaLaddressFounder">Адрес места нахождения объекта</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][1]["id"] ?>">
                            <input type="text" class="form-control input_margin_top_whit_long_text" id="LegaLaddressFounder"
                                name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["extraFields"][1]["data"] ?>"
                                required>
                        </div>
                        <div class="col-sm-2"><label for="Square">Площадь объекта</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][2]["id"] ?>">
                            <input type="number" min="0" step="0.01" class="form-control input_margin_top_whit_short_text"
                                id="Square" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][2]["data"] ?>">
                        </div>
                        <div class="col-sm-2"><label for="Amount">Количество мест</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][3]["id"] ?>">
                            <input type="number" min="0" class="form-control input_margin_top_whit_short_text" id="Amount"
                                name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["extraFields"][3]["data"] ?>">
                        </div>
                        <div class="col-sm-2"><label for="OVZ">Приспособленность для лиц с ОВЗ</label>
                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                value="<?php echo $row["extraFields"][4]["id"] ?>">
                            <input type="number" min="0" max="2" class="form-control input_margin_top_whit_long_text" id="OVZ"
                                name="tableobj[<?php echo $number ?>][0][]" value="<?php echo $row["extraFields"][4]["data"] ?>">
                        </div>
                        <button type="button" id="delrowtabel" class="btn btn-danger delbutton" value="<?php echo $row["id"] ?>"
                            tabindex="-1">X</button>
                    </div>
                    <?php $count_rows_tabels++;
                }
            }
        } ?>
        <div class="rightbuttonposition"><button type="button" id="add_row_tabel" class="btn btn-success" value=70>+
                Добавить</button></div>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), ['id' => "csfr"]) ?>
    </form>
    <input type="hidden" id="count_rows_tabels" value=<?php echo $count_rows_tabels ?>>
</body>