<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Управление каталогами';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="body-content">
    <div class="container">
        <div class="row">
            <h5><?= Html::a('Список каталогов', ['catalogue/list'],[ 'class' => 'btn btn-default'])?></h5>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <header>
                        <h5><i class="fa fa-server" aria-hidden="true"></i><?= Html::a('Категории товаров', ['category/']) ?></h5>
                    </header>
                    <section>
                        <p><small><i>Модуль управления категориями: добавление, удаление, привязка ...</i></small></p>
                        <ul>
                            <li><?= Html::a('Новая категория', ['category/create']) ?></li>
                        </ul>
                    </section>
                    <footer><i class="fa fa-ellipsis-v"></i></footer>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <header>
                        <h5><i class="fa fa-cubes" aria-hidden="true"></i>Товары</h5>
                    </header>
                    <section></section>
                    <footer><i class="fa fa-ellipsis-v"></i></footer>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <header>
                        <h5><i class="fa fa-shopping-basket" aria-hidden="true"></i>Товарные предложения</h5>
                    </header>
                    <section></section>
                    <footer><i class="fa fa-ellipsis-v"></i></footer>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <header>
                        <h5><i class="fa fa-truck" aria-hidden="true"></i>Поставщики</h5>
                    </header>
                    <section></section>
                    <footer><i class="fa fa-ellipsis-v"></i></footer>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3 no-padding">
                <div class="window">
                    <header>
                        <h5><i class="fa fa-industry" aria-hidden="true"></i>Производители</h5>
                    </header>
                    <section></section>
                    <footer><i class="fa fa-ellipsis-v"></i></footer>
                </div>
            </div>
        </div>
    </div>
</div>