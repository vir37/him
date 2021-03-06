<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.04.2017
 * Time: 10:17
 *                                       Шаблон одной карточки
 */
use yii\helpers\Html;
use \common\helpers\ImageHelper;

$img = $product->getImages()->orderBy(['is_main' => SORT_DESC])->one();
$img = $img ? ImageHelper::getImagePath($img->name) : ImageHelper::$no_image;
?>
<div class="row product-card">
    <div class="col-lg-12 col-md-12">
        <h3><?= $product->name ?></h3>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-4 left-column">
        <div class="row">
            <img src="<?= $img ?>" style="width:90%; margin-bottom: 10px;"/>
        </div>
        <div class="aligner"></div>
        <div class="row"> <!-- Кнопка узнать цену -->
            <?= Html::a('Купить', [ 'site/contact', 'city' => $city->uri_name, 'product_id' =>$product->id ], [
                'class' => 'fancybox product-button red',
                'data' => [ 'pjax' => 0, ],
            ]) ?>
        </div>
        <div class="row"> <!-- Кнопка Подробнее -->
            <?= Html::a('Подробности', [ 'product/view', 'city' => $city->uri_name, 'id' =>$product->id, 'parent_id' => $category ],
                [ 'class' => 'product-button', 'data-pjax' => 0]) ?>
        </div>
    </div>
    <div class="col-lg-7 col-md-7 col-sm-8 right-column">
        <div class="row">
            <p class="head">Описание</p>
            <div class="body"><?= $product->description ?></div>
        </div>
        <div class="row features">
            <?php
                foreach($product->features as $productFeature){
                    echo Html::tag('div', $productFeature->feature->name.':', [ 'class' => 'col-lg-6 col-md-6 col-sm-6 left']);
                    $value = $productFeature->value();
                    $uom = $productFeature->uom();
                    $value = $value ? $value.( $uom ? ', '.$uom->short_name: '') : $value;
                    echo Html::tag('div', $value, [ 'class' => 'col-lg-6 col-md-6 col-sm-6 right']);
                }
            ?>
        </div>

    </div>
</div>