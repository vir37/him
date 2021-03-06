<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use frontend\assets\FancyboxAsset;

FancyboxAsset::register($this);


$city = Yii::$app->params['city'];
$this->title = "Химическая продукция в {$city->name_pp} - ООО \"ТЕРА-ИНВЕСТ\"";
$this->registerMetaTag([ 'name' => 'description', 'content' => 'Компания "ТЕРА-ИНВЕСТ" реализует оптом в '.$city->name_pp.' и по всей России широкий спектр продукции химических производств']);
$this->registerMetaTag([ 'name' => 'keywords', 'content' => implode(', ', $keywords)]);
//TODO: нужно сделать сохранение ИД каталога в сессии
?>
<div class="site-index">
    <div class="row">
    <?= Carousel::widget([
        'id' => 'main-slider',
        'controls' => false,
        'options' => [ 'class' => 'main-slider col-lg-12 col-md-12 col-sm-12 hidden-xs' ],
        'items' => [
            [
                'content' => '<img src="/icons/slide2.jpg"/>',
                /*
                'caption' => '<div class="caption">
                                <p>Всё в наличии,</p><p>либо под заказ</p>
                                <div></div>
                                <span>Описание наших преимуществ. Того, что мы можем для вас сделать. Чем можем помочь и т.д.</span>
                              </div>',*/
            ],
            [
                'content' => '<img src="/icons/slide5.jpg"/>',
                //'content' => '<div style="width:inherit; height: inherit; background-color: #00275F"></div>'
            ],
            [
                'content' => '<img src="/icons/slide3.jpg"/>',
                //'content' => '<div style="width:inherit; height: inherit; background-color: #CD1041"></div>'
            ],
            [
                'content' => '<img src="/icons/slide4.jpg"/>',
                //'content' => '<div style="width:inherit; height: inherit; background-color: #00275F"></div>'
            ],
        ],
    ]) ?>
    </div>
    <div class="body-content">
        <header class="row">
            <?= Html::tag('h1', "Химическая продукция в {$city->name_pp}", [ 'class' => 'main-h1 col-lg-12 col-md-12 col-sm-12 col-xs-12'])?>
        </header>
        <div class="row direct-links">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" >
            <?= Html::a('<img src="/icons/book_white.png" ><p>ПЕРЕЙТИ В КАТАЛОГ <span> >> </span></p>',
                [ '/category/view', 'city'=>$city->uri_name, 'id' => $firstCategory->id /* дефолтная категория */ ], [ 'id' => "catalogue"]) ?>
            </div>
            <?php
                $branches = \common\models\Catalogue::findOne(2);
                foreach ($branches->getPopulateProducts(2) as $elem) {
                    $data = $this->render("product_elem", [
                        'product' => $elem['product'],
                        'category' => $elem['category'],
                        'elem_class' => "product col-lg-2 col-md-2 col-sm-2 col-xs-2",
                    ]);
                    echo $data;
                }
            ?>
        </div>
        <div class="row main-links">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <?= Html::a('<p>О НАС</p>', [ 'site/about', 'city' => $city->uri_name ]) ?>
            </div>
            <?php  /*Html::a('<p>АКЦИИ</p>', [ 'stocks/index', 'city' => $city->uri_name], [ 'rel' => 'nofollow' ]) */?>
            <?php  /*Html::a('<p>МЕНЕДЖЕРЫ</p>', [ 'site/managers', 'city' => $city->uri_name], [ 'rel' => 'nofollow' ]) */?>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <?= Html::a('<p>КОНТАКТЫ</p>', [ 'site/contacts', 'city' => $city->uri_name]) ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                <noindex>
                   <?= Html::a('<p>КУПИТЬ</p>', [ 'site/contact', 'city' => $city->uri_name], [ 
                         'class' => 'fancybox',
                         'onclick' => "yaCounter44777377.reachGoal('Buy'); return true;",
                         'rel' => 'nofollow',
                   ]) ?>
                </noindex>
            </div>
        </div>
    </div>
</div>
