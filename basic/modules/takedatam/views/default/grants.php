<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/paid_edu.js');
$this->registerCssFile('@modulestakedatamcss/styles.css');
// $this->registerCssFile('@modulestakedatamcss/styles.css');
?>

<head>
    <title>Гранты</title>
</head>

<body>
    <form method="post">
        <h1>Стипендии и меры поддержки
            обучающихся</h1>
        <!--Сгенерированные сведения-->
        <h4>Приказ образовательной организации
            об установлении стипендий</h4>
        <?php $count_row = 0;
        if (isset($data)) {
            foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 5) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=5>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья" value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                        <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_grants'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=5>+ Добавить</button></div>
            <h4>Приказ образовательной организации о
                создании стипендиальной комиссии</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 6) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=6>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья" value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_grants'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=6>+ Добавить</button></div>
            <h4>Положение о стипендиальной комиссии
                образовательной организации</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 7) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=7>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья" value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_grants'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=7>+ Добавить</button></div>
            <h4>Положение о стипендиальном
                обеспечении и других формах материальной поддержки студентов, аспирантов и докторантов образовательной
                организации</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 8) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=8>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья" value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_grants'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=8>+ Добавить</button></div>
            <h4>Положение о формах материальной
                поддержки студентов, аспирантов и докторантов образовательной организации</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 9) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=9>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья" value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_grants'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=9>+ Добавить</button></div>
            <h4>Ссылка на информацию о формировании
                платы за проживание в общежитии</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 10) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=10>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья" value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_grants'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            }
        } ?>
        <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=10>+ Добавить</button></div>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
</body>
<!--Конец сведений-->