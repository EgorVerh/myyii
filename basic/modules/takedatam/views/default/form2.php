<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
use frontend\modules\takedatam\assets\AppAsset;
AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/form2.js');
$this->registerCssFile('@modulestakedatamcss/styles.css');

?>
<h4><b>Сведения о каждом учредителе образовательной организации</h4>
<div class="row" id="no">
    <div class="col-sm-3 style_col_sm_3 hightrow"><b>Наименование учредителя образовательной организации</b></div>
    <div class="col-sm-2 style_col_sm_2 hightrow"><b>Юридический адрес учредителя</b></div>
    <div class="col-sm-2 style_col_sm_2 hightrow"><b>Контактный телефон учредителя</b></div>
    <div class="col-sm-3 style_col_sm_3 hightrow"><b>Адрес электронной почты учредителя</b></div>
    <div class="col-sm-2 style_col_sm_2 hightrow"><b>Адрес сайта учредителя в сети &laquo;Интернет&raquo;</b></div>
</div>
<form method="post">
    <!-- Проверка на введенные данные, если есть то будут показаны -->
    <!-- Доделать кнопки -->
    <?php
    if (isset($dataform)) {
        foreach ($query1 as $number => $name) {
            $a = 0;
            ?>
            <div class="row scriprow" id="<?php echo $name['iddataforms']; ?>" value="<?php echo $number ?>">
                <div class="col-sm-1 style_col_sm_1">
                    <?php echo Html::a('X', ['/deleteform2', 'post' => $name['iddataforms'], 'what_to_delete' => 'row'], ['id' => 'remove_row', 'class' => 'btn btn-danger']) ?>
                </div>
                <input type="hidden" name="id[]" value="<?php echo $name['iddataforms'] ?>">
                <div class="col-sm-2 style_col_sm_2"><textarea class="form-control" name="Massrows[<?php echo $number ?>][0][]"
                        value="<?php echo $name['iddataforms'] ?>"><?php echo $name['datafilds'] ?></textarea></div>
                <div class="col-sm-2 style_col_sm_2"><textarea class="form-control" name="Massrows[<?php echo $number ?>][0][]"
                        value="<?php echo $name['iddataforms'] ?>"><?php echo $query2[$number]['datafilds'] ?></textarea></div>
                <div class="col-sm-2 style_col_sm_2"><textarea class="form-control" name="Massrows[<?php echo $number ?>][0][]"
                        value="<?php echo $name['iddataforms'] ?>"><?php echo $query3[$number]['datafilds'] ?></textarea></div>
                <div class="col-sm-3 style_col_sm_3 idsaytaddress" id="address">
                    <?php if (isset($tableemail)) {
                        foreach ($tableemail as $row1) {
                            if ($name['iddataforms'] == $row1['iddataforms']) {
                                ?>
                                <div class="row textsaytaddres" value="<?php echo $row1['iddataforms'] ?>">
                                    <div class="col-sm-10"><textarea class="form-control"
                                            name="Massrows[<?php echo $number ?>][1][]"><?php echo $row1['email'] ?></textarea></div>
                                    <?php echo Html::a('X', ['/deleteform2', 'post' => $row1['idform2email'], 'what_to_delete' => 'email'], ['id' => 'remove_address', 'class' => 'btn btn-danger col-sm-2 style_col_sm_2']) ?>
                                </div>
                            <?php }
                        }
                    } ?>
                    <button type="button" id="add_address" class="btn btn-success" name="<?php echo $number ?>">
                        + Добавить</button>
                </div>
                <div class="col-sm-2 style_col_sm_2 idsaytaddress" id="sayt">
                    <?php if (isset($tableaddres)) {
                        foreach ($tableaddres as $row2) {
                            if ($name['iddataforms'] == $row2['iddataforms']) { ?>
                                <div class="row textsaytaddres" value="<?php echo $row2['iddataforms'] ?>">
                                    <div class="col-sm-10"><textarea class="form-control"
                                            name="Massrows[<?php echo $number ?>][2][]"><?php echo $row2['addres'] ?></textarea></div>
                                    <?php echo Html::a('X', ['/deleteform2', 'post' => $row2['idform2addres'], 'what_to_delete' => 'address'], ['id' => 'remove_address', 'class' => 'btn btn-danger col-sm-2 style_col_sm_2']) ?>
                                </div>
                            <?php }
                        }
                    } ?>
                    <button type="button" id="add_sayt" class="btn btn-success" name="<?php echo $number ?>">+ Добавить</button>
                </div>
            </div>
        <?php }
    }
    ?>
    <div id="div_add_row"><button type="button" id="add_row" class="btn btn-success">+ Добавить</button></div>
    <div class="form-group form_group_margin">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php echo Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), [])?>
</form>