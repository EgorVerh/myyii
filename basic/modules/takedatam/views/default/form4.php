<?php
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/form4.js');
$this->registerCssFile('@modulestakedatamcss/form4.css');
?>
<h2>Разделы сайта</h2>
<form method="post">
    <?php if (isset($nameurl)) {
        foreach ($nameurl as $number => $name) { ?>
            <div class="row" value="<?php echo $number ?>">
                <input type="hidden" name="id[]" value="<?php echo $name['iddataforms'] ?>">
                <div class="col-sm-1">
                <?php echo Html::a('X', ['/deleteform4', 'post' => $name['iddataforms']], ['id' => 'delrow', 'class' => 'btn btn-danger']) ?>
                </div>
                <div class="col-sm-11">
                    <textarea name="Fieldsurl[<?php echo $number ?>][]" placeholder="Название для ссылки"
                        style="width:100%;height:45px;"><?php echo $name['datafilds'] ?></textarea>
                    <textarea name="Fieldsurl[<?php echo $number ?>][]" placeholder="Вставьте ссылку"
                        style="width:100%;height:45px;"><?php echo $url[$number]['datafilds'] ?></textarea>
                </div>
            </div>
        <?php }
    } ?>
    <button type="button" id="add_expand" class="btn btn-success">+ Добавить</button>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
</form>