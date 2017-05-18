<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
$chief = \common\models\Employee::find()->where(['is_chief' => true])->one();
if ($chief)
    $img = strlen($chief->photo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($chief->photo) : '/icons/no_photo.png';
else
    $img = '/icons/no_photo.png';
?>
<div class="site-contacts">
    <header>
        <h1><?= Html::encode($this->title) ?></h1>
    </header>
    <div class="row">
        <div class="col-lg-7 col-md-7">
            <h2>РУКОВОДСТВО</h2>
            <?php if($chief): ?>
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <img src="<?= $img ?>" style="width:100%">
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <p class="chief"><?= $chief->fio ?></p>
                        <p><span style="font-weight: bold;"><?= $chief->post ?></span></p>
                        <p>телефон: <a href="tel:<?= $chief->phone ?>"><?= $chief->phone ?></a></p>
                        <p>e-mail: <a href="mailto:<?= $chief->email ?>"><?= $chief->email ?></a></p>
                    </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-5 col-md-5">
            <h2>РЕКВИЗИТЫ КОМПАНИИ</h2>
            <div class="row partners-card">
                <div class="col-lg-2 col-md-2"><img src="/icons/msword.png" style="width:100%"></div>
                <div class="col-lg-8 col-md-8"><a href="/resources/partners_card.doc">Реквизиты компании<br/>(скачать)</a></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7 col-md-7">
            <h2>АДРЕС</h2>
            <p><?= $city->index.', '.$city->fake_address ?></p>
            <div id="map" style="width:80%; height: 300px; margin-top: 10px;"></div>
        </div>
        <div class="col-lg-5 col-md-5">
            <h2>ОТДЕЛ ПРОДАЖ</h2>
            <p class="sales">телефон: <a href="tel:<?= \Yii::$app->params['phone'] ?>"><?= \Yii::$app->params['phone'] ?></a></p>
            <p class="sales">e-mail: <a href="mailto:<?= \Yii::$app->params['saleEmail'] ?>"><?= \Yii::$app->params['saleEmail'] ?></a></p>
            <p style=" margin-top: 10px;"><span style="font-weight: bold;">режим работы:</span></p>
            <p>24/7</p>
        </div>
    </div>
</div>
<script type="text/javascript">
    function mapsInit() {
        var coords = ymaps.geocode("<?= $city->index.', '.$city->fake_address ?>"),
            mp, place;
        coords.then(
            function(res){
                mp = new ymaps.Map("map", {
                    center: res.geoObjects.get(0).geometry.getCoordinates(),
                    zoom:15});
                place = new ymaps.Placemark(res.geoObjects.get(0).geometry.getCoordinates(),
                    { hintContent:'ООО "ТЕРА-ИНВЕСТ"',
                      balloonContentHeader: 'ООО "ТЕРА-ИНВЕСТ"',
                      balloonContentBody: res.geoObjects.get(0).properties.get('text')
                    });
                mp.geoObjects.add(place);
            },
            function(err){
                console.log("Error geo");
            }
        );
    }

    window.onload = function(){
        ymaps.ready(mapsInit);
    };
</script>
