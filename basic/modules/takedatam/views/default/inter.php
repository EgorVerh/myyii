<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerCssFile('@modulestakedatamcss/styles.css');
$this->registerJsFile('@modulestakedatamscript/inter.js');
?>

<head>
    <title>Образовательные стандарты и требования</title>
    <style>
        .rightbuttonposition_text {
            text-align: right;
        }

        #add_dop {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .margin_for_dop {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <form method="post">
        <?php $count_row = 0; ?>
        <h4>Информация о заключенных и планируемых к заключению договорах с иностранными и (или) международными
            организациями по вопросам образования и науки</h4>
        <?php if (isset($data)) {
            foreach ($data as $inter) { ?>
                <div class="row oform_row temporarystyle" value="<?php echo $count_row ?>">
                    <input type="hidden" name="inter[<?php echo $count_row ?>][0][]" value="<?php echo $inter["id"] ?>">
                    <input type="hidden" name="inter[<?php echo $count_row ?>][0][]" value=31>
                    <div class="col-sm-3"><label for="NameofState">Название государства</label><input type="text"
                            class="form-control" id="NameofState" name="inter[<?php echo $count_row ?>][0][]"
                            placeholder="Название государства" required value="<?php echo $inter["titel"] ?>"></div>
                    <div class="col-sm-4"><label for="NameoftheOrganisation">Наименование организации</label><input type="text"
                            class="form-control" id="NameoftheOrganisation" name="inter[<?php echo $count_row ?>][0][]"
                            placeholder="Наименование организации" required value="<?php echo $inter["data"] ?>"></div>
                    <div class="col-sm-5"><label for="ContractDetails">Реквизиты договора</label>
                        <?php if (!empty($inter["extraFields"])) {
                            foreach ($inter["extraFields"] as $dop) { ?>
                                <div class="row rightbuttonposition margin_for_dop">
                                    <div class="col-sm-9"><input type="text" class="form-control"
                                            id="ContractDetails" name="inter[<?php echo $count_row ?>][1][]"
                                            placeholder="Реквизиты договора" value="<?php echo $dop["data"] ?>"></div>
                                    <div class="col-sm-3"><button type="button" id="delrow" name="false"
                                            class="btn btn-danger delbutton margin_for_dop" value="<?php echo $dop["id"] ?>"
                                            tabindex="-1">X</button></div>
                                </div>
                            <?php }
                        } ?>
                        <div class="rightbuttonposition_text"><button type="button" id="add_dop" class="btn btn-success">+
                                Добавить</button></div>
                    </div>
                    <button type="button" id="delrow" class="btn btn-danger delbutton" value="<?php echo $inter["id"] ?>"
                        tabindex="-1">X</button>
                </div>
                <?php $count_row++;
            }
        } ?>
        <div class="rightbuttonposition">
            <button type="button" id="add_row" class="btn btn-success" value=31>+
                Добавить</button>
        </div>
        <div class="form-group" style="margin-top:10px;">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), ['id' => "csfr"]) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
</body>
<!--Конец сведений-->