<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html, yii\helpers\Url;

$city = Yii::$app->params['city'];
$this->title = 'ООО "ТЕРА-ИНВЕСТ"'.' - '.$city->name;
?>
<div class="site-index">
    <div class="row">
    <?= Carousel::widget([
        'id' => 'main-slider',
        'controls' => false,
        'options' => [ 'class' => 'main-slider' ],
        'items' => [
            [
                'content' => '<img src="/icons/slide1.jpg" style="height:inherit; width: inherit;"/>',
                'caption' => '<div class="caption">
                                <p>Всё в наличии,</p><p>либо под заказ</p>
                                <div></div>
                                <span>Описание наших преимуществ. Того, что мы можем для вас сделать. Чем можем помочь и т.д.</span>
                              </div>',
            ],
            [
                'content' => '<div style="width:inherit; height: inherit; background-color: #00275F"></div>'
            ],
            [
                'content' => '<div style="width:inherit; height: inherit; background-color: #CD1041"></div>'
            ],
        ],
    ]) ?>
    </div>
    <div class="body-content">
        <div class="row">
            <?= Html::tag('h1', "Каталог химической продукции в г.{$city->name}", [ 'class' => 'main-h1'])?>
        </div>
        <div class="row">
            <?= Html::a('<img src="/icons/book_white.png"><p>ПЕРЕЙТИ В КАТАЛОГ <span> >> </span></p>',
                [ 'catalogue/index', 'city'=>$city->uri_name ], [ 'class'=>"col-lg-3 col-md-3", 'id'=>"catalogue" ]) ?>
            <?php
                $branches = \common\models\Catalogue::findOne(2);
                foreach ($branches->getPopulateProducts(2) as $elem){

                }
            ?>
        </div>
        <div class="row main-links">
            <?= Html::a('<p>О НАС</p>', [ 'site/about', 'city' => $city->uri_name ]) ?>
            <?= Html::a('<p>АКЦИИ</p>', [ 'stocks/index', 'city' => $city->uri_name ]) ?>
            <?= Html::a('<p>МЕНЕДЖЕРЫ</p>', [ 'site/managers', 'city' => $city->uri_name ]) ?>
            <?= Html::a('<p>КОНТАКТЫ</p>', [ 'site/contacts', 'city' => $city->uri_name ]) ?>
        </div>
    </div>
</div>
