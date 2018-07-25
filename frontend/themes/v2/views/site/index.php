<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html;
//use frontend\assets\FancyboxAsset;

//FancyboxAsset::register($this);


$city = Yii::$app->params['city'];
$company = Yii::$app->params['company'];
$this->title = "Химическая продукция в {$city->name_pp} - {$company}";
$this->registerMetaTag([ 'name' => 'description', 'content' => 'Компания "'.$company.'" реализует оптом в '.$city->name_pp.' и по всей России широкий спектр продукции химических производств']);
$this->registerMetaTag([ 'name' => 'keywords', 'content' => implode(', ', $keywords)]);
//TODO: нужно сделать сохранение ИД каталога в сессии
?>
<div class="main-slide">
    <div class="main-slide__case case">
        <div class="main-slide__wrap">
            <div class="main-slide__title">Оптовый поставщик химсырья</div>
            <div class="main-slide__desc subtitle">Надежный выбор в сфере химического производства</div>
            <div class="main-slide__data data">
                <div class="data__head">
                    <?= Html::a('Перейти в каталог >',
                        [ '/category/view', 'city'=>$city->uri_name, 'id' => $firstCategory->id /* дефолтная категория */ ], [ 'id' => "catalogue"]) ?>
                </div>
                <div class="data__body">
                    <p>Минимальный заказ:</p>
                    <div class="row i-top">
                        <ul>
                            <li>- Мешок, 25 кг.</li>
                            <li>- Барабан, 50 кг.</li>
                            <li>- Бочка, от 165 кг.</li>
                        </ul>
                        <ul>
                            <li>- Палета (ровинг), 1100 кг.</li>
                            <li>- Еврокуб, 1600 кг.</li>
                        </ul>
                    </div>
                    <p class="desc">Отгрузка меньшего объема невозможна</p>
                </div>
            </div>
        </div>
        <div class="main-slide__content">
            <div class="main-slide__content-title title line">
                <?= Html::tag('h1', "Химическая продукция в {$city->name_pp}")?>
            </div>
            <div class="main-slide__content-text text">
                <p>Миссией компании «<?= Yii::$app->params['company'] ?>» является осуществление оперативных поставок качественного сырья, в том числе комбинаций сырья, по наилучшим ценам для потребностей различных производств в России, странах ближнего и дальнего зарубежья с решением задач по транспортировке сырья до клиентов.</p>
                <p>Компания «<?= Yii::$app->params['company'] ?>» за время поставок зарекомендовала себя как надежный поставщик, о чем свидетельствует удовлетворенность наших клиентов, среди которых ведущее место занимают различные производства, которые мы регулярно и точно в срок снабжаем сырьем проверенного качества.</p>
            </div>
        </div>
    </div>
</div>
