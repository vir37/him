<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Управление каталогом';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <h5><i class="fa fa-server" aria-hidden="true"></i><?= Html::a('Категории товаров', ['category/']) ?></h5>
                    <p>Модуль управления категориями: добавление, удаление, привязка ...</p>
                    <footer style="text-align: right; margin-right: 10px;"><i class="fa fa-ellipsis-v"></i></footer>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <h5><i class="fa fa-cubes" aria-hidden="true"></i>Товары</h5>
                    <footer style="text-align: right; margin-right: 10px;"><i class="fa fa-ellipsis-v"></i></footer>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <h5><i class="fa fa-shopping-basket" aria-hidden="true"></i>Товарные предложения</h5>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <h5><i class="fa fa-truck" aria-hidden="true"></i>Поставщики</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <h5><i class="fa fa-industry" aria-hidden="true"></i>Производители</h5>
                </div>
            </div>
        </div>
    </div>
</div>