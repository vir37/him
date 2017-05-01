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
        <div class="col-lg-3 col-md-3 col-sm-4 catalogue">
            <p>Формирование каталога:</p>
            <div class="row">
                <?= Html::a('Каталог', [ 'catalogue/view', 'city' => $city->uri_name, 'id' => $catalogue_type1,],
                    [ 'class' => "col-lg-6 col-md-6 col-sm-6 catalogue-type" ]) ?>
                <?= Html::a('Отрасли', [ 'catalogue/view', 'city' => $city->uri_name, 'id' => $catalogue_type2,],
                    [ 'class' => "col-lg-6 col-md-6 col-sm-6 catalogue-type" ]) ?>
            </div>
            <div class="row">
                <?php
                    // Отрисовка дерева категорий
                    $items = [];
                    $i = -1;
                    $active = false;
                    $request_url = explode('?', \Yii::$app->request->url)[0];
                    foreach ($categories as $category) {
                        $i++;
                        $url = \yii\helpers\Url::to([ 'catalogue/view','city' => $city->uri_name,'id' => $catalogue,
                            'category' => $category['id'] ]);
                        $active = $url == $request_url ? $i : $active;
                        $elem = [ 'header' => Html::a($category['name'], $url, [ 'data-pjax' => 1 ]), 'content' => '' ];
                        if (isset($category['children'])) {
                            $content = '';
                            foreach($category['children'] as $child){
                                $url = \yii\helpers\Url::to([ 'catalogue/view', 'city' => $city->uri_name,
                                    'id' => $catalogue, 'category' => $child['id'] ]);
                                $active = $url == $request_url ? $i : $active;
                                $class = $url == $request_url ? 'subcategory-active' : '';
                                $content .= Html::a($child['name'], $url, [ 'class' => 'ui-accordion-header catalogue-accordion-content '.$class , 'data-pjax' => 0]);
                            }
                            $elem['content'] = $content;
                        }
                        $items[] = $elem;
                    }
                ?>
                <?= \yii\jui\Accordion::widget([
                    'items' => $items,
                    'id' => 'catalogue_accordion',
                    'options' => [ 'class' => 'catalogue-accordion'],
                    'clientEvents' => [
                        'changestart' => 'function() { console.log("test"); }',
                    ],
                    'clientOptions' => [
                        'collapsible' => true,
                        'active' => $active,
                        'heightStyle' => 'content',
                        'icons' => false,
                    ],
                    'headerOptions' => [ 'tag' => 'div' ],
                ]) ?>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 catalogue-content">
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