<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;
AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/document.js');
$this->registerJsFile('@modulestakedatamscript/education.js');
$this->registerCssFile('@modulestakedatamcss/styles.css')
    ?>

<head>
    <title>Образование</title>
</head>

<body>
    <?= $this->params["MenuSectionsWidget"] ?>
    <input type="hidden" id="whatisurl" value=7>
    <h1>Образование</h1>
    <!--Сгенерированные сведения-->
    <form method="post" enctype="multipart/form-data">
        <?php
        $count_row = 0;
        $count_rows_tabels = 0;
        ?>
        <h4>Языки, на которых осуществляется образование (обучение)</h4>
        <?php if (isset($tabledata)) {
            foreach ($tabledata as $table) {
                if ($table["fieldsforms_id"] == 71 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value="<?php echo $table["position"] ?>">
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=71>
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
                <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=71>+
                        Добавить</button></div>
                <h4>Информация о численности обучающихся по реализуемым образовательным программам по источникам
                    финансирования</h4>
                <?php foreach ($tabledata as $table) {
                    if ($table["fieldsforms_id"] == 72 && $table["enabled"] == 1) { ?>
                        <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                value="<?php echo $table["position"] ?>">
                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=72>
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
                ?>
                    <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=72>+
                            Добавить</button></div>
                    <h4>Информация о результатах приема</h4>
                    <?php foreach ($tabledata as $table) {
                        if ($table["fieldsforms_id"] == 73 && $table["enabled"] == 1) { ?>
                            <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                    value="<?php echo $table["position"] ?>">
                                <input type="hidden" name="document[<?php echo $count_row ?>][]" value=73>
                                <div class="col-sm-11">
                                    <label for="document_purpose<?php echo $count_row ?>"> Назначение докумета</label>
                                    <input class="form-control" type="text" name="document[<?php echo $count_row ?>][]"
                                        placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                        value="<?php echo $table["titel"] ?>" required><br>
                                    <?php if ($table["data"] == '') { ?>
                                        <div><label class="control-label" for="File<?php echo $count_row ?>">Документ для
                                                загрузки</label>
                                            <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                    type="file" id="File<?php echo $count_row ?>"
                                                    class="form-control file-loading wrong_file" name="document[<?php echo $count_row ?>]"
                                                    accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
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
                                                        class="form-control file-loading wrong_file"
                                                        name="document[<?php echo $count_row ?>]"
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
                                        <button type="button" id="hide_button" value='/delete_document'
                                            class="btn delbutton hidebutton" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg"
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
                        <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success"
                                value=73>+
                                Добавить</button></div>
                        <h4>Информация о результатах перевода, восстановления и отчисления в форме электронного документа,
                            подписанного простой электронной подписью</h4>
                        <?php foreach ($tabledata as $table) {
                            if ($table["fieldsforms_id"] == 74 && $table["enabled"] == 1) { ?>
                                <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                    <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                        value="<?php echo $table["position"] ?>">
                                    <input type="hidden" name="document[<?php echo $count_row ?>][]" value=74>
                                    <div class="col-sm-11">
                                        <label for="document_purpose<?php echo $count_row ?>"> Назначение докумета</label>
                                        <input class="form-control" type="text" name="document[<?php echo $count_row ?>][]"
                                            placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                            value="<?php echo $table["titel"] ?>" required><br>
                                        <?php if ($table["data"] == '') { ?>
                                            <div><label class="control-label" for="File<?php echo $count_row ?>">Документ для
                                                    загрузки</label>
                                                <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                        type="file" id="File<?php echo $count_row ?>"
                                                        class="form-control file-loading wrong_file"
                                                        name="document[<?php echo $count_row ?>]"
                                                        accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
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
                                                            class="form-control file-loading wrong_file"
                                                            name="document[<?php echo $count_row ?>]"
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
                                            <button type="button" id="hide_button" value='/delete_document'
                                                class="btn delbutton hidebutton" tabindex="-1"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="25" height="25"
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
        } ?>
                        <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success"
                                value=74>+ Добавить</button></div>
                        <?php if (isset($tables)) { ?>
                            <h4>Информация о трудоустройстве выпускников для каждой реализуемой образовательной программы,
                                по которой состоялся выпуск</h4>
                            <?php foreach ($tables as $number => $row) {
                                if ($row["fieldsforms_id"] == 75) { ?>
                                    <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                        value="<?php echo $row["id"] ?>">
                                    <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                        value="<?php echo $row["fieldsforms_id"] ?>">
                                    <div class="row oform_row temporarystyle">
                                        <div class="col-sm-2"><label for="Code">Код</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][0]["id"] ?>">
                                            <input type="text" class="form-control margin_for_code" id="Code"
                                                name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][0]["data"] ?>" required>
                                        </div>
                                        <div class="col-sm-3"><label for="NameProfession">Наименование профессии, специальности, в
                                                том числе научной, направления подготовки</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][1]["id"] ?>">
                                            <input type="text" class="form-control input_margin_top_whit_short_text"
                                                id="NameProfession" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][1]["data"] ?>" required>
                                        </div>
                                        <div class="col-sm-3"><label for="EducationalProgramme">Образовательная программа,
                                                направленность, профиль, шифр и наименование научной специальности</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][2]["id"] ?>">
                                            <input type="text" class="form-control input_margin_top_whit_short_text"
                                                id="EducationalProgramme" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][2]["data"] ?>">
                                        </div>
                                        <div class="col-sm-2"><label for="NumberGraduates">Численность выпускников прошлого учебного
                                                года</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][3]["id"] ?>">
                                            <input type="number" min="0" class="form-control input_margin_top_whit_short_text"
                                                id="NumberGraduates" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][3]["data"] ?>">
                                        </div>
                                        <div class="col-sm-2"><label for="NumberEmployed">Численность трудоустроенных выпускников
                                                прошлого учебного года</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][4]["id"] ?>">
                                            <input type="number" min="0" class="form-control input_margin_top_whit_long_text"
                                                id="NumberEmployed" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][4]["data"] ?>">
                                        </div>
                                        <button type="button" id="delrowtabel" class="btn btn-danger delbutton"
                                            value="<?php echo $row["id"] ?>" tabindex="-1">X</button>
                                    </div>
                                    <?php $count_rows_tabels++;
                                }
                            }
                        } ?>
                        <div class="rightbuttonposition"><button type="button" id="add_row_tabel"
                                class="btn btn-success" value=75>+
                                Добавить</button></div>
                        <div class="form-group" style="margin-top:10px;">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                        </div>
                        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), ['id' => "csfr"]) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
    <input type="hidden" id="count_rows_tabels" value=<?php echo $count_rows_tabels ?>>
    <h4>Информация о реализуемых образовательных программах, в том числе о реализуемыхадаптированных образовательных
        программах, с указанием в отношении каждой образовательной программы</h4>
    <table>
        <thead class="table-fixed-head">
            <tr>
                <td>Код профессии, специальности, направления подготовки, научной специальности</td>
                <td>Наименование профессии, специальности, направления подготовки, научной специальности</td>
                <td>Образовательная программа, направленность, профиль, шифр и наименование научной специальности</td>
                <td>Реализуемый уровень образования</td>
                <td>Форма обучения</td>
                <td>Нормативный срок обучения</td>
                <td>Срок действия государственной аккредитации образовательной программы (при наличии государственной
                    аккредитации)</td>
                <td>Учебные предметы, курсы, дисциплины (модули), предусмотренные соответствующей образовательной
                    программой</td>
                <td>Практики, предусмотренные соответствующей образовательной программой</td>
                <td>Информация об использовании при реализации образовательных программ электронного обучения и
                    дистанционных образовательных технологий</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="10">
                    <div class="content_alert alert-1c danger_oform">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                            viewBox="0 0 30 30">
                            <path fill="#c74343" d="M0 12L2 12 2 23 4 23 4 10 0 10z"></path>
                            <path fill="#c74343"
                                d="M2 9L5 9 5 23 7 23 7 7 2 7zM11 15c0-3.309 2.691-6 6-6s6 2.691 6 6h2c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8h13v-2H17C13.691 21 11 18.309 11 15z">
                            </path>
                            <path fill="#c74343"
                                d="M17,17c-1.103,0-2-0.897-2-2s0.897-2,2-2s2,0.897,2,2h2c0-2.206-1.794-4-4-4s-4,1.794-4,4 s1.794,4,4,4h13v-2H17z">
                            </path>
                        </svg>

                        <p>ВНИМАИЕ !</p>
                        <p>Поля для этой таблицы выгружаются из 1C</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h4>Информация о профессионально-общественной аккредитации образовательной программы (при наличии)</h4>
    <table>
        <thead class="table-fixed-head">
            <tr>
                <td>Код специальности, направления подготовки</td>
                <td>Наименование специальности, направления подготовки, научной специальности</td>
                <td>Уровень образования</td>
                <td>Образовательная программа, направленность, профиль, шифр и наименование научной специальности</td>
                <td>Наименование аккредитующей организации</td>
                <td>Срок действия профессионально-общественной аккредитации образовательной программы</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="content_alert alert-danger danger_oform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-exclamation-triangle" viewBox="0 0 20 20">
                            <path
                                d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                            <path
                                d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                        </svg>
                        <p>ВНИМАИЕ !</p>
                        <p>Поля для этой таблицы внесены в шаблон</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h4>Информация об общественной аккредитации образовательной программы</h4>
    <table>
        <thead class="table-fixed-head">
            <tr>
                <td>Код специальности, направления подготовки</td>
                <td>Наименование специальности, направления подготовки, научной специальности</td>
                <td>Уровень образования</td>
                <td>Образовательная программа, направленность, профиль, шифр и наименование научной специальности</td>
                <td>Наименование аккредитующей организации</td>
                <td>Срок действия профессионально-общественной аккредитации образовательной программы</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="content_alert alert-danger danger_oform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-exclamation-triangle" viewBox="0 0 20 20">
                            <path
                                d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                            <path
                                d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                        </svg>
                        <p>ВНИМАИЕ !</p>
                        <p>Поля для этой таблицы внесены в шаблон</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h4>Информация об образовательной программе</h4>
    <table>
        <thead class="table-fixed-head">
            <tr>
                <td>Код специальности, направления подготовки, шифр группы научных специальностей</td>
                <td>Наименование профессии, специальности, направления подготовки, наименование группы научных
                    специальностей</td>
                <td>Реализуемый уровень образования</td>
                <td>Образовательная программа, направленность, профиль, шифр и наименование научной специальности</td>
                <td>Форма обучения</td>
                <td>Ссылка на описание образовательной программы с приложением ее копии в виде электронного документа,
                    подписанного электронной подписью</td>
                <td>Ссылка на учебный план в виде электронного документа, подписанного электронной подписью</td>
                <td>Ссылки на рабочие программы (по каждой дисциплине в составе образовательной программы) в виде
                    электронного документа, подписанного электронной подписью</td>
                <td>Ссылка на календарный учебный график в виде электронного документа, подписанного электронной
                    подписью</td>
                <td>Рабочие программы практик, предусмотренных соответствующей образовательной программой в виде
                    электронного документа, подписанного электронной подписью</td>
                <td>Методические и иные документы, разработанные образовательной организацией для обеспечения
                    образовательного процесса, а также рабочие программы воспитания и календарные планы воспитательной
                    работы, включаемых в ООП в виде электронного документа, подписанного электронной подписью</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="11">
                    <div class="content_alert alert-1c danger_oform">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                            viewBox="0 0 30 30">
                            <path fill="#c74343" d="M0 12L2 12 2 23 4 23 4 10 0 10z"></path>
                            <path fill="#c74343"
                                d="M2 9L5 9 5 23 7 23 7 7 2 7zM11 15c0-3.309 2.691-6 6-6s6 2.691 6 6h2c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8h13v-2H17C13.691 21 11 18.309 11 15z">
                            </path>
                            <path fill="#c74343"
                                d="M17,17c-1.103,0-2-0.897-2-2s0.897-2,2-2s2,0.897,2,2h2c0-2.206-1.794-4-4-4s-4,1.794-4,4 s1.794,4,4,4h13v-2H17z">
                            </path>
                        </svg>
                        <p>ВНИМАИЕ !</p>
                        <p>Поля для этой таблицы выгружаются из 1C</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h4>Информация об адаптированной образовательной программе</h4>
    <table>
        <thead class="table-fixed-head">
            <tr>
                <td>Код специальности, направления подготовки, шифр группы научных специальностей</td>
                <td>Наименование специальности, направления подготовки</td>
                <td>Уровень образования</td>
                <td>Образовательная программа, направленность, профиль, шифр и наименование научной специальности</td>
                <td>Реализуемые формы обучения</td>
                <td>Описание образовательной программы с приложением ее копии в виде электронного документа,
                    подписанного электронной подписью</td>
                <td>Учебный план в виде электронного документа, подписанного электронной подписью</td>
                <td>Рабочие программы (по каждой дисциплине в составе образовательной программы) в виде электронного
                    документа, подписанного электронной подписью</td>
                <td>Календарный учебный график в виде электронного документа, подписанного электронной подписью</td>
                <td>Рабочие программы практик, предусмотренных соответствующей образовательной программой в виде
                    электронного документа, подписанного электронной подписью</td>
                <td>Методические и иные документы, разработанные образовательной организацией для обеспечения
                    образовательного процесса, а также рабочие программы воспитания и календарные планы воспитательной
                    работы, включаемых в ООП в виде электронного документа, подписанного электронной подписью</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="11">
                    <div class="content_alert alert-1c danger_oform">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                            viewBox="0 0 30 30">
                            <path fill="#c74343" d="M0 12L2 12 2 23 4 23 4 10 0 10z"></path>
                            <path fill="#c74343"
                                d="M2 9L5 9 5 23 7 23 7 7 2 7zM11 15c0-3.309 2.691-6 6-6s6 2.691 6 6h2c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8h13v-2H17C13.691 21 11 18.309 11 15z">
                            </path>
                            <path fill="#c74343"
                                d="M17,17c-1.103,0-2-0.897-2-2s0.897-2,2-2s2,0.897,2,2h2c0-2.206-1.794-4-4-4s-4,1.794-4,4 s1.794,4,4,4h13v-2H17z">
                            </path>
                        </svg>
                        <p>ВНИМАИЕ !</p>
                        <p>Поля для этой таблицы выгружаются из 1C</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h4>Информация о направлениях и результатах научной (научно-исследовательской) деятельности и
        научно-исследовательской базе для ее осуществления (для образовательных организаций высшего образования и
        организаций дополнительного профессионального образования)</h4>
    <table>
        <thead class="table-fixed-head">
            <tr>
                <td>Код специальности, направления подготовки, шифр группы научных специальностей</td>
                <td>Наименование профессии, специальности, направления подготовки, наименование группы научных
                    специальностей</td>
                <td>Перечень научных направлений, в рамках которых ведется научная (научно-исследовательская)
                    деятельность</td>
                <td>Образовательная программа, направленность, профиль, шифр и наименование научной специальности</td>
                <td>Уровень образования</td>
                <td>Название научного направления/научной школы</td>
                <td>Результаты научной (научно-исследовательской) деятельности</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7">
                    <div class="content_alert alert-1c danger_oform">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                            viewBox="0 0 30 30">
                            <path fill="#c74343" d="M0 12L2 12 2 23 4 23 4 10 0 10z"></path>
                            <path fill="#c74343"
                                d="M2 9L5 9 5 23 7 23 7 7 2 7zM11 15c0-3.309 2.691-6 6-6s6 2.691 6 6h2c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8h13v-2H17C13.691 21 11 18.309 11 15z">
                            </path>
                            <path fill="#c74343"
                                d="M17,17c-1.103,0-2-0.897-2-2s0.897-2,2-2s2,0.897,2,2h2c0-2.206-1.794-4-4-4s-4,1.794-4,4 s1.794,4,4,4h13v-2H17z">
                            </path>
                        </svg>
                        <p>ВНИМАИЕ !</p>
                        <p>Поля для этой таблицы выгружаются из 1C</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
<!--Конец сведений-->