<?php

namespace frontend\themes\v2\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class NewAppAsset extends AssetBundle
{
    //public $basePath = '/themes/v2';
    public $baseUrl = '@web/themes/v2';
    //public $sourcePath = '@webroot/themes/v2';

    public $css = [
        'css/style.css',
        'css/sprite.css',
        'css/responsive.css',
        'css/grid.css',
        'css/fonts.css'
    ];
    public $js = [
        'https://api-maps.yandex.ru/2.1/?lang=ru_RU',
        'js/libs.js',
        'js/common.js',
        //'js/google_analytics.js',
        'js/yandex_metrika.js'
    ];

    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
