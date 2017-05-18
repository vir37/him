<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18.05.2017
 * Time: 22:28
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class FancyboxAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fancybox/jquery.fancybox.css',
        'css/fancybox/helpers/jquery.fancybox-thumbs.css',
        'css/fancybox/helpers/jquery.fancybox-buttons.css',
    ];
    public $js = [
        'js/jquery.fancybox.pack.js',
        'js/jquery.mousewheel.pack.js',
        'js/helpers/jquery.fancybox-buttons.js',
        'js/helpers/jquery.fancybox-media.js',
        'js/helpers/jquery.fancybox-thumbs.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
} 