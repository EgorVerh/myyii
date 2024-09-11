<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;
AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/document.js');
$this->registerCssFile('@modulestakedatamcss/styles.css')
    ?>

<head>
    <title>Документы</title>
</head>

<body>
    <?= $this->params["MenuSectionsWidget"] ?>
    <input type="hidden" id="whatisurl" value=1>
    <h1>Документы</h1>
    <!--Сгенерированные сведения-->
    <form method="post" enctype="multipart/form-data">
        <?php $count_row = 0; ?>
        <h4>Копия устава образовательной организации</h4>
        <?php if (isset($tabledata)) {
            foreach ($tabledata as $table) {
                if ($table["fieldsforms_id"] == 11 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value="<?php echo $table["position"] ?>">
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=11>
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
                <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=11>+
                        Добавить</button></div>
                <div>
                    <h4>Копия свидетельства о государственной аккредитации (с приложениями)</h4>
                </div>
                <?php foreach ($tabledata as $table) {
                    if ($table["fieldsforms_id"] == 12 && $table["enabled"] == 1) { ?>
                        <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                value="<?php echo $table["position"] ?>">
                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=12>
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
                    <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=12>+
                            Добавить</button></div>
                    <h4>Копия локального нормативного акта, регламентирующего правила приема обучающихся</h4>
                    <?php foreach ($tabledata as $table) {
                        if ($table["fieldsforms_id"] == 13 && $table["enabled"] == 1) { ?>
                            <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                    value="<?php echo $table["position"] ?>">
                                <input type="hidden" name="document[<?php echo $count_row ?>][]" value=13>
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
                                value=13>+
                                Добавить</button></div>
                        <h4>Копия локального нормативного акта, регламентирующего режим занятий обучающихся</h4>
                        <?php foreach ($tabledata as $table) {
                            if ($table["fieldsforms_id"] == 14 && $table["enabled"] == 1) { ?>
                                <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                    <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                        value="<?php echo $table["position"] ?>">
                                    <input type="hidden" name="document[<?php echo $count_row ?>][]" value=14>
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
                        ?>
                            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success"
                                    value=14>+ Добавить</button></div>
                            <h4>Копия локального нормативного акта, регламентирующего формы, периодичность и порядок
                                текущего контроля
                                успеваемости и промежуточной аттестации обучающихся</h4>
                            <?php foreach ($tabledata as $table) {
                                if ($table["fieldsforms_id"] == 15 && $table["enabled"] == 1) { ?>
                                    <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                        <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                            value="<?php echo $table["position"] ?>">
                                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=15>
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
                            ?>
                                <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success"
                                        value=15>+ Добавить</button></div>
                                <h4>Копия локального нормативного акта, регламентирующего порядок и основания перевода,
                                    отчисления и
                                    восстановления обучающихся</h4>
                                <?php foreach ($tabledata as $table) {
                                    if ($table["fieldsforms_id"] == 16 && $table["enabled"] == 1) { ?>
                                        <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                value="<?php echo $table["position"] ?>">
                                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=16>
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
                                                                    class="form-control file-loading"
                                                                    name="document[<?php echo $count_row ?>]"
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
                                ?>
                                    <div class="rightbuttonposition"><button type="button" id="add_row"
                                            class="btn btn-success" value=16>+ Добавить</button></div>
                                    <h4>Копия локального нормативного акта, регламентирующего порядок оформления
                                        возникновения, приостановления и
                                        прекращения отношений между образовательной организацией и обучающимися и (или)
                                        родителями (законными
                                        представителями) несовершеннолетних обучающихся</h4>
                                    <?php foreach ($tabledata as $table) {
                                        if ($table["fieldsforms_id"] == 17 && $table["enabled"] == 1) { ?>
                                            <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                                <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                    value="<?php echo $table["position"] ?>">
                                                <input type="hidden" name="document[<?php echo $count_row ?>][]" value=17>
                                                <div class="col-sm-11">
                                                    <label for="document_purpose<?php echo $count_row ?>"> Назначение
                                                        докумета</label>
                                                    <input class="form-control" type="text"
                                                        name="document[<?php echo $count_row ?>][]"
                                                        placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                                        value="<?php echo $table["titel"] ?>" required><br>
                                                    <?php if ($table["data"] == '') { ?>
                                                        <div><label class="control-label" for="File<?php echo $count_row ?>">Документ
                                                                для
                                                                загрузки</label>
                                                            <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                    type="file" id="File<?php echo $count_row ?>"
                                                                    class="form-control file-loading wrong_file"
                                                                    name="document[<?php echo $count_row ?>]"
                                                                    accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                            <?php } else { ?><input type="file" id="File<?php echo $count_row ?>"
                                                                    class="form-control file-loading"
                                                                    name="document[<?php echo $count_row ?>]"
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
                                                                        class="form-control file-loading"
                                                                        name="document[<?php echo $count_row ?>]"
                                                                        accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button type="button" id="delrow" class="btn btn-danger delbutton"
                                                            tabindex="-1" value='/delete_document'>X</button>
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
                                    ?>
                                        <div class="rightbuttonposition"><button type="button" id="add_row"
                                                class="btn btn-success" value=17>+ Добавить</button></div>
                                        <h4>Копия правил внутреннего распорядка обучающихся</h4>
                                        <?php foreach ($tabledata as $table) {
                                            if ($table["fieldsforms_id"] == 18 && $table["enabled"] == 1) { ?>
                                                <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                                    <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                        value="<?php echo $table["position"] ?>">
                                                    <input type="hidden" name="document[<?php echo $count_row ?>][]" value=18>
                                                    <div class="col-sm-11">
                                                        <label for="document_purpose<?php echo $count_row ?>"> Назначение
                                                            докумета</label>
                                                        <input class="form-control" type="text"
                                                            name="document[<?php echo $count_row ?>][]"
                                                            placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                                            value="<?php echo $table["titel"] ?>" required><br>
                                                        <?php if ($table["data"] == '') { ?>
                                                            <div><label class="control-label"
                                                                    for="File<?php echo $count_row ?>">Документ для
                                                                    загрузки</label>
                                                                <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                        type="file" id="File<?php echo $count_row ?>"
                                                                        class="form-control file-loading wrong_file"
                                                                        name="document[<?php echo $count_row ?>]"
                                                                        accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                <?php } else { ?><input type="file" id="File<?php echo $count_row ?>"
                                                                        class="form-control file-loading"
                                                                        name="document[<?php echo $count_row ?>]"
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
                                                                    <?php } else { ?><input type="file"
                                                                            id="File<?php echo $count_row ?>"
                                                                            class="form-control file-loading"
                                                                            name="document[<?php echo $count_row ?>]"
                                                                            accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button type="button" id="delrow" class="btn btn-danger delbutton"
                                                                tabindex="-1" value='/delete_document'>X</button>
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
                                        ?>
                                            <div class="rightbuttonposition"><button type="button" id="add_row"
                                                    class="btn btn-success" value=18>+
                                                    Добавить</button></div>
                                            <h4>Копия правил внутреннего трудового распорядка</h4>
                                            <?php foreach ($tabledata as $table) {
                                                if ($table["fieldsforms_id"] == 19 && $table["enabled"] == 1) { ?>
                                                    <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                                        <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                            value="<?php echo $table["position"] ?>">
                                                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=19>
                                                        <div class="col-sm-11">
                                                            <label for="document_purpose<?php echo $count_row ?>"> Назначение
                                                                докумета</label>
                                                            <input class="form-control" type="text"
                                                                name="document[<?php echo $count_row ?>][]"
                                                                placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                                                value="<?php echo $table["titel"] ?>" required><br>
                                                            <?php if ($table["data"] == '') { ?>
                                                                <div><label class="control-label"
                                                                        for="File<?php echo $count_row ?>">Документ для
                                                                        загрузки</label>
                                                                    <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                            type="file" id="File<?php echo $count_row ?>"
                                                                            class="form-control file-loading wrong_file"
                                                                            name="document[<?php echo $count_row ?>]"
                                                                            accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                    <?php } else { ?><input type="file"
                                                                            id="File<?php echo $count_row ?>"
                                                                            class="form-control file-loading"
                                                                            name="document[<?php echo $count_row ?>]"
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
                                                                        <?php } else { ?><input type="file"
                                                                                id="File<?php echo $count_row ?>"
                                                                                class="form-control file-loading"
                                                                                name="document[<?php echo $count_row ?>]"
                                                                                accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button type="button" id="delrow" class="btn btn-danger delbutton"
                                                                    tabindex="-1" value='/delete_document'>X</button>
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
                                            ?>
                                                <div class="rightbuttonposition"><button type="button" id="add_row"
                                                        class="btn btn-success" value=19>+ Добавить</button></div>
                                                <h4>Копия коллективного договора</h4>
                                                <?php foreach ($tabledata as $table) {
                                                    if ($table["fieldsforms_id"] == 20 && $table["enabled"] == 1) { ?>
                                                        <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                value="<?php echo $table["position"] ?>">
                                                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                value=20>
                                                            <div class="col-sm-11">
                                                                <label for="document_purpose<?php echo $count_row ?>"> Назначение
                                                                    докумета</label>
                                                                <input class="form-control" type="text"
                                                                    name="document[<?php echo $count_row ?>][]"
                                                                    placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                                                    value="<?php echo $table["titel"] ?>" required><br>
                                                                <?php if ($table["data"] == '') { ?>
                                                                    <div><label class="control-label"
                                                                            for="File<?php echo $count_row ?>">Документ для
                                                                            загрузки</label>
                                                                        <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                                type="file" id="File<?php echo $count_row ?>"
                                                                                class="form-control file-loading wrong_file"
                                                                                name="document[<?php echo $count_row ?>]"
                                                                                accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                        <?php } else { ?><input type="file"
                                                                                id="File<?php echo $count_row ?>"
                                                                                class="form-control file-loading"
                                                                                name="document[<?php echo $count_row ?>]"
                                                                                accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                                                    <?php } else { ?>
                                                                        <div class="labeloform"><a class="colorhref" target="_blank"
                                                                                href="<?php echo $table["data"] ?>">Ссылка на
                                                                                загруженный
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
                                                                            <?php } else { ?><input type="file"
                                                                                    id="File<?php echo $count_row ?>"
                                                                                    class="form-control file-loading"
                                                                                    name="document[<?php echo $count_row ?>]"
                                                                                    accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <button type="button" id="delrow"
                                                                        class="btn btn-danger delbutton" tabindex="-1"
                                                                        value='/delete_document'>X</button>
                                                                    <button type="button" id="hide_button" value='/delete_document'
                                                                        class="btn delbutton hidebutton" tabindex="-1"><svg
                                                                            xmlns="http://www.w3.org/2000/svg" width="25"
                                                                            height="25" class="bi bi-eye-slash" viewBox="0 0 16 16">
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
                                                    <div class="rightbuttonposition"><button type="button" id="add_row"
                                                            class="btn btn-success" value=20>+ Добавить</button></div>
                                                    <h4>Отчет о результатах самообследования</h4>
                                                    <?php foreach ($tabledata as $table) {
                                                        if ($table["fieldsforms_id"] == 21 && $table["enabled"] == 1) { ?>
                                                            <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                                                <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                    value="<?php echo $table["position"] ?>">
                                                                <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                    value=21>
                                                                <div class="col-sm-11">
                                                                    <label for="document_purpose<?php echo $count_row ?>">
                                                                        Назначение докумета</label>
                                                                    <input class="form-control" type="text"
                                                                        name="document[<?php echo $count_row ?>][]"
                                                                        placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                                                        value="<?php echo $table["titel"] ?>" required><br>
                                                                    <?php if ($table["data"] == '') { ?>
                                                                        <div><label class="control-label"
                                                                                for="File<?php echo $count_row ?>">Документ для
                                                                                загрузки</label>
                                                                            <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                                    type="file" id="File<?php echo $count_row ?>"
                                                                                    class="form-control file-loading wrong_file"
                                                                                    name="document[<?php echo $count_row ?>]"
                                                                                    accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                            <?php } else { ?><input type="file"
                                                                                    id="File<?php echo $count_row ?>"
                                                                                    class="form-control file-loading"
                                                                                    name="document[<?php echo $count_row ?>]"
                                                                                    accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls"><?php } ?>
                                                                        <?php } else { ?>
                                                                            <div class="labeloform"><a class="colorhref" target="_blank"
                                                                                    href="<?php echo $table["data"] ?>">Ссылка на
                                                                                    загруженный
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
                                                                                <?php } else { ?><input type="file"
                                                                                        id="File<?php echo $count_row ?>"
                                                                                        class="form-control file-loading"
                                                                                        name="document[<?php echo $count_row ?>]"
                                                                                        accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button type="button" id="delrow"
                                                                            class="btn btn-danger delbutton" tabindex="-1"
                                                                            value='/delete_document'>X</button>
                                                                        <button type="button" id="hide_button"
                                                                            value='/delete_document'
                                                                            class="btn delbutton hidebutton" tabindex="-1"><svg
                                                                                xmlns="http://www.w3.org/2000/svg" width="25"
                                                                                height="25" class="bi bi-eye-slash"
                                                                                viewBox="0 0 16 16">
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
                                                        <div class="rightbuttonposition"><button type="button" id="add_row"
                                                                class="btn btn-success" value=21>+ Добавить</button></div>
                                                        <h4>Предписания органов, осуществляющих государственный контроль
                                                            (надзор) в сфере образования</h4>
                                                        <?php foreach ($tabledata as $table) {
                                                            if ($table["fieldsforms_id"] == 22 && $table["enabled"] == 1) { ?>
                                                                <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                                                    <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                        value="<?php echo $table["position"] ?>">
                                                                    <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                        value=22>
                                                                    <div class="col-sm-11">
                                                                        <label for="document_purpose<?php echo $count_row ?>">
                                                                            Назначение докумета</label>
                                                                        <input class="form-control" type="text"
                                                                            name="document[<?php echo $count_row ?>][]"
                                                                            placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                                                            value="<?php echo $table["titel"] ?>" required><br>
                                                                        <?php if ($table["data"] == '') { ?>
                                                                            <div><label class="control-label"
                                                                                    for="File<?php echo $count_row ?>">Документ для
                                                                                    загрузки</label>
                                                                                <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                                        type="file" id="File<?php echo $count_row ?>"
                                                                                        class="form-control file-loading wrong_file"
                                                                                        name="document[<?php echo $count_row ?>]"
                                                                                        accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                <?php } else { ?><input type="file"
                                                                                        id="File<?php echo $count_row ?>"
                                                                                        class="form-control file-loading"
                                                                                        name="document[<?php echo $count_row ?>]"
                                                                                        accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                <?php } ?>
                                                                            <?php } else { ?>
                                                                                <div class="labeloform"><a class="colorhref"
                                                                                        target="_blank"
                                                                                        href="<?php echo $table["data"] ?>">Ссылка на
                                                                                        загруженный
                                                                                        файл</a></div>
                                                                                <div style="margin-top:20px;"><label
                                                                                        class="control-label"
                                                                                        for="File<?php echo $count_row ?>">Заменить
                                                                                        загруженный
                                                                                        файл</label>
                                                                                    <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                                            type="file" id="File<?php echo $count_row ?>"
                                                                                            class="form-control file-loading wrong_file"
                                                                                            name="document[<?php echo $count_row ?>]"
                                                                                            accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                    <?php } else { ?><input type="file"
                                                                                            id="File<?php echo $count_row ?>"
                                                                                            class="form-control file-loading"
                                                                                            name="document[<?php echo $count_row ?>]"
                                                                                            accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" id="delrow"
                                                                                class="btn btn-danger delbutton" tabindex="-1"
                                                                                value='/delete_document'>X</button>
                                                                            <button type="button" id="hide_button"
                                                                                value='/delete_document'
                                                                                class="btn delbutton hidebutton" tabindex="-1"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg" width="25"
                                                                                    height="25" class="bi bi-eye-slash"
                                                                                    viewBox="0 0 16 16">
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
                                                            <div class="rightbuttonposition"><button type="button"
                                                                    id="add_row" class="btn btn-success" value=22>+
                                                                    Добавить</button></div>
                                                            <h4>Отчёты об исполнении предписаний органов, осуществляющих
                                                                государственный контроль (надзор) в сфере
                                                                образования</h4>
                                                            <?php foreach ($tabledata as $table) {
                                                                if ($table["fieldsforms_id"] == 23 && $table["enabled"] == 1) { ?>
                                                                    <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                                                                        <input type="hidden"
                                                                            name="document[<?php echo $count_row ?>][]"
                                                                            value="<?php echo $table["position"] ?>">
                                                                        <input type="hidden"
                                                                            name="document[<?php echo $count_row ?>][]" value=23>
                                                                        <div class="col-sm-11">
                                                                            <label for="document_purpose<?php echo $count_row ?>">
                                                                                Назначение
                                                                                докумета</label>
                                                                            <input class="form-control" type="text"
                                                                                name="document[<?php echo $count_row ?>][]"
                                                                                placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."
                                                                                value="<?php echo $table["titel"] ?>" required><br>
                                                                            <?php if ($table["data"] == '') { ?>
                                                                                <div><label class="control-label"
                                                                                        for="File<?php echo $count_row ?>">Документ для
                                                                                        загрузки</label>
                                                                                    <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                                            type="file" id="File<?php echo $count_row ?>"
                                                                                            class="form-control file-loading wrong_file"
                                                                                            name="document[<?php echo $count_row ?>]"
                                                                                            accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                    <?php } else { ?><input type="file"
                                                                                            id="File<?php echo $count_row ?>"
                                                                                            class="form-control file-loading"
                                                                                            name="document[<?php echo $count_row ?>]"
                                                                                            accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                    <?php } ?>
                                                                                <?php } else { ?>
                                                                                    <div class="labeloform"><a class="colorhref"
                                                                                            target="_blank"
                                                                                            href="<?php echo $table["data"] ?>">Ссылка
                                                                                            на загруженный
                                                                                            файл</a></div>
                                                                                    <div style="margin-top:20px;"><label
                                                                                            class="control-label"
                                                                                            for="File<?php echo $count_row ?>">Заменить
                                                                                            загруженный
                                                                                            файл</label>
                                                                                        <?php if (isset($position_wrong) && in_array($table["position"], $position_wrong)) { ?><input
                                                                                                type="file"
                                                                                                id="File<?php echo $count_row ?>"
                                                                                                class="form-control file-loading wrong_file"
                                                                                                name="document[<?php echo $count_row ?>]"
                                                                                                accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                        <?php } else { ?><input type="file"
                                                                                                id="File<?php echo $count_row ?>"
                                                                                                class="form-control file-loading"
                                                                                                name="document[<?php echo $count_row ?>]"
                                                                                                accept=".jpeg,.jpg,.png,.doc,.pdf,.csv,.xls">
                                                                                        <?php } ?>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <button type="button" id="delrow"
                                                                                    class="btn btn-danger delbutton" tabindex="-1"
                                                                                    value='/delete_document'>X</button>
                                                                                <button type="button" id="hide_button"
                                                                                    value='/delete_document'
                                                                                    class="btn delbutton hidebutton"
                                                                                    tabindex="-1"><svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="25" height="25"
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
                                                            <div class="rightbuttonposition"><button type="button"
                                                                    id="add_row" class="btn btn-success" value=23>+
                                                                    Добавить</button></div>

                                                            <div class="form-group" style="margin-top:10px;">
                                                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                                                            </div>
                                                            <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
</body>
<!--Конец сведений-->