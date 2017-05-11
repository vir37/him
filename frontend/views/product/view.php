<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.04.2017
 * Time: 10:51
 */
use common\helpers\ImageHelper;
use yii\helpers\Html;
use yii\widgets\ListView;

$city = Yii::$app->params['city'];
$this->title = $model->name;
$this->registerMetaTag([ 'name' => 'description', 'content' => $model->meta_desc]);
$this->registerMetaTag([ 'name' => 'keywords', 'content' => $model->meta_keys]);
$this->params['breadcrumbs'][] = [ 'label' => 'Каталог', 'url' => [ 'category/list', 'city' => $city->uri_name, 'id' => $catalogue ]];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="product-view">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4">
            <?= $this->render( '/common/_catalogue_tree', [ 'city' => $city, 'catalogue_type1' => $catalogue_type1,
                'catalogue_type2' => $catalogue_type2, 'categories' => $categories,
                'current_category' => $current_category, 'catalogue' => $catalogue ] ) ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 catalogue-content">
            <div class="row">
                <header class="col-lg-12 col-md-12 col-sm-12">
                    <h1><?= $model->name?></h1>
                </header>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div style="border-top: 1px solid #00275F"></div>
                    <article class="ql-editor">
                        <?php
                            $img = $model->getImages()->orderBy(['is_main' => SORT_DESC])->one();
                            $img = $img ? ImageHelper::getImagePath($img->name) : ImageHelper::$no_image;
                            echo Html::img($img, [ 'style' => 'float:right; width:30%; margin-left: 10px; margin-right: 10px;']);
                            ?>
                        <?= $model->description ?>
                    </article>
                    <p class="features-header">Технические подробности:</p>
                    <table class="table table-striped table-condensed features">
                    <tbody>
                    <?php
                        foreach($model->features as $productFeature) {
                            echo '<tr>';
                            $value = $productFeature->value();
                            $uom = $productFeature->uom();
                            echo Html::tag('td', $uom ? $productFeature->feature->name.", {$uom->short_name}" : $productFeature->feature->name , ['class' => 'col-lg-6 col-md-6 col-sm-6 left']);
                            echo Html::tag('td', $value, [ 'class' => 'col-lg-6 col-md-6 col-sm-6 right']);
                            echo '</tr>';
                        }
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.onload = function() {
        $('.catalogue-accordion').accordion('disable');
        /*
        $(document).on('click', '.catalogue-accordion a', function (event) {
            event.preventDefault();
        });*/
    };
</script>