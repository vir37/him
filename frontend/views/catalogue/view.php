<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.04.2017
 * Time: 16:50
 */
use yii\helpers\Html;
use yii\widgets\Pjax;

$city = Yii::$app->params['city'];
if ($current_category) {
    $this->title = "{$current_category->name} в г.{$city->name} - ООО \"ТЕРА-ИНВЕСТ\"";
    $this->registerMetaTag([ 'name' => 'description', 'content' => $current_category->meta_desc]);
    $this->registerMetaTag([ 'name' => 'keywords', 'content' => $current_category->meta_keys]);
} else {
    $this->title = "Каталог химической продукции в {$city->name} - ООО \"ТЕРА-ИНВЕСТ\"";
    $this->registerMetaTag([ 'name' => 'description', 'content' => $this->title]);
}
$this->params['breadcrumbs'][] = 'Каталог';
?>
<div class="catalogue-index">
    <div class="row">
        <?php Pjax::begin([ 'id' => 'pjax-container', 'timeout' => 6000 ]); ?>
        <div class="col-lg-3 col-md-3 col-sm-4">
            <?= $this->render( '_catalogue_tree', [ 'city' => $city, 'catalogue_type1' => $catalogue_type1,
                                                    'catalogue_type2' => $catalogue_type2, 'categories' => $categories,
                                                    'current_category' => $current_category, 'catalogue' => $catalogue ] ) ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 catalogue-content">
            <div style="position:absolute; margin: 0 auto; "><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
            <header class="row">
                <h1><?= $this->title?></h1>
            </header>
            <div class="row">
                <?php
                    if ($current_category) {
                        foreach ($current_category->product as $product){
                            echo '<div class="col-lg-6 col-md-6 col-sm-12">';
                            echo $this->render('_product_card', [ 'product' => $product, 'city' => $city ]);
                            echo '</div>';
                        }
                    }
                ?>
            </div>
            <article class="row ql-editor">
                <?php
                    if ($current_category)
                        echo $current_category->description;
                ?>
            </article>
        </div>
        <?php Pjax::end(); ?>
    </div>
</div>
<script type="text/javascript">
    function alignBlockHeight() {
        // выравниваем высоту блоков
        var maxHeight = 0;
        $('.product-card .left-column').each(function(){
            var  height = $(this).height();
            maxHeight = Math.max(maxHeight, height);
            $(this).on('trigger.align', '.aligner', function(event){
                if (height)
                    $(this).height(maxHeight-height);
            });
        });
        $('.aligner').trigger('trigger.align');
    }

    window.onload = function() {
        $(document).on('click', '.catalogue-accordion a', function (event) {
            var container = $(this).closest('[data-pjax-container]');
            $.pjax({url: this.href, container: container });
            event.preventDefault();
        });
        alignBlockHeight();
        $(document).on('pjax:end', alignBlockHeight);
    };
</script>