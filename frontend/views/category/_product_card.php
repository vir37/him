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
use \himiklab\thumbnail\EasyThumbnailImage;

$img = $product->getImages()->orderBy(['is_main' => SORT_DESC])->one();
?>
<div class="row product-card">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>
        <?= Html::a($product->name,
            [ 'product/view', 'city' => $city->uri_name, 'id' =>$product->id, 'parent_id' => $category ],
            [ 'data' => [ 'pjax' => 0, ]] ) ?>
        </h3>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 left-column">
        <div class="row">
            <?php
                try {
                    echo EasyThumbnailImage::thumbnailImg(\Yii::getAlias("@images/".$img->name), 200, null, EasyThumbnailImage::THUMBNAIL_OUTBOUND, [
                        'alt' => $product->name, 'style'=> 'width:90%; margin-bottom: 1rem;']);
                } catch (\Exception $e ) {
                    echo "<img src='".ImageHelper::$no_image."' alt='".$product->name."' style='width:90%; margin-bottom: 1rem;'/>";
                }
            ?>
        </div>
        <div class="aligner"></div>
        <div class="row"> <!-- Кнопка узнать цену -->
            <noindex>
            <?= Html::a('Купить', [ 'site/contact', 'city' => $city->uri_name, 'product_id' =>$product->id ], [
                'class' => 'fancybox product-button red',
                'rel' => 'nofollow',
                'onclick' => "yaCounter44777377.reachGoal('Buy'); return true;",
                'data' => [ 'pjax' => 0, ],
            ]) ?>
            </noindex>
        </div>
        <div class="row"> <!-- Кнопка Подробнее -->
            <?= Html::a('Подробности', [ 'product/view', 'city' => $city->uri_name, 'id' =>$product->id, 'parent_id' => $category ],
                [ 'class' => 'product-button', 'data-pjax' => 0]) ?>
        </div>
    </div>
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 right-column">
        <div class="row">
            <p class="head">Описание</p>
            <div class="body">
                <?php
                    if ($product->manufacturer)
                        echo "<p><strong>Производитель: </strong>{$product->manufacturer->name}</p><br/>";
                ?>
                <?= $product->description ?>
            </div>
        </div>
        <div class="row features">
            <?php
                foreach($product->features as $productFeature){
                    echo Html::tag('div', $productFeature->feature->name.':', [ 'class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6 left']);
                    $value = $productFeature->value();
                    $uom = $productFeature->uom();
                    $value = $value ? $value.( $uom ? ', '.$uom->short_name: '') : $value;
                    echo Html::tag('div', $value, [ 'class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6 right']);
                }
            ?>
        </div>

    </div>
</div>