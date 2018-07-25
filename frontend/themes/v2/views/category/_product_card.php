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
<div class = "catalog__item">
    <div class="catalog__img">
        <?php
        try {
            echo EasyThumbnailImage::thumbnailImg(\Yii::getAlias("@images/".$img->name), 200, null, EasyThumbnailImage::THUMBNAIL_OUTBOUND, [
                'alt' => $product->name, 'style'=> 'width:90%; margin-bottom: 1rem;']);
        } catch (\Exception $e ) {
            echo "<img src='".ImageHelper::$no_image."' alt='".$product->name."' style='width:90%; margin-bottom: 1rem;'/>";
        }
        ?>
    </div>
    <div class="catalog__title subtitle"><h3><?= $product->name ?></h3></div>
    <ul>
        <li><strong>Производитель:</strong><span><?= $product->manufacturer?$product->manufacturer:'' ?></span></li>
        <li><strong>Описание:</strong><span>Основу материала составляет бисфенол.</span><span>KER 828 не воспламеняется, горит при...</span></li>
        <li><strong>Минимальный заказ:</strong><span>- Бочка, от 220 кг.</span></li>
    </ul>
    <div class="catalog__btns row">
        <a data-fancybox data-src="#popup-buy-small" href="javascript:;" class="catalog__btn btn btn_bg-green btn_color-white btn_normal"><i class="icon icon-cart-white"></i>Купить</a>
        <?= Html::a('<span>Подробности</span>',
            [ 'product/view', 'city' => $city->uri_name, 'id' =>$product->id, 'parent_id' => $category ],
            [ 'data' => [ 'pjax' => 0, ], 'class' => "catalog__btn btn btn_transparent btn_normal"] ) ?>
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