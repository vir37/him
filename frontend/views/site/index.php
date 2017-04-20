<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;

$this->title = 'ООО "ТЕРА-ИНВЕСТ"';
?>
<div class="site-index">

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
    <!--
    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>
    -->
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
