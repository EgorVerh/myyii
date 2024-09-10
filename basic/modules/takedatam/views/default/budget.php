<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerCssFile('@modulestakedatamcss/styles.css');
$this->registerJsFile('@modulestakedatamscript/budget.js');
?>

<head>
    <title>Финансово-хозяйственная деятельность</title>
</head>

<body>
    <input type="hidden" id="whatisurl" value=6>
    <h1 style="margin-bottom:20px;">Финансово-хозяйственная деятельность</h1>
    <form method="post" enctype="multipart/form-data">
        <?php
        $count_report = 0;
        $count_doc = 0;
        $count_url = 0;
        ?>
        <?php if (!empty($singledata)) {
            foreach ($singledata as $number => $data) {
                if ($data["fieldsforms_id"] != "46") { ?>
                    <h4>
                        <?php echo $data["titel"] ?>
                    </h4>
                    <input type="hidden" name="budget[<?php echo $number ?>][]" value="<?php echo $data["id"] ?>">
                    <input type="hidden" name="budget[<?php echo $number ?>][]" value="<?php echo $data["fieldsforms_id"] ?>">
                    <input type="hidden" name="budget[<?php echo $number ?>][]" value="<?php echo $data["titel"] ?>">
                    <input type="number" step="0.01" min="0" name="budget[<?php echo $number ?>][]"
                        value="<?php echo $data["data"] ?>">
                <?php }
            }
        } else { ?>
            <h4>Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется за счет
                бюджетных ассигнований федерального бюджета</h4>
            <input type="hidden" name="budget[0][]" value="0">
            <input type="hidden" name="budget[0][]" value=40>
            <input type="hidden" name="budget[0][]"
                value="Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется за счет бюджетных ассигнований федерального бюджета">
            <input type="number" step="0.01" name="budget[0][]">
            <h4>Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется за счет
                бюджетов субъектов Российской Федерации</h4>
            <input type="hidden" name="budget[1][]" value="0">
            <input type="hidden" name="budget[1][]" value=41>
            <input type="hidden" name="budget[1][]"
                value="Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется за счет бюджетов субъектов Российской Федерации">
            <input type="number" step="0.01" name="budget[1][]">
            <h4>Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется за счет
                местных бюджетов</h4>
            <input type="hidden" name="budget[2][]" value="0">
            <input type="hidden" name="budget[2][]" value=42>
            <input type="hidden" name="budget[2][]"
                value="Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется за счет местных бюджетов">
            <input type="number" step="0.01" name="budget[2][]">
            <h4>Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется по
                договорам об оказании платных образовательных услуг</h4>
            <input type="hidden" name="budget[3][]" value="0">
            <input type="hidden" name="budget[3][]" value=43>
            <input type="hidden" name="budget[3][]"
                value="Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется по договорам об оказании платных образовательных услуг">
            <input type="number" step="0.01" name="budget[3][]">
        <?php } ?>
        <h1 style="margin-top: 20px;">Информация о поступлении и расходовании финансовых и материальных средств</h1>
        <?php if (!empty($report)) {
            foreach ($report as $rep) { ?>
                <div class="row oform_row temporarystyle">
                    <input type="hidden" name="report[<?php echo $count_report ?>][]" value="<?php echo $rep["id"] ?>">
                    <input type="hidden" name="report[<?php echo $count_report ?>][]" value=44>
                    <div class="col-sm-1"><label for="YearReporting" class="label_size">Год отчетности</label>
                        <input type="number" id="YearReporting" name="report[<?php echo $count_report ?>][]"
                            value="<?php echo $rep["data"] ?>">
                    </div>
                    <?php foreach ($rep["extraFields"] as $extrarep) {
                        if ($extrarep["id"] == 47) { ?>
                            <div class="col-sm-5"><label for="Income" class="label_size">Информация о поступлении финансовых и
                                    материальных средств</label>
                                <input type="hidden" name="report[<?php echo $count_report ?>][]" value="<?php echo $extrarep["id"] ?>">
                                <input type="number" id="Income" name="report[<?php echo $count_report ?>][]" step="0.01"
                                    value="<?php echo $extrarep["data"] ?>">
                            </div>
                        <?php } else { ?>
                            <div class="col-sm-5"><label for="Expenditure" class="label_size">Информация о расходовании финансовых и
                                    материальных
                                    средств</label>
                                <input type="hidden" name="report[<?php echo $count_report ?>][]" value="<?php echo $extrarep["id"] ?>">
                                <input type="number" id="Expenditure" name="report[<?php echo $count_report ?>][]" step="0.01"
                                    value="<?php echo $extrarep["data"] ?>">
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="col-sm-1">
                        <button type="button" id="delreport" class="btn btn-danger delbutton" value="<?php echo $rep["id"] ?>"
                            tabindex="-1">X</button>
                    </div>
                </div>
                <?php $count_report++;
            }
        } ?>
        <div class="rightbuttonposition"><button type="button" id="add_report" class="btn btn-success" value=44>+
                Добавить</button></div>
        <h4>Утвержденный план финансово-хозяйственной деятельности образовательной организации или бюджетные сметы
            образовательной организации</h4>
        <?php if (!empty($tabledata)) {
            foreach ($tabledata as $table) {
                if ($table["fieldsforms_id"] == 45 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row temporarystyle" value=<?php echo $count_doc ?>>
                        <input type="hidden" name="document[<?php echo $count_doc ?>][]" value="<?php echo $table["position"] ?>">
                        <input type="hidden" name="document[<?php echo $count_doc ?>][]" value=45>
                        <div class="col-sm-11">
                            <label for="document_purpose<?php echo $count_doc ?>"> Назначение докумета</label>
                            <input class="form-control" type="text" name="document[<?php echo $count_doc ?>][]"
                                placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                value="<?php echo $table["titel"] ?>" required><br>
                            <?php if ($table["data"] == '') { ?>
                                <div><label class="control-label" for="File<?php echo $count_doc ?>">Документ для
                                        загрузки</label>
                                    <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                            type="file" id="File<?php echo $count_doc ?>" class="form-control file-loading wrong_file"
                                            name="document[<?php echo $count_doc ?>]" accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                    <?php } else { ?><input type="file" id="File<?php echo $count_doc ?>"
                                            class="form-control file-loading" name="document[<?php echo $count_doc ?>]"
                                            accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                <?php } else { ?>
                                    <div class="labeloform"><a class="colorhref" target="_blank"
                                            href="<?php echo $table["data"] ?>">Ссылка на загруженный
                                            файл</a></div>
                                    <div style="margin-top:20px;"><label class="control-label"
                                            for="File<?php echo $count_doc ?>">Заменить
                                            загруженный
                                            файл</label>
                                        <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                type="file" id="File<?php echo $count_doc ?>" class="form-control file-loading wrong_file"
                                                name="document[<?php echo $count_doc ?>]" accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                        <?php } else { ?><input type="file" id="File<?php echo $count_doc ?>"
                                                class="form-control file-loading" name="document[<?php echo $count_doc ?>]"
                                                accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div>
                                <button type="button" id="deldoc" class="btn btn-danger delbutton" tabindex="-1"
                                    value='/delete_document'>X</button>
                                <button type="button" id="hide_doc" value='/delete_document' class="btn delbutton hidebutton"
                                    tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path
                                            d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z">
                                        </path>
                                        <path
                                            d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829">
                                        </path>
                                        <path
                                            d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z">
                                        </path>
                                    </svg></button>
                            </div>
                        </div>
                        <?php $count_doc++;
                }
            }
        } ?>
            <div class="rightbuttonposition"><button type="button" id="add_doc" class="btn btn-success" value=45>+
                    Добавить</button></div>
            <h4>Информация, размещаемая на сайте http://bus.gov.ru</h4>
            <?php if (isset($singledata)) {
                foreach ($singledata as $data) {
                    if ($data["fieldsforms_id"] == 46 && $data["enabled"] == 1) { ?>
                        <div class="row oform_row" value="<?php echo $count_url ?>">
                            <input type="hidden" name="paid_educational[<?php echo $count_url ?>][]"
                                value="<?php echo $data["id"] ?>">
                            <input type="hidden" name="paid_educational[<?php echo $count_url ?>][]" value=46>
                            <div class="col-sm-11">
                                <label for="text<?php echo $count_url ?>">Название для ссылки</label>
                                <input type="text" name="paid_educational[<?php echo $count_url ?>][]" placeholder="Статья"
                                    value="<?php echo $data['titel'] ?>" required><br>
                                <label for="url<?php echo $count_url ?>">Ссылка</label>
                                <input type="url" name="paid_educational[<?php echo $count_url ?>][]"
                                    placeholder="https://example.com" pattern="https://.*" required
                                    value="<?php echo $data["data"] ?>">
                            </div>
                            <div>
                                <button type="button" id="delurl" class="btn btn-danger delbutton" tabindex="-1"
                                    value='/delete_grants'>X</button>
                                <button type="button" id="hide_url" value='/delete_grants' class="hidebutton btn delbutton"
                                    tabindex="-1" style="background-color: #f5f5f5;"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="25" height="25" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path
                                            d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z">
                                        </path>
                                        <path
                                            d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829">
                                        </path>
                                        <path
                                            d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z">
                                        </path>
                                    </svg></button>
                            </div>
                        </div>
                        <?php $count_url++;
                    }
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_url" class="btn btn-success" value=46>+
                    Добавить</button></div>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) ?>
            </div>
            <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), ['id' => "csfr"]) ?>
    </form>
    <input type="hidden" id="count_report" value=<?php echo $count_report ?>>
    <input type="hidden" id="count_doc" value=<?php echo $count_doc ?>>
    <input type="hidden" id="count_url" value=<?php echo $count_url ?>>
</body>