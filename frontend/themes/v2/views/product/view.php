<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.04.2017
 * Time: 10:51
 */
use common\helpers\ImageHelper;
use yii\helpers\Html;
use frontend\assets\FancyboxAsset;
use yii\helpers\Url;

FancyboxAsset::register($this);

$city = Yii::$app->params['city'];
$this->title = $model->name.' купить в '.$city->name_pp;
$this->registerMetaTag([ 'name' => 'description', 'content' => $model->meta_desc]);
$this->registerMetaTag([ 'name' => 'keywords', 'content' => $model->meta_keys]);
$this->params['breadcrumbs'][] = [ 'label' => "<span itemprop=\"name\">$current_category->name</span>",
    'url' => [ 'category/view', 'city' => $city->uri_name, 'id' => $current_category->id ], 'itemprop' => 'item'];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="product-view">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
            <?= $this->render( '/common/_catalogue_tree', [ 'city' => $city, 'catalogue_type1' => $catalogue_type1,
                'catalogue_type2' => $catalogue_type2, 'categories' => $categories,
                'current_category' => $current_category, 'catalogue' => $catalogue ] ) ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-7 catalogue-content">
            <div class="row">
                <header class="col-lg-9 col-md-9 col-sm-9 col-xs-7">
                    <h1><?= $model->name?></h1>
                </header>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                    <noindex>
                    <?= Html::a('Купить', [ 'site/contact', 'city' => $city->uri_name, 'product_id' =>$model->id ], [
                        'class' => 'fancybox product-button red',
                        'rel' => 'nofollow',
                        'onclick' => "yaCounter44777377.reachGoal('Buy'); return true;",
                        'data' => [ 'pjax' => 0, ],
                    ]) ?>
                    </noindex>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div style="border-top: 1px solid #00275F"></div>
                    <article class="ql-editor">
                        <?php
                            $img_list = $model->getImages()->orderBy(['is_main' => SORT_DESC])->all();
                            if ($img_list) {
                                $img = ImageHelper::getImagePath(array_shift($img_list)->name);
                                $imageForStructData = $img;
                                $i = Html::img($img, ['style' => 'width:100%;']);
                                echo '<div class="image">';
                                echo '<div class="disabler"></div>';
                                echo Html::a($i, $img, [ 'rel' => 'slideshow-thumbs2', 'class' => 'slideshow-thumbs2' ]);
                                echo '</div>';
                                echo '<div class="hidden">';
                                foreach ($img_list as $img) {
                                    $i = Html::img(ImageHelper::getImagePath($img->name), ['style' => 'float:right; width:30%; margin-left: 1rem; margin-right: 1rem;']);
                                    echo Html::a($i, ImageHelper::getImagePath($img->name), [ 'rel' => 'slideshow-thumbs2', 'class' => 'slideshow-thumbs2' ]);
                                }
                                echo '</div>';
                            } else
                                echo Html::img(ImageHelper::$no_image, [ 'style' => 'float:right; width:30%; margin-left: 1rem; margin-right: 1rem;']);
                            ?>
                        <?= \frontend\helpers\ReplaceHelper::replaceSpecFields($model->description, [
                            'city_pp' => $city->name_pp
                        ]) ?>
                    </article>
                    <table class="table table-striped table-condensed features">
                    <caption class="features-header">Технические подробности:</caption>
                    <tbody>
                    <?php
                        if ($model->manufacturer) {
                            echo '<tr>';
                            echo Html::tag('td', 'Производитель' , ['class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6 left']);
                            echo Html::tag('td', $model->manufacturer->name, [ 'class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6 right']);
                            echo '</tr>';
                        }
                        foreach($model->features as $productFeature) {
                            echo '<tr>';
                            $value = $productFeature->value();
                            $uom = $productFeature->uom();
                            echo Html::tag('td', $uom ? $productFeature->feature->name.", {$uom->short_name}" : $productFeature->feature->name , ['class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6 left']);
                            echo Html::tag('td', $value, [ 'class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6 right']);
                            echo '</tr>';
                        }
                    ?>
                    </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p style="text-align: center"> Посмотрите другие товары в категории <?= Html::a($current_category->name,
                                [ 'category/view', 'city' => $city->uri_name , 'id' => $current_category->id ],
                                [ 'class' => 'important-link'])?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.addEventListener('load', function() {
        $('.catalogue-accordion').accordion('disable');
        $('.slideshow-thumbs2').fancybox({
            prevEffect: 'none',
            nextEffect: 'none',
            helpers: {
                thumbs: {
                    width: 100,
                    height: 50
                }
            }
        });
        setTimeout(function(){  $('.disabler').hide(); }, 500 );
    });
</script>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "Product",
    "name": "<?= Html::encode($model->name) ?>",
    "description": "<?= Html::encode($model->meta_desc) ?>"
    <?php if (isset($imageForStructData))
             echo ',"image": "'. Url::to($imageForStructData, true). '"'."\n"?>
    <?php if (!is_null($model->manufacturer)){
        echo ',"brand": {'."\n";
        echo '       "@type": "Thing",'."\n";
        echo '       "name": "'.Html::encode($model->manufacturer->name).'"'."\n";
        echo '    }';
    } ?>

}
</script>