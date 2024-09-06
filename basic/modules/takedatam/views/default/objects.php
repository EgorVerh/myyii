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
    <title>Финансово-хозяйственная деятельность</title>
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
    <input type="hidden" id="whatisurl" value=6>
    <h1 style="margin-bottom:20px;">Финансово-хозяйственная деятельность</h1>
    <form method="post" enctype="multipart/form-data">
        <?php
        $count_rows_tabels = 0;
        $count_url = 0;
        ?>
        <?php if (isset($tables)) { ?>
            <h4>Сведения о библиотеках</h4>
            <?php foreach ($tables as $number => $row) {
                if ($row["fieldsforms_id"] == 49) { ?>
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
            <div class="rightbuttonposition"><button type="button" id="add_row_tabel" class="btn btn-success" value=49>+
                    Добавить</button></div>
            <h4>Сведения об объектах спорта</h4>
            <?php foreach ($tables as $number => $row) {
                if ($row["fieldsforms_id"] == 50) { ?>
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
        <div class="rightbuttonposition"><button type="button" id="add_row_tabel" class="btn btn-success" value=50>+
                Добавить</button></div>
        <?php if (!empty($singledata)) {
            foreach ($singledata as $number => $data) {
                if ($data["fieldsforms_id"] != 65 && $data["fieldsforms_id"] != 66) { ?>
                    <h4>
                        <?php echo $data["titel"] ?>
                    </h4>
                    <input type="hidden" name="budget[<?php echo $number ?>][]" value="<?php echo $data["id"] ?>">
                    <input type="hidden" name="budget[<?php echo $number ?>][]" value="<?php echo $data["fieldsforms_id"] ?>">
                    <input type="hidden" name="budget[<?php echo $number ?>][]" value="<?php echo $data["titel"] ?>">
                    <?php if ($number >= 6 && $number <= 8) { ?>
                        <input type="number" step="0.01" min="0" name="budget[<?php echo $number ?>][]"
                            value="<?php echo $data["data"] ?>">
                    <?php } else { ?>
                        <input type="text" name="budget[<?php echo $number ?>][]" value="<?php echo $data["data"] ?>">
                    <?php } ?>
                <?php }
            }
        } else { ?>
            <h4>Информация об обеспечении беспрепятственного доступа в здания образовательной организации</h4>
            <input type="hidden" name="budget[0][]" value="0">
            <input type="hidden" name="budget[0][]" value=56>
            <input type="hidden" name="budget[0][]"
                value=" Информация об обеспечении беспрепятственного доступа в здания образовательной организации">
            <input type="text" name="budget[0][]">
            <h4>Сведения о средствах обучения и воспитания</h4>
            <input type="hidden" name="budget[1][]" value="0">
            <input type="hidden" name="budget[1][]" value=57>
            <input type="hidden" name="budget[1][]" value="Сведения о средствах обучения и воспитания">
            <input type="text" name="budget[1][]">
            <h4>Информация о приспособленных средствах обучения и воспитания</h4>
            <input type="hidden" name="budget[2][]" value="0">
            <input type="hidden" name="budget[2][]" value=58>
            <input type="hidden" name="budget[2][]" value="Информация о приспособленных средствах обучения и воспитания">
            <input type="text" name="budget[2][]">
            <h4>Сведения о доступе к информационным системам и информационно-телекоммуникационным сетям</h4>
            <input type="hidden" name="budget[3][]" value="0">
            <input type="hidden" name="budget[3][]" value=59>
            <input type="hidden" name="budget[3][]"
                value="Сведения о доступе к информационным системам и информационно-телекоммуникационным сетям">
            <input type="text" name="budget[3][]">
            <h4>Информация о доступе к приспособленным информационным системам и информационнотелекоммуникационным сетям
            </h4>
            <input type="hidden" name="budget[4][]" value="0">
            <input type="hidden" name="budget[4][]" value=60>
            <input type="hidden" name="budget[4][]"
                value="Информация о доступе к приспособленным информационным системам и информационнотелекоммуникационным сетям">
            <input type="text" name="budget[4][]">
            <h4>Наличие в образовательной организации электронной информационно-образовательной среды</h4>
            <input type="hidden" name="budget[5][]" value="0">
            <input type="hidden" name="budget[5][]" value=61>
            <input type="hidden" name="budget[5][]"
                value="Наличие в образовательной организации электронной информационно-образовательной среды">
            <input type="text" name="budget[5][]">
            <h4>Количество собственных электронных образовательных и информационных ресурсов</h4>
            <input type="hidden" name="budget[6][]" value="0">
            <input type="hidden" name="budget[6][]" value=62>
            <input type="hidden" name="budget[6][]"
                value="Количество собственных электронных образовательных и информационных ресурсов">
            <input type="number" min="0" name="budget[6][]">
            <h4>Количество сторонних электронных образовательных и информационных ресурсов</h4>
            <input type="hidden" name="budget[7][]" value="0">
            <input type="hidden" name="budget[7][]" value=63>
            <input type="hidden" name="budget[7][]"
                value="Количество сторонних электронных образовательных и информационных ресурсов">
            <input type="number" min="0" name="budget[7][]">
            <h4>Количество баз данных электронного каталога</h4>
            <input type="hidden" name="budget[8][]" value="0">
            <input type="hidden" name="budget[8][]" value=64>
            <input type="hidden" name="budget[8][]" value="Количество баз данных электронного каталога">
            <input type="number" min="0" name="budget[8][]">
            <h4>Информация о наличии специальных технических средств обучения коллективного и индивидуального пользования
            </h4>
            <input type="hidden" name="budget[9][]" value="0">
            <input type="hidden" name="budget[9][]" value=67>
            <input type="hidden" name="budget[9][]"
                value="Информация о наличии специальных технических средств обучения коллективного и индивидуального пользования">
            <input type="text" name="budget[9][]">
            <h4>Информация о наличии условий для беспрепятственного доступа в общежитие, интернат</h4>
            <input type="hidden" name="budget[10][]" value="0">
            <input type="hidden" name="budget[10][]" value=68>
            <input type="hidden" name="budget[10][]"
                value="Информация о наличии условий для беспрепятственного доступа в общежитие, интернат">
            <input type="text" name="budget[10][]">
        <?php } ?>
        <?php if (isset($singledata)) { ?>
            <h4>Ссылка на электронный образовательный ресурс, к которым обеспечивается доступ обучающихся</h4>
            <?php foreach ($singledata as $data) {
                if ($data["fieldsforms_id"] == 65 && $data["enabled"] == 1) { ?>
                    <div class="row oform_row" value="<?php echo $count_url ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_url ?>][]" value="<?php echo $data["id"] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_url ?>][]" value=65>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_url ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_url ?>][]" placeholder="Статья"
                                value="<?php echo $data['titel'] ?>" required><br>
                            <label for="url<?php echo $count_url ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_url ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $data["data"] ?>">
                        </div>
                        <div>
                            <button type="button" id="delurl" class="btn btn-danger delbutton" tabindex="-1"
                                value='/delete_grants'>X</button>
                            <button type="button" id="hide_url" value='/delete_grants' class="hidebutton btn delbutton"
                                tabindex="-1" style="background-color: #f5f5f5;"><svg xmlns="http://www.w3.org/2000/svg" width="25"
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
                    <?php $count_url++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_url" class="btn btn-success" value=65>+
                    Добавить</button></div>
            <h4>Ссылка на приспособленный электронный образовательный ресурс, к которым обеспечивается доступ</h4>
            <?php foreach ($singledata as $data) {
                if ($data["fieldsforms_id"] == 66 && $data["enabled"] == 1) { ?>
                    <div class="row oform_row" value="<?php echo $count_url ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_url ?>][]" value="<?php echo $data["id"] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_url ?>][]" value=66>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_url ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_url ?>][]" placeholder="Статья"
                                value="<?php echo $data['titel'] ?>" required><br>
                            <label for="url<?php echo $count_url ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_url ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $data["data"] ?>">
                        </div>
                        <div>
                            <button type="button" id="delurl" class="btn btn-danger delbutton" tabindex="-1"
                                value='/delete_grants'>X</button>
                            <button type="button" id="hide_url" value='/delete_grants' class="hidebutton btn delbutton"
                                tabindex="-1" style="background-color: #f5f5f5;"><svg xmlns="http://www.w3.org/2000/svg" width="25"
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
                    <?php $count_url++;
                }
            }
        } ?>
        <div class="rightbuttonposition"><button type="button" id="add_url" class="btn btn-success" value=66>+
                Добавить</button></div>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), ['id' => "csfr"]) ?>
    </form>
    <input type="hidden" id="count_rows_tabels" value=<?php echo $count_rows_tabels ?>>
    <input type="hidden" id="count_url" value=<?php echo $count_url ?>>
</body>