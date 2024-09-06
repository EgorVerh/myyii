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
    <style>
        .input_margin_top_whit_long_text {
            margin-top: 20px;
        }

        .input_margin_top_whit_short_text {
            margin-top: 36px;
        }

        #delreport {
            margin-top: 65px;
        }

        #add_url,
        #add_report,
        #add_doc,
        #add_row_tabel {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <input type="hidden" id="whatisurl" value=7>
    <h1 style="margin-bottom:20px;">Образование</h1>
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
                            <h4>Информация о трудоустройстве выпускников для каждой реализуемой образовательной программы, по которой состоялся выпуск</h4>
                            <?php foreach ($tables as $number => $row) {
                                if ($row["fieldsforms_id"] == 75) { ?>
                                    <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                        value="<?php echo $row["id"] ?>">
                                    <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                        value="<?php echo $row["fieldsforms_id"] ?>">
                                    <div class="row oform_row temporarystyle">
                                        <div class="col-sm-3"><label for="NameObject">Код</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][0]["id"] ?>">
                                            <input type="text" class="form-control input_margin_top_whit_short_text" id="NameObject"
                                                name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][0]["data"] ?>" required>
                                        </div>
                                        <div class="col-sm-3"><label for="LegaLaddressFounder">Наименование профессии, специальности, в том числе научной, направления подготовки</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][1]["id"] ?>">
                                            <input type="text" class="form-control input_margin_top_whit_long_text"
                                                id="LegaLaddressFounder" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][1]["data"] ?>" required>
                                        </div>
                                        <div class="col-sm-2"><label for="Square">Образовательная программа, направленность, профиль, шифр и наименование научной специальности</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][2]["id"] ?>">
                                            <input type="text"
                                                class="form-control input_margin_top_whit_short_text" id="Square"
                                                name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][2]["data"] ?>">
                                        </div>
                                        <div class="col-sm-2"><label for="Amount">Численность выпускников прошлого учебного года</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][3]["id"] ?>">
                                            <input type="number" min="0" class="form-control input_margin_top_whit_short_text"
                                                id="Amount" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][3]["data"] ?>">
                                        </div>
                                        <div class="col-sm-2"><label for="OVZ">Численность трудоустроенных выпускников прошлого учебного года</label>
                                            <input type="hidden" name="tableobj[<?php echo $number ?>][0][]"
                                                value="<?php echo $row["extraFields"][4]["id"] ?>">
                                            <input type="number" min="0"
                                                class="form-control input_margin_top_whit_long_text" id="OVZ"
                                                name="tableobj[<?php echo $number ?>][0][]"
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
</body>
<!--Конец сведений-->