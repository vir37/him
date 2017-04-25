<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.04.2017
 * Time: 10:17
 *                                       Шаблон одной карточки
 */

?>
<div class="row product-card">
    <div class="col-lg-12 col-md-12">
        <h3><?= $product->name ?></h3>
    </div>
    <div class="col-lg-5 col-md-5 left-column">
        <div class="row">

        </div>
        <div class="row"> <!-- Кнопка узнать цену -->
            <a href="#" class="product-button red">Узнать цену</a>
        </div>
        <div class="row"> <!-- Кнопка Подробнее -->
            <a href="#" class="product-button">Подробнее</a>
        </div>

    </div>
    <div class="col-lg-7 col-md-7 right-column">

    </div>
</div>