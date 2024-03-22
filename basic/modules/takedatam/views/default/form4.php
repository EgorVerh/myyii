<?php
/** @var yii\web\View $this */
use frontend\modules\takedatam\assets\AppAsset;
AppAsset::register($this);
$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
$this->registerJsFile('@modulestakedatamscript/form4.js');
$this->registerCssFile('@modulestakedatamcss/form4.css');
?>
<h2>Разделы сайта</h2>
<div class="row">
<div class="col-1">
<div>
<button type="button"   id="btn_up" class="btn btn-danger buttonoformtext">^</button>
<button type="button"  id="btn_down" class="btn btn-danger buttonoformtext">v</button>
</div>
</div>
<div class="col-10">Раздел 1</div>
<button type="button" id="add_expand" class="btn btn-success col-1 buttonoformtext">+</button>
</div>
