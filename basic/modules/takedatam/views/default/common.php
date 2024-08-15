<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;

AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerCssFile('@modulestakedatamcss/styles.css')
    ?>

<head>
    <title>Основные сведения</title>
</head>

<body>
    <h1 style="margin-bottom:20px;">Основные сведения</h1>
    <form method="post">
        <?php $count_row = 0; ?>
        <div class="row" value="1">
            <div class="col-sm-3">
                <label for="NameFounderEduOrganization">Наименование учредителя образовательной организации</label>
                <input type="text" class="form-control" id="NameFounderEduOrganization"
                    placeholder="Наименование учредителя образовательной организации">
            </div>
            <div class="col-sm-2">
                <label for="floatingInputValue">Юридический адрес учредителя</label>
                <input type="text" class="form-control" id="floatingInputValue"
                    placeholder="Юридический адрес учредителя">
            </div>
            <div class="col-sm-2">
                <label for="floatingInputValue">Контактные телефоны</label>
                <input type="text" class="form-control" id="floatingInputValue" placeholder="Контактные телефоны">
            </div>
            <div class="col-sm-2">
                <label for="floatingInputValue">Адрес электронной почты</label>
                <input type="email" class="form-control" id="floatingInputValue" placeholder="Адрес электронной почты">
            </div>
            <div class="col-sm-3">
                <label for="floatingInputValue">Адрес сайта учредителя в сети «Интернет»</label>
                <input type="url" class="form-control" id="floatingInputValue"
                    placeholder="Адрес сайта учредителя в сети «Интернет»">
            </div>
        </div>
        <div class="form-group" style="margin-top:10px;">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php echo Html::hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) ?>
    </form>
    <input type="hidden" id="count_row" value=<?php echo $count_row ?>>
</body>