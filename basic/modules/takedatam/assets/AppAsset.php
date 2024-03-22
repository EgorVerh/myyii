<?php
/*
 * Файл assets/AppAsset.php
 */
namespace frontend\modules\takedatam\assets;
use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $sourcePath="@modulestakedatamroot";
    public $basePath = '@webroot/assets';
    public $baseUrl = '@web/assets';
    public $css = [
        // 'css/site.css',
    ];  
    public $js = [
        // '/js/form2.js'
    ];
    public $jsOptions = [
        // скрипты будут подключены в <head>
        'position' => View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}