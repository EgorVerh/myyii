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
        if (isset($tabledata)) {
            foreach ($tabledata as $table) {
                if ($table['fieldsforms_id'] == 1 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row" value="<?php echo $count_row ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value="<?php echo $table['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=1>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья"
                                value="<?php echo $table['titel'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $table['link'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1"
                                value='/delete_paid_edu'>X</button>
                            <button type="button" id="hide_button" value='/delete_paid_edu' class="hidebutton btn delbutton"
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
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=1>+
                    Добавить</button></div>
            <h4 style="padding-bottom:20px;padding-top:20px;">Документ об утверждении стоимости обучения по каждой
                образовательной программе</h4>
            <?php foreach ($tabledata as $table) {
                if ($table['fieldsforms_id'] == 2 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row" value="<?php echo $count_row ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value="<?php echo $table['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=2>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья"
                                value="<?php echo $table['titel'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $table['link'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1"
                                value='/delete_paid_edu'>X</button>
                            <button type="button" id="hide_button" value='/delete_paid_edu' class="hidebutton btn delbutton"
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
                    <?php $count_row++;
                }
            } ?>
            <div class="rightbuttonposition"><button type="button" id="add_row" class="btn btn-success" value=2>+
                    Добавить</button></div>
            <h4 style="padding-bottom:20px;padding-top:20px;">Документ о порядке оказания платных образовательных услуг</h4>
            <?php foreach ($tabledata as $table) {
                if ($table['fieldsforms_id'] == 3 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row" value="<?php echo $count_row ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value="<?php echo $table['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=3>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья"
                                value="<?php echo $table['titel'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $table['link'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1"
                                value='/delete_paid_edu'>X</button>
                            <button type="button" id="hide_button" value='/delete_paid_edu' class="hidebutton btn delbutton"
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
            <?php foreach ($tabledata as $table) {
                if ($table['fieldsforms_id'] == 4 && $table["enabled"] == 1) { ?>
                    <div class="row oform_row" value="<?php echo $count_row ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value="<?php echo $table['id'] ?>">
                        <input type="hidden" name="paid_educational[<?php echo $count_row ?>][]" value=4>
                        <div class="col-sm-11">
                            <label for="text<?php echo $count_row ?>">Название для ссылки</label>
                            <input type="text" name="paid_educational[<?php echo $count_row ?>][]" placeholder="Статья"
                                value="<?php echo $table['titel'] ?>" required><br>
                            <label for="url<?php echo $count_row ?>">Ссылка</label>
                            <input type="url" name="paid_educational[<?php echo $count_row ?>][]" placeholder="https://example.com"
                                pattern="https://.*" required value="<?php echo $table['link'] ?>">
                        </div>
                        <div>
                            <button type="button" id="delrow" class="btn btn-danger delbutton" tabindex="-1"
                                value='/delete_paid_edu'>X</button>
                            <button type="button" id="hide_button" value='/delete_paid_edu' class="hidebutton btn delbutton"
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