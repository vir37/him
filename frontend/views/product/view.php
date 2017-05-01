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

$this->params['breadcrumbs'][] = [ 'label' => 'Каталог', 'url' => [ 'catalogue/view' ]];
$city = Yii::$app->params['city'];
$this->title = $model->name;
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="product-view">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 catalogue"></div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 catalogue-content">
            <div class="row">
                <header class="cik-lg-12 col-md-12 col-sm-12">
                    <h1><?= $model->name?></h1>
                </header>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-7">
                    <div style="border-top: 1px solid #00275F"></div>
                    <article class="ql-editor">
                        <?= $model->description ?>
                    </article>
                    <p class="features-header">Технические подробности</p>
                    <table class="table table-striped table-condensed features">
                    <?php
                        foreach($model->features as $productFeature) {
                            echo '<tr>';
                            $value = $productFeature->value();
                            $uom = $productFeature->uom();
                            $value = $value ? $value . ($uom ? ', ' . $uom->short_name : '') : $value;
                            echo Html::tag('td', $productFeature->feature->name , ['class' => 'col-lg-6 col-md-6 col-sm-6 left']);
                            echo Html::tag('td', $value, [ 'class' => 'col-lg-6 col-md-6 col-sm-6 right']);
                            echo '</tr>';
                        }
                    ?>
                    </table>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5">
                    <?php
                        $img = $model->getImages()->orderBy(['is_main' => SORT_DESC])->one();
                        $img = $img ? ImageHelper::getImagePath($img->name) : ImageHelper::$no_image;
                        echo Html::img($img);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>