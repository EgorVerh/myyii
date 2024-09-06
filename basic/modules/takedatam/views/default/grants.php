<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerCssFile('@modulestakedatamcss/styles.css');
$this->registerJsFile('@modulestakedatamscript/document.js');
?>

<head>
    <title>Стипендии и меры поддержки обучающихся</title>
</head>

<body>
    <input type="hidden" id="whatisurl" value=5>
    <h1 style="margin-bottom:20px;">Стипендии и меры поддержки обучающихся</h1>
    <form method="post" enctype="multipart/form-data">
        <?php $count_row = 0; ?>
        <?php if (!empty($singledata)) {
            foreach ($singledata as $number => $data) { ?>
                <h4>
                    <?php echo $data["titel"] ?>
                </h4>
                <input type="hidden" name="grants[<?php echo $number ?>][]" value="<?php echo $data["id"] ?>">
                <input type="hidden" name="grants[<?php echo $number ?>][]" value="<?php echo $data["fieldsforms_id"] ?>">
                <input type="hidden" name="grants[<?php echo $number ?>][]" value="<?php echo $data["titel"] ?>">
                <?php if($number>1){?>
                    <input type="number" name="grants[<?php echo $number ?>][]" value=<?php echo $data["data"] ?>>
                <?php }else{?>
                    <input type="text" name="grants[<?php echo $number ?>][]" value="<?php echo $data["data"] ?>">
                <?php }?>
            <?php }
        } else { ?>
            <h4>Информация о предоставлении стипендии обучающимся</h4>
            <input type="hidden" name="grants[0][]" value="0">
            <input type="hidden" name="grants[0][]" value=32>
            <input type="hidden" name="grants[0][]" value="Информация о предоставлении стипендии обучающимся">
            <input type="text" name="grants[0][]">
            <h4>Информация о мерах социальной поддержки обучающихся</h4>
            <input type="hidden" name="grants[1][]" value="0">
            <input type="hidden" name="grants[1][]" value=33>
            <input type="hidden" name="grants[1][]" value="Информация о мерах социальной поддержки обучающихся">
            <input type="text" name="grants[1][]">
            <h4>Количество общежитий</h4>
            <input type="hidden" name="grants[2][]" value="0">
            <input type="hidden" name="grants[2][]" value=34>
            <input type="hidden" name="grants[2][]" value="Количество общежитий">
            <input type="number" name="grants[2][]">
            <h4>Количество интернатов</h4>
            <input type="hidden" name="grants[3][]" value="0">
            <input type="hidden" name="grants[3][]" value=35>
            <input type="hidden" name="grants[3][]" value="Количество интернатов">
            <input type="number" name="grants[3][]">
            <h4>Количество мест в общежитиях</h4>
            <input type="hidden" name="grants[4][]" value="0">
            <input type="hidden" name="grants[4][]" value=36>
            <input type="hidden" name="grants[4][]" value="Количество мест в общежитиях">
            <input type="number" name="grants[4][]">
            <h4>Количество жилых помещений в общежитии, приспособленных для использования инвалидами и лицами с
                ограниченными возможностями здоровья</h4>
            <input type="hidden" name="grants[5][]" value="0">
            <input type="hidden" name="grants[5][]" value=37>
            <input type="hidden" name="grants[5][]" value="Количество жилых помещений в общежитии, приспособленных для использования инвалидами и лицами с
            ограниченными возможностями здоровья">
            <input type="number" name="grants[5][]">
            <h4>Количество мест в интернатах</h4>
            <input type="hidden" name="grants[6][]" value="0">
            <input type="hidden" name="grants[6][]" value=38>
            <input type="hidden" name="grants[6][]" value="Количество мест в интернатах">
            <input type="number" name="grants[6][]">
            <h4>Количество жилых помещений в интернате, приспособленных для использования инвалидами и лицами с
                ограниченными возможностями здоровья</h4>
            <input type="hidden" name="grants[7][]" value="0">
            <input type="hidden" name="grants[7][]" value=39>
            <input type="hidden" name="grants[7][]" value="Количество жилых помещений в интернате, приспособленных для использования инвалидами и лицами с
            ограниченными возможностями здоровья">
            <input type="number" name="grants[7][]">
        <?php } ?>
        <h4>Приказ об установлении стипендий</h4>
        <?php if (!empty($tabledata)) {
            foreach ($tabledata as $table) {
                if ($table["fieldsforms_id"] == 5 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value="<?php echo $table["position"] ?>">
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=5>
                        <div class="col-sm-11">
                            <label for="document_purpose<?php echo $count_row ?>"> Назначение докумета</label>
                            <input class="form-control" type="text" name="document[<?php echo $count_row ?>][]"
                                placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                value="<?php echo $table["titel"] ?>" required><br>
                            <?php if ($table["data"] == '') { ?>
                                <div><label class="control-label" for="File<?php echo $count_row ?>">Документ для
                                        загрузки</label>
                                    <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                            type="file" id="File<?php echo $count_row ?>" class="form-control file-loading wrong_file"
                                            name="document[<?php echo $count_row ?>]" accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                    <?php } else { ?><input type="file" id="File<?php echo $count_row ?>"
                                            class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                            accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                <?php } else { ?>
                                    <div class="labeloform"><a class="colorhref" target="_blank"
                                            href="<?php echo $table["data"] ?>">Ссылка на загруженный
                                            файл</a></div>
                                    <div style="margin-top:20px;"><label class="control-label"
                                            for="File<?php echo $count_row ?>">Заменить
                                            загруженный
                                            файл</label>
                                        <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                type="file" id="File<?php echo $count_row ?>" class="form-control file-loading wrong_file"
                                                name="document[<?php echo $count_row ?>]" accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                        <?php } else { ?><input type="file" id="File<?php echo $count_row ?>"
                                                class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div>
                                <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1"
                                    value='/delete_document'>X</button>
                                <button type="button" id="hide_button" value='/delete_document' class="hidebutton btn delbutton"
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
                        <?php $count_row++;
                }
            }
            ?>
                <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=5>+
                        Добавить</button></div>
                <h4>Ссылка на информацию о формировании платы за проживание в общежитии</h4>
                <?php foreach ($tabledata as $table) {
                    if ($table["fieldsforms_id"] == 10 && $table["enabled"] == 1) { ?>
                        <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                value="<?php echo $table["position"] ?>">
                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=10>
                            <div class="col-sm-11">
                                <label for="document_purpose<?php echo $count_row ?>"> Назначение докумета</label>
                                <input class="form-control" type="text" name="document[<?php echo $count_row ?>][]"
                                    placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                    value="<?php echo $table["titel"] ?>" required><br>
                                <?php if ($table["data"] == '') { ?>
                                    <div><label class="control-label" for="File<?php echo $count_row ?>">Документ для
                                            загрузки</label>
                                        <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                type="file" id="File<?php echo $count_row ?>" class="form-control file-loading wrong_file"
                                                name="document[<?php echo $count_row ?>]" accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                        <?php } else { ?><input type="file" id="File<?php echo $count_row ?>"
                                                class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                    <?php } else { ?>
                                        <div class="labeloform"><a class="colorhref" target="_blank"
                                                href="<?php echo $table["data"] ?>">Ссылка на загруженный
                                                файл</a></div>
                                        <div style="margin-top:20px;"><label class="control-label"
                                                for="File<?php echo $count_row ?>">Заменить
                                                загруженный
                                                файл</label>
                                            <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                    type="file" id="File<?php echo $count_row ?>"
                                                    class="form-control file-loading wrong_file" name="document[<?php echo $count_row ?>]"
                                                    accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                            <?php } else { ?><input type="file" id="File<?php echo $count_row ?>"
                                                    class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                    accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1"
                                        value='/delete_document'>X</button>
                                    <button type="button" id="hide_button" value='/delete_document' class="btn delbutton hidebutton"
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
                            <?php $count_row++;
                    }
                }
        }?>
                <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=10>+
                        Добавить</button></div>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) ?>
                </div>
                <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
</body>