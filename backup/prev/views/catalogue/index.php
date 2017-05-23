<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.04.2017
 * Time: 16:50
 */
$city = Yii::$app->params['city'];
$this->title = "Каталог химической продукции в {$city->name} - ООО \"ТЕРА-ИНВЕСТ\"";
$this->params['breadcrumbs'][] = 'Каталог';
?>
<div class="catalogue-index">
    <div class="row">
        <div class="col-lg-3 col-md-3 catalogue">
            <p>Формирование каталога:</p>
            <div class="row">
                <a href="#" class="col-lg-6 col-md-6" data-catalogue-id="1">Карточки</a>
                <a href="#" class="col-lg-6 col-md-6" data-catalogue-id="2">Список</a>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 catalogue-content">

        </div>
    </div>
</div>