<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/paid_edu.js');
$this->registerCssFile('@modulestakedatamcss/styles.css')
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0032)https://vspu.ru/sveden/paid_edu/ -->
<html>

<head>
    <title>Платные образовательные услуги</title>
</head>

<body>
    <form method="post">
        <h1 style="padding-bottom:20px;">Платные образовательные услуги</h1>
        <!--Сгенерированные сведения-->
        <h4 style="padding-bottom:20px;padding-top:20px;">Образец договора об оказании платных образовательных услуг
        </h4>
        <?php $count_row = 0;
        if (isset($data)) {
            foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 1) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=1>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья"
                                value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_paid_edu'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=1>+
                    Добавить</button></div>
            <h4 style="padding-bottom:20px;padding-top:20px;">Документ об утверждении стоимости обучения по каждой
                образовательной программе</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 2) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=2>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья"
                                value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                           <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_paid_edu'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=2>+
                    Добавить</button></div>
            <h4 style="padding-bottom:20px;padding-top:20px;">Документ о порядке оказания платных образовательных услуг</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 3) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=3>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья"
                                value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                           <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_paid_edu'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=3>+
                    Добавить</button></div>
            <h4 style="padding-bottom:20px;padding-top:20px;">Документ об установлении размера платы, взимаемой с родителей
                (законных представителей) за присмотр
                и уход за детьми, осваивающими образовательные программы дошкольного образования в организациях,
                осуществляющих образовательную деятельность, за содержание детей в образовательной организации,
                реализующей образовательные программы начального общего, основного общего или среднего общего
                образования, если в такой образовательной организации созданы условия для проживания обучающихся в
                интернате, либо за осуществление присмотра и ухода за детьми в группах продленного дня в
                образовательной организации, реализующей образовательные программы начального общего, основного
                общего или среднего общего образования</h4>
            <?php foreach ($data as $number => $name) {
                if ($name['fieldsforms_id'] == 4) { ?>
                    <div class="row oform_row" value="<?php echo $number ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]"
                            value="<?php echo $name['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=4>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья"
                                value="<?php echo $name['namefieldsforms'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $name['datafields'] ?>">
                        </div>
                        <div>
                           <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1" value='/delete_paid_edu'>X</button>
                        </div>
                    </div>
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=4>+
                    Добавить</button></div>
            <div class="form-group">
            <?php } ?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
    <!--Конец сведений-->