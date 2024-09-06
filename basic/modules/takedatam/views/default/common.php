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
    <title>Основные сведения</title>
    <style>
        h4 {
            font-size: medium;
        }

        .label_text {
            margin-top: 8px;
        }

        .label_other {
            margin-top: 4px;
        }

        .button_margin_common {
            margin: 25px 0 10px 0;
        }

        .input_margin_extra {
            margin-top: 4px;
        }

        .input_margin_extra_phone {
            margin-top: 8px;
        }

        .rightbuttonposition_text {
            text-align: right;
        }

        #add_row {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        td,
        tr,
        table {
            border: 1px solid black;
            font-size: medium;
            padding: 20px;
        }
    </style>
</head>

<body>
    <input type="hidden" id="whatisurl" value=2>
    <h4 style="margin-bottom:20px;">Основные сведения</h4>
    <table>
        <tbody>
            <tr>
                <td>
                    Полное наименование образовательной организации
                </td>
                <td rowspan="9">
                    <div class="alert alert-danger" style="text-align: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-exclamation-triangle" viewBox="0 0 20 20">
                            <path
                                d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z" />
                            <path
                                d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                        </svg>
                        <p>ВНИМАИЕ !</p>
                        <p>Поля для этой таблицы заполняются не здесь</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    Сокращенное (при наличии) наименование образовательной организации
                </td>
            </tr>
            <tr>
                <td>
                    Дата создания образовательной организации
                </td>
            </tr>
            <tr>
                <td>
                    Адрес местонахождения образовательной организации
                </td>
            </tr>
            <tr>
                <td>
                    Филиалы образовательной организации
                </td>
            </tr>
            <tr>
                <td>
                    Представительства образовательной организации
                </td>

            </tr>
            <tr>
                <td>
                    Режим, график работы
                </td>
            </tr>
            <tr>
                <td>
                    Контактные телефоны
                </td>
            </tr>
            <tr>
                <td>
                    Адреса электронной почты
                </td>
            </tr>
        </tbody>
    </table>
    <?php
    $count_row = 0;
    $phone = false;
    $email = false;
    $website = false;
    ?>
    <form method="post" enctype="multipart/form-data">
        <h4>Сведения о каждом учредителе образовательной организации</h4>
        <?php if (isset($datarows) && !empty($datarows)) { ?>
            <div class="row oform_row temporarystyle">
                <input type="hidden" name="common[0][0][]" value="<?php echo $datarows[0]["id"] ?>">
                <input type="hidden" name="common[0][0][]" value=24>
                <div class="col-sm-3"><label for="NameFounderEduOrganization">Наименование учредителя образовательной
                        организации</label><input type="text" class="form-control label_text"
                        id="NameFounderEduOrganization" name="common[0][0][]"
                        placeholder="Наименование учредителя образовательной организации" required
                        value="<?php echo $datarows[0]["titel"] ?>"></div>
                <div class="col-sm-2"><label for="LegaLaddressFounder">Юридический адрес учредителя</label><input
                        type="text" class="form-control label_text" id="LegaLaddressFounder" name="common[0][0][]"
                        placeholder="Юридический адрес учредителя" required value="<?php echo $datarows[0]["data"]; ?>">
                </div>
                <?php if (isset($datarows[0]["extraFields"]) && !empty($datarows[0]["extraFields"])) {
                    foreach ($datarows[0]["extraFields"] as $exrafield) {
                        if ($exrafield["type"] == "phone") {
                            $phone = true; ?>
                            <div class="col-sm-2"><label for="ContactTelephoneNumbers">Контактные телефоны</label>
                                <input type="text" class="form-control input_margin_extra_phone" id="ContactTelephoneNumbers"
                                    name="common[0][1][]" placeholder="Контактные телефоны" value="<?php echo $exrafield["data"] ?>">
                            </div>
                        <?php }
                    }
                    if (!$phone) {
                        $phone = true; ?>
                        <div class="col-sm-2"><label for="ContactTelephoneNumbers">Контактные телефоны</label>
                            <input type="text" class="form-control input_margin_extra_phone" id="ContactTelephoneNumbers"
                                name="common[0][1][]" placeholder="Контактные телефоны">
                        </div>
                    <?php }
                    foreach ($datarows[0]["extraFields"] as $exrafield) {
                        if ($exrafield["type"] == "email") {
                            $email = true; ?>
                            <div class="col-sm-2"><label for="EmailAddress">Адрес электронной почты</label>
                                <input type="email" class="form-control input_margin_extra" id="EmailAddress" name="common[0][2][]"
                                    placeholder="Адрес электронной почты" value="<?php echo $exrafield["data"] ?>">
                            </div>
                        <?php }
                    }
                    if (!$email) {
                        $email = true; ?>
                        <div class="col-sm-2"><label for="EmailAddress">Адрес электронной почты</label>
                            <input type="email" class="form-control input_margin_extra" id="EmailAddress" name="common[0][2][]"
                                placeholder="Адрес электронной почты">
                        </div>
                    <?php }
                    foreach ($datarows[0]["extraFields"] as $exrafield) {
                        if ($exrafield["type"] == "website") {
                            $website = true; ?>
                            <div class="col-sm-3"><label for="WebsiteAddress">Адрес сайта учредителя в сети «Интернет»</label>
                                <input type="url" class="form-control input_margin_extra" id="WebsiteAddress" name="common[0][3][]"
                                    placeholder="Адрес сайта учредителя в сети «Интернет»" value="<?php echo $exrafield["data"] ?>">
                            </div>
                        <?php }
                    }
                    if (!$website) {
                        $website = true; ?>
                        <div class="col-sm-3"><label for="WebsiteAddress">Адрес сайта учредителя в сети «Интернет»</label>
                            <input type="url" class="form-control input_margin_extra" id="WebsiteAddress" name="common[0][3][]"
                                placeholder="Адрес сайта учредителя в сети «Интернет»">
                        </div>
                    <?php }
                }
                if (!$phone) { ?>
                    <div class="col-sm-2"><label for="ContactTelephoneNumbers">Контактные телефоны</label>
                        <input type="text" class="form-control input_margin_extra_phone" id="ContactTelephoneNumbers"
                            name="common[0][1][]" placeholder="Контактные телефоны">
                    </div>
                <?php }
                if (!$email) { ?>
                    <div class="col-sm-2"><label for="EmailAddress">Адрес электронной почты</label>
                        <input type="email" class="form-control input_margin_extra" id="EmailAddress" name="common[0][2][]"
                            placeholder="Адрес электронной почты">
                    </div>
                <?php }
                if (!$website) { ?>
                    <div class="col-sm-3"><label for="WebsiteAddress">Адрес сайта учредителя в сети «Интернет»</label>
                        <input type="url" class="form-control input_margin_extra" id="WebsiteAddress" name="common[0][3][]"
                            placeholder="Адрес сайта учредителя в сети «Интернет»">
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="row oform_row temporarystyle">
                <input type="hidden" name="common[0][0][]" value=0>
                <input type="hidden" name="common[0][0][]" value=24>
                <div class="col-sm-3"><label for="NameFounderEduOrganization">Наименование учредителя образовательной
                        организации</label><input type="text" class="form-control label_text"
                        id="NameFounderEduOrganization" name="common[0][0][]"
                        placeholder="Наименование учредителя образовательной организации" required></div>
                <div class="col-sm-2"><label for="LegaLaddressFounder">Юридический адрес учредителя</label><input
                        type="text" class="form-control label_text" id="LegaLaddressFounder" name="common[0][0][]"
                        placeholder="Юридический адрес учредителя" required></div>
                <div class="col-sm-2"><label for="ContactTelephoneNumbers">Контактные телефоны</label>
                    <input type="text" class="form-control input_margin_extra_phone" id="ContactTelephoneNumbers"
                        name="common[0][1][]" placeholder="Контактные телефоны">
                </div>
                <div class="col-sm-2"><label for="EmailAddress">Адрес электронной почты</label>
                    <input type="email" class="form-control input_margin_extra" id="EmailAddress" name="common[0][2][]"
                        placeholder="Адрес электронной почты">
                </div>
                <div class="col-sm-3"><label for="WebsiteAddress">Адрес сайта учредителя в сети «Интернет»</label>
                    <input type="url" class="form-control input_margin_extra" id="WebsiteAddress" name="common[0][3][]"
                        placeholder="Адрес сайта учредителя в сети «Интернет»">
                </div>
            </div>
        <?php } ?>
        <h4>Лицензия на осуществление образовательной деятельности</h4>
        <?php if (isset($tabledata)) {
            foreach ($tabledata as $table) {
                if ($table["fieldsforms_id"] == 25 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value="<?php echo $table["position"] ?>">
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=25>
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
            } ?>
                <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=25>+
                        Добавить</button></div>
                <h4>Государственная аккредитация образовательной деятельности по реализуемым образовательным программам</h4>
                <?php foreach ($tabledata as $table) {
                    if ($table["fieldsforms_id"] == 26 && $table["enabled"] == 1) { ?>
                        <div class="row oform_row temporarystyle" value=<?php echo $count_row ?>>
                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                value="<?php echo $table["position"] ?>">
                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=25>
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
        } ?>
                <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=26>+
                        Добавить</button></div>
                <div class="form-group" style="margin-top:10px;">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
</body>