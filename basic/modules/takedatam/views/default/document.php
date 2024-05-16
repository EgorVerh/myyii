<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/document.js');
$this->registerCssFile('@modulestakedatamcss/document.css');
?>

<head>
    <title>Документы</title>
</head>

<body>
    <h1 style="margin-bottom:20px;">Документы</h1>
    <!--Сгенерированные сведения-->
    <form method="post" enctype="multipart/form-data">
        <?php $count_row = 0; ?>
        <h4>Копия устава образовательной организации</h4>
        <?php if (isset($tabledata)) {
            foreach ($tabledata as $table) {
                if ($table["NameFile"] == 11) { ?>
                    <div class="row temporarystyle" value=<?php echo $count_row ?>>
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=11>
                        <div class="col-sm-1">
                            <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                        </div>
                        <div class="col-sm-11">
                            <textarea class="form-control" name="document[<?php echo $count_row ?>][]"
                                placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                            <?php if ($table["Link"] == '') { ?>
                                <div class="col-md-11"><label class="control-label" for="File<?php echo $count_row ?>">Документ для
                                        загрузки</label><input type="file" id="File<?php echo $count_row ?>"
                                        class="form-control file-loading" name="document[<?php echo $count_row ?>]" multiple=""
                                        data-krajee-fileinput="fileinput_4efc2035">
                                <?php } else { ?>
                                    <div class="labeloform"><a target="_blank" href="<?php echo $table["Link"] ?>">Ссылка на загруженный
                                            файл</a></div>
                                    <div class="col-md-11" style="margin-top:20px;"><label class="control-label"
                                            for="File<?php echo $count_row ?>">Заменить
                                            загруженный
                                            файл</label><input type="file" id="File<?php echo $count_row ?>"
                                            class="form-control file-loading" name="document[<?php echo $count_row ?>]" multiple=""
                                            data-krajee-fileinput="fileinput_4efc2035">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php $count_row++;
                }
            }
            ?>
                <button type="button" id="add_row" style="margin-bottom:20px;" class="btn btn-success" value=11>+Добавить</button>

                <h4>Копия свидетельства о государственной аккредитации (с приложениями)</h4>
                <?php foreach ($tabledata as $table) {
                    if ($table["NameFile"] == 12) { ?>
                        <div class="row temporarystyle" value=<?php echo $count_row ?>>
                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=12>
                            <div class="col-sm-1">
                                <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                            </div>
                            <div class="col-sm-11">
                                <textarea class="form-control" name="document[<?php echo $count_row ?>][]"
                                    placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                <?php if ($table["Link"] == '') { ?>
                                    <div class="col-md-11"><label class="control-label" for="File<?php echo $count_row ?>">Документ для
                                            загрузки</label><input type="file" id="File<?php echo $count_row ?>"
                                            class="form-control file-loading" name="document[<?php echo $count_row ?>]" multiple=""
                                            data-krajee-fileinput="fileinput_4efc2035">
                                    <?php } else { ?>
                                        <div class="labeloform"><a target="_blank" href="<?php echo $table["Link"] ?>">Ссылка на
                                                загруженный
                                                файл</a></div>
                                        <div class="col-md-11" style="margin-top:20px;"><label class="control-label"
                                                for="File<?php echo $count_row ?>">Заменить
                                                загруженный
                                                файл</label><input type="file" id="File<?php echo $count_row ?>"
                                                class="form-control file-loading" name="document[<?php echo $count_row ?>]" multiple=""
                                                data-krajee-fileinput="fileinput_4efc2035">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php $count_row++;
                    }
                }
                ?>
                    <button type="button" id="add_row" class="btn btn-success" value=12>+Добавить</button>

                    <h4>Копия локального нормативного акта, регламентирующего правила приема обучающихся</h4>
                    <?php foreach ($tabledata as $table) {
                        if ($table["NameFile"] == 13) { ?>
                            <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                                <input type="hidden" name="document[<?php echo $count_row ?>][]" value=13>
                                <div class="col-sm-1">
                                    <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                </div>
                                <div class="col-sm-11">
                                    <textarea class="form-control" name="document[<?php echo $count_row ?>][]"
                                        placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                    <?php if ($table["Link"] == '') { ?>
                                        <div class="col-md-11"><label class="control-label" for="File<?php echo $count_row ?>">Документ
                                                для
                                                загрузки</label><input type="file" id="File<?php echo $count_row ?>"
                                                class="form-control file-loading" name="document[<?php echo $count_row ?>]" multiple=""
                                                data-krajee-fileinput="fileinput_4efc2035">
                                        <?php } else { ?>
                                            <div class="labeloform"><a target="_blank" href="<?php echo $table["Link"] ?>">Ссылка на
                                                    загруженный
                                                    файл</a></div>
                                            <div class="col-md-11" style="margin-top:20px;"><label class="control-label"
                                                    for="File<?php echo $count_row ?>">Заменить
                                                    загруженный
                                                    файл</label><input type="file" id="File<?php echo $count_row ?>"
                                                    class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                    multiple="" data-krajee-fileinput="fileinput_4efc2035">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $count_row++;
                        }
                    }
                    ?>
                        <button type="button" id="add_row" class="btn btn-success" value=13>+Добавить</button>

                        <h4>Копия локального нормативного акта, регламентирующего режим занятий обучающихся</h4>
                        <?php foreach ($tabledata as $table) {
                            if ($table["NameFile"] == 14) { ?>
                                <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                    <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                                    <input type="hidden" name="document[<?php echo $count_row ?>][]" value=14>
                                    <div class="col-sm-1">
                                        <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                    </div>
                                    <div class="col-sm-11">
                                        <textarea class="form-control" name="document[<?php echo $count_row ?>][]"
                                            placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                        <?php if ($table["Link"] == '') { ?>
                                            <div class="col-md-11"><label class="control-label"
                                                    for="File<?php echo $count_row ?>">Документ для
                                                    загрузки</label><input type="file" id="File<?php echo $count_row ?>"
                                                    class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                    multiple="" data-krajee-fileinput="fileinput_4efc2035">
                                            <?php } else { ?>
                                                <div class="labeloform"><a target="_blank" href="<?php echo $table["Link"] ?>">Ссылка на
                                                        загруженный
                                                        файл</a></div>
                                                <div class="col-md-11" style="margin-top:20px;"><label class="control-label"
                                                        for="File<?php echo $count_row ?>">Заменить
                                                        загруженный
                                                        файл</label><input type="file" id="File<?php echo $count_row ?>"
                                                        class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                        multiple="" data-krajee-fileinput="fileinput_4efc2035">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $count_row++;
                            }
                        }
                        ?>
                            <button type="button" id="add_row" class="btn btn-success" value=14>+Добавить</button>

                            <h4>Копия локального нормативного акта, регламентирующего формы, периодичность и порядок
                                текущего контроля
                                успеваемости и промежуточной аттестации обучающихся</h4>
                            <?php foreach ($tabledata as $table) {
                                if ($table["NameFile"] == 15) { ?>
                                    <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=15>
                                        <div class="col-sm-1">
                                            <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                        </div>
                                        <div class="col-sm-11">
                                            <textarea class="form-control" name="document[<?php echo $count_row ?>][]"
                                                placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                            <?php if ($table["Link"] == '') { ?>
                                                <div class="col-md-11"><label class="control-label"
                                                        for="File<?php echo $count_row ?>">Документ для
                                                        загрузки</label><input type="file" id="File<?php echo $count_row ?>"
                                                        class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                        multiple="" data-krajee-fileinput="fileinput_4efc2035">
                                                <?php } else { ?>
                                                    <div class="labeloform"><a target="_blank"
                                                            href="<?php echo $table["Link"] ?>">Ссылка на загруженный
                                                            файл</a></div>
                                                    <div class="col-md-11" style="margin-top:20px;"><label class="control-label"
                                                            for="File<?php echo $count_row ?>">Заменить
                                                            загруженный
                                                            файл</label><input type="file" id="File<?php echo $count_row ?>"
                                                            class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                            multiple="" data-krajee-fileinput="fileinput_4efc2035">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $count_row++;
                                }
                            }
                            ?>
                                <button type="button" id="add_row" class="btn btn-success" value=15>+Добавить</button>

                                <h4>Копия локального нормативного акта, регламентирующего порядок и основания перевода,
                                    отчисления и
                                    восстановления обучающихся</h4>
                                <?php foreach ($tabledata as $table) {
                                    if ($table["NameFile"] == 16) { ?>
                                        <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                                            <input type="hidden" name="document[<?php echo $count_row ?>][]" value=16>
                                            <div class="col-sm-1">
                                                <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                            </div>
                                            <div class="col-sm-11">
                                                <textarea class="form-control" name="document[<?php echo $count_row ?>][]"
                                                    placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                                <?php if ($table["Link"] == '') { ?>
                                                    <div class="col-md-11"><label class="control-label"
                                                            for="File<?php echo $count_row ?>">Документ для
                                                            загрузки</label><input type="file" id="File<?php echo $count_row ?>"
                                                            class="form-control file-loading" name="document[<?php echo $count_row ?>]"
                                                            multiple="" data-krajee-fileinput="fileinput_4efc2035">
                                                    <?php } else { ?>
                                                        <div class="labeloform"><a target="_blank"
                                                                href="<?php echo $table["Link"] ?>">Ссылка на загруженный
                                                                файл</a></div>
                                                        <div class="col-md-11" style="margin-top:20px;"><label class="control-label"
                                                                for="File<?php echo $count_row ?>">Заменить
                                                                загруженный
                                                                файл</label><input type="file" id="File<?php echo $count_row ?>"
                                                                class="form-control file-loading"
                                                                name="document[<?php echo $count_row ?>]" multiple=""
                                                                data-krajee-fileinput="fileinput_4efc2035">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $count_row++;
                                    }
                                }
                                ?>
                                    <button type="button" id="add_row" class="btn btn-success" value=16>+Добавить</button>

                                    <h4>Копия локального нормативного акта, регламентирующего порядок оформления
                                        возникновения, приостановления и
                                        прекращения отношений между образовательной организацией и обучающимися и (или)
                                        родителями (законными
                                        представителями) несовершеннолетних обучающихся</h4>
                                    <?php foreach ($tabledata as $table) {
                                        if ($table["NameFile"] == 17) { ?>
                                            <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                                <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                                                <input type="hidden" name="document[<?php echo $count_row ?>][]" value=17>
                                                <div class="col-sm-1">
                                                    <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                                </div>
                                                <div class="col-sm-11">
                                                    <textarea class="form-control" name="document[<?php echo $count_row ?>][]"
                                                        placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                                    <?php if ($table["Link"] == '') { ?>
                                                        <div class="col-md-11"><label class="control-label"
                                                                for="File<?php echo $count_row ?>">Документ для
                                                                загрузки</label><input type="file" id="File<?php echo $count_row ?>"
                                                                class="form-control file-loading"
                                                                name="document[<?php echo $count_row ?>]" multiple=""
                                                                data-krajee-fileinput="fileinput_4efc2035">
                                                        <?php } else { ?>
                                                            <div class="labeloform"><a target="_blank"
                                                                    href="<?php echo $table["Link"] ?>">Ссылка на загруженный
                                                                    файл</a></div>
                                                            <div class="col-md-11" style="margin-top:20px;"><label class="control-label"
                                                                    for="File<?php echo $count_row ?>">Заменить
                                                                    загруженный
                                                                    файл</label><input type="file" id="File<?php echo $count_row ?>"
                                                                    class="form-control file-loading"
                                                                    name="document[<?php echo $count_row ?>]" multiple=""
                                                                    data-krajee-fileinput="fileinput_4efc2035">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $count_row++;
                                        }
                                    }
                                    ?>
                                        <button type="button" id="add_row" class="btn btn-success"
                                            value=17>+Добавить</button>

                                        <h4>Копия правил внутреннего распорядка обучающихся</h4>
                                        <?php foreach ($tabledata as $table) {
                                            if ($table["NameFile"] == 18) { ?>
                                                <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                                    <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                                                    <input type="hidden" name="document[<?php echo $count_row ?>][]" value=18>
                                                    <div class="col-sm-1">
                                                        <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <textarea class="form-control" name="document[<?php echo $count_row ?>][]"
                                                            placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                                        <?php if ($table["Link"] == '') { ?>
                                                            <div class="col-md-11"><label class="control-label"
                                                                    for="File<?php echo $count_row ?>">Документ для
                                                                    загрузки</label><input type="file" id="File<?php echo $count_row ?>"
                                                                    class="form-control file-loading"
                                                                    name="document[<?php echo $count_row ?>]" multiple=""
                                                                    data-krajee-fileinput="fileinput_4efc2035">
                                                            <?php } else { ?>
                                                                <div class="labeloform"><a target="_blank"
                                                                        href="<?php echo $table["Link"] ?>">Ссылка на загруженный
                                                                        файл</a></div>
                                                                <div class="col-md-11" style="margin-top:20px;"><label
                                                                        class="control-label"
                                                                        for="File<?php echo $count_row ?>">Заменить
                                                                        загруженный
                                                                        файл</label><input type="file" id="File<?php echo $count_row ?>"
                                                                        class="form-control file-loading"
                                                                        name="document[<?php echo $count_row ?>]" multiple=""
                                                                        data-krajee-fileinput="fileinput_4efc2035">
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $count_row++;
                                            }
                                        }
                                        ?>
                                            <button type="button" id="add_row" class="btn btn-success"
                                                value=18>+Добавить</button>

                                            <h4>Копия правил внутреннего трудового распорядка</h4>
                                            <?php foreach ($tabledata as $table) {
                                                if ($table["NameFile"] == 19) { ?>
                                                    <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                                                        <input type="hidden" name="document[<?php echo $count_row ?>][]" value=19>
                                                        <div class="col-sm-1">
                                                            <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                                        </div>
                                                        <div class="col-sm-11">
                                                            <textarea class="form-control"
                                                                name="document[<?php echo $count_row ?>][]"
                                                                placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                                            <?php if ($table["Link"] == '') { ?>
                                                                <div class="col-md-11"><label class="control-label"
                                                                        for="File<?php echo $count_row ?>">Документ для
                                                                        загрузки</label><input type="file"
                                                                        id="File<?php echo $count_row ?>"
                                                                        class="form-control file-loading"
                                                                        name="document[<?php echo $count_row ?>]" multiple=""
                                                                        data-krajee-fileinput="fileinput_4efc2035">
                                                                <?php } else { ?>
                                                                    <div class="labeloform"><a target="_blank"
                                                                            href="<?php echo $table["Link"] ?>">Ссылка на загруженный
                                                                            файл</a></div>
                                                                    <div class="col-md-11" style="margin-top:20px;"><label
                                                                            class="control-label"
                                                                            for="File<?php echo $count_row ?>">Заменить
                                                                            загруженный
                                                                            файл</label><input type="file"
                                                                            id="File<?php echo $count_row ?>"
                                                                            class="form-control file-loading"
                                                                            name="document[<?php echo $count_row ?>]" multiple=""
                                                                            data-krajee-fileinput="fileinput_4efc2035">
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $count_row++;
                                                }
                                            }
                                            ?>
                                                <button type="button" id="add_row" class="btn btn-success"
                                                    value=19>+Добавить</button>

                                                <h4>Копия коллективного договора</h4>
                                                <?php foreach ($tabledata as $table) {
                                                    if ($table["NameFile"] == 20) { ?>
                                                        <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                value=<?php echo $table['Position'] ?>>
                                                            <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                value=20>
                                                            <div class="col-sm-1">
                                                                <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                                            </div>
                                                            <div class="col-sm-11">
                                                                <textarea class="form-control"
                                                                    name="document[<?php echo $count_row ?>][]"
                                                                    placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                                                <?php if ($table["Link"] == '') { ?>
                                                                    <div class="col-md-11"><label class="control-label"
                                                                            for="File<?php echo $count_row ?>">Документ для
                                                                            загрузки</label><input type="file"
                                                                            id="File<?php echo $count_row ?>"
                                                                            class="form-control file-loading"
                                                                            name="document[<?php echo $count_row ?>]" multiple=""
                                                                            data-krajee-fileinput="fileinput_4efc2035">
                                                                    <?php } else { ?>
                                                                        <div class="labeloform"><a target="_blank"
                                                                                href="<?php echo $table["Link"] ?>">Ссылка на
                                                                                загруженный
                                                                                файл</a></div>
                                                                        <div class="col-md-11" style="margin-top:20px;"><label
                                                                                class="control-label"
                                                                                for="File<?php echo $count_row ?>">Заменить
                                                                                загруженный
                                                                                файл</label><input type="file"
                                                                                id="File<?php echo $count_row ?>"
                                                                                class="form-control file-loading"
                                                                                name="document[<?php echo $count_row ?>]" multiple=""
                                                                                data-krajee-fileinput="fileinput_4efc2035">
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php $count_row++;
                                                    }
                                                }
                                                ?>
                                                    <button type="button" id="add_row" class="btn btn-success"
                                                        value=20>+Добавить</button>

                                                    <h4>Отчет о результатах самообследования</h4>
                                                    <?php foreach ($tabledata as $table) {
                                                        if ($table["NameFile"] == 21) { ?>
                                                            <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                                                <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                    value=<?php echo $table['Position'] ?>>
                                                                <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                    value=21>
                                                                <div class="col-sm-1">
                                                                    <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                                                </div>
                                                                <div class="col-sm-11">
                                                                    <textarea class="form-control"
                                                                        name="document[<?php echo $count_row ?>][]"
                                                                        placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                                                    <?php if ($table["Link"] == '') { ?>
                                                                        <div class="col-md-11"><label class="control-label"
                                                                                for="File<?php echo $count_row ?>">Документ для
                                                                                загрузки</label><input type="file"
                                                                                id="File<?php echo $count_row ?>"
                                                                                class="form-control file-loading"
                                                                                name="document[<?php echo $count_row ?>]" multiple=""
                                                                                data-krajee-fileinput="fileinput_4efc2035">
                                                                        <?php } else { ?>
                                                                            <div class="labeloform"><a target="_blank"
                                                                                    href="<?php echo $table["Link"] ?>">Ссылка на
                                                                                    загруженный
                                                                                    файл</a></div>
                                                                            <div class="col-md-11" style="margin-top:20px;"><label
                                                                                    class="control-label"
                                                                                    for="File<?php echo $count_row ?>">Заменить
                                                                                    загруженный
                                                                                    файл</label><input type="file"
                                                                                    id="File<?php echo $count_row ?>"
                                                                                    class="form-control file-loading"
                                                                                    name="document[<?php echo $count_row ?>]"
                                                                                    multiple=""
                                                                                    data-krajee-fileinput="fileinput_4efc2035">
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php $count_row++;
                                                        }
                                                    }
                                                    ?>
                                                        <button type="button" id="add_row" class="btn btn-success"
                                                            value=21>+Добавить</button>

                                                        <h4>Предписания органов, осуществляющих государственный контроль
                                                            (надзор) в сфере образования</h4>
                                                        <?php foreach ($tabledata as $table) {
                                                            if ($table["NameFile"] == 22) { ?>
                                                                <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                                                    <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                        value=<?php echo $table['Position'] ?>>
                                                                    <input type="hidden" name="document[<?php echo $count_row ?>][]"
                                                                        value=22>
                                                                    <div class="col-sm-1">
                                                                        <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                                                    </div>
                                                                    <div class="col-sm-11">
                                                                        <textarea class="form-control"
                                                                            name="document[<?php echo $count_row ?>][]"
                                                                            placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                                                        <?php if ($table["Link"] == '') { ?>
                                                                            <div class="col-md-11"><label class="control-label"
                                                                                    for="File<?php echo $count_row ?>">Документ для
                                                                                    загрузки</label><input type="file"
                                                                                    id="File<?php echo $count_row ?>"
                                                                                    class="form-control file-loading"
                                                                                    name="document[<?php echo $count_row ?>]"
                                                                                    multiple=""
                                                                                    data-krajee-fileinput="fileinput_4efc2035">
                                                                            <?php } else { ?>
                                                                                <div class="labeloform"><a target="_blank"
                                                                                        href="<?php echo $table["Link"] ?>">Ссылка на
                                                                                        загруженный
                                                                                        файл</a></div>
                                                                                <div class="col-md-11" style="margin-top:20px;"><label
                                                                                        class="control-label"
                                                                                        for="File<?php echo $count_row ?>">Заменить
                                                                                        загруженный
                                                                                        файл</label><input type="file"
                                                                                        id="File<?php echo $count_row ?>"
                                                                                        class="form-control file-loading"
                                                                                        name="document[<?php echo $count_row ?>]"
                                                                                        multiple=""
                                                                                        data-krajee-fileinput="fileinput_4efc2035">
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php $count_row++;
                                                            }
                                                        }
                                                        ?>
                                                            <button type="button" id="add_row" class="btn btn-success"
                                                                value=22>+Добавить</button>

                                                            <h4>Отчёты об исполнении предписаний органов, осуществляющих
                                                                государственный контроль (надзор) в сфере
                                                                образования</h4>
                                                            <?php foreach ($tabledata as $table) {
                                                                if ($table["NameFile"] == 23) { ?>
                                                                    <div class="row temporarystyle" value=<?php echo $count_row ?>>
                                                                        <input type="hidden"
                                                                            name="document[<?php echo $count_row ?>][]" value=<?php echo $table['Position'] ?>>
                                                                        <input type="hidden"
                                                                            name="document[<?php echo $count_row ?>][]" value=23>
                                                                        <div class="col-sm-1">
                                                                            <?php echo Html::a('X', ['/delete_document', 'post' => $table['Position']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                                                                        </div>
                                                                        <div class="col-sm-11">
                                                                            <textarea class="form-control"
                                                                                name="document[<?php echo $count_row ?>][]"
                                                                                placeholder="Устав; Локальный нормативный акт, регламентирующий режим занятий обучающихся и т.д."><?php echo $table["Titel"] ?></textarea>
                                                                            <?php if ($table["Link"] == '') { ?>
                                                                                <div class="col-md-11"><label class="control-label"
                                                                                        for="File<?php echo $count_row ?>">Документ для
                                                                                        загрузки</label><input type="file"
                                                                                        id="File<?php echo $count_row ?>"
                                                                                        class="form-control file-loading"
                                                                                        name="document[<?php echo $count_row ?>]"
                                                                                        multiple=""
                                                                                        data-krajee-fileinput="fileinput_4efc2035">
                                                                                <?php } else { ?>
                                                                                    <div class="labeloform"><a target="_blank"
                                                                                            href="<?php echo $table["Link"] ?>">Ссылка
                                                                                            на загруженный
                                                                                            файл</a></div>
                                                                                    <div class="col-md-11" style="margin-top:20px;">
                                                                                        <label class="control-label"
                                                                                            for="File<?php echo $count_row ?>">Заменить
                                                                                            загруженный
                                                                                            файл</label><input type="file"
                                                                                            id="File<?php echo $count_row ?>"
                                                                                            class="form-control file-loading"
                                                                                            name="document[<?php echo $count_row ?>]"
                                                                                            multiple=""
                                                                                            data-krajee-fileinput="fileinput_4efc2035">
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php $count_row++;
                                                                }
                                                            }
        } ?>
                                                            <button type="button" id="add_row" class="btn btn-success"
                                                                value=23>+Добавить</button>

                                                            <div class="form-group" style="margin-top:10px;">
                                                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                                                            </div>
                                                            <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
</body>
<!--Конец сведений-->