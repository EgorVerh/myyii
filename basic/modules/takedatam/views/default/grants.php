<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/paid_edu.js');
// $this->registerCssFile('@modulestakedatamcss/styles.css');
?>

<head>
    <title>Гранты</title>
</head>

<body>
    <form method="post">
        <h1 style="padding:5px 0 5px 0; color: black !important; font-weight: 900;">Стипендии и меры поддержки
            обучающихся</h1>
        <!--Сгенерированные сведения-->
        <h4 style="padding:5px 0 5px 0; color: black !important; font-weight: 700;">Приказ образовательной организации
            об установлении стипендий</h4>
        <?php $count_row = 0;
        if (isset($data)) {
            foreach ($data as $number => $name) {
                if ($name['variable'] == 5) { ?>
                    <div class="row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['iddataforms'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=5>
                        <div class="col-sm-1">
                            <?php echo Html::a('X', ['/delete_grants', 'post' => $name['iddataforms']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                        </div>
                        <div class="col-sm-11">
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Название для ссылки"
                                style="width:100%;height:45px;"><?php echo $name['namefildsforms'] ?></textarea>
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Вставьте ссылку"
                                style="width:100%;height:45px;"><?php echo $name['datafilds'] ?></textarea>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <button type="button" id="add_row" class="btn btn-success" value=5>+Добавить</button>
            <h4 style="padding:5px 0 5px 0; color: black !important; font-weight: 700;">Приказ образовательной организации о
                создании стипендиальной комиссии</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['variable'] == 6) { ?>
                    <div class="row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['iddataforms'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=6>
                        <div class="col-sm-1">
                            <?php echo Html::a('X', ['/delete_grants', 'post' => $name['iddataforms']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                        </div>
                        <div class="col-sm-11">
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Название для ссылки"
                                style="width:100%;height:45px;"><?php echo $name['namefildsforms'] ?></textarea>
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Вставьте ссылку"
                                style="width:100%;height:45px;"><?php echo $name['datafilds'] ?></textarea>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <button type="button" id="add_row" class="btn btn-success" value=6>+Добавить</button>
            <h4 style="padding:5px 0 5px 0; color: black !important; font-weight: 700;">Положение о стипендиальной комиссии
                образовательной организации</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['variable'] == 7) { ?>
                    <div class="row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['iddataforms'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=7>
                        <div class="col-sm-1">
                            <?php echo Html::a('X', ['/delete_grants', 'post' => $name['iddataforms']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                        </div>
                        <div class="col-sm-11">
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Название для ссылки"
                                style="width:100%;height:45px;"><?php echo $name['namefildsforms'] ?></textarea>
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Вставьте ссылку"
                                style="width:100%;height:45px;"><?php echo $name['datafilds'] ?></textarea>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <button type="button" id="add_row" class="btn btn-success" value=7>+Добавить</button>
            <h4 style="padding:5px 0 5px 0; color: black !important; font-weight: 700;">Положение о стипендиальном
                обеспечении и других формах материальной поддержки студентов, аспирантов и докторантов образовательной
                организации</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['variable'] == 8) { ?>
                    <div class="row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['iddataforms'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=8>
                        <div class="col-sm-1">
                            <?php echo Html::a('X', ['/delete_grants', 'post' => $name['iddataforms']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                        </div>
                        <div class="col-sm-11">
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Название для ссылки"
                                style="width:100%;height:45px;"><?php echo $name['namefildsforms'] ?></textarea>
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Вставьте ссылку"
                                style="width:100%;height:45px;"><?php echo $name['datafilds'] ?></textarea>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <button type="button" id="add_row" class="btn btn-success" value=8>+Добавить</button>
            <h4 style="padding:5px 0 5px 0; color: black !important; font-weight: 700;">Положение о формах материальной
                поддержки студентов, аспирантов и докторантов образовательной организации</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['variable'] == 9) { ?>
                    <div class="row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['iddataforms'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=9>
                        <div class="col-sm-1">
                            <?php echo Html::a('X', ['/delete_grants', 'post' => $name['iddataforms']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                        </div>
                        <div class="col-sm-11">
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Название для ссылки"
                                style="width:100%;height:45px;"><?php echo $name['namefildsforms'] ?></textarea>
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Вставьте ссылку"
                                style="width:100%;height:45px;"><?php echo $name['datafilds'] ?></textarea>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <button type="button" id="add_row" class="btn btn-success" value=9>+Добавить</button>
            <h4 style="padding:5px 0 5px 0; color: black !important; font-weight: 700;">Ссылка на информацию о формировании
                платы за проживание в общежитии</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['variable'] == 10) { ?>
                    <div class="row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['iddataforms'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=10>
                        <div class="col-sm-1">
                            <?php echo Html::a('X', ['/delete_grants', 'post' => $name['iddataforms']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                        </div>
                        <div class="col-sm-11">
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Название для ссылки"
                                style="width:100%;height:45px;"><?php echo $name['namefildsforms'] ?></textarea>
                            <textarea name="paid_educational[<?php echo $count_row ?>][]" placeholder="Вставьте ссылку"
                                style="width:100%;height:45px;"><?php echo $name['datafilds'] ?></textarea>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            }
        } ?>
        <button type="button" id="add_row" class="btn btn-success" value=10>+Добавить</button>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
</body>
<!--Конец сведений-->