<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.05.2017
 * Time: 10:59
 * params: $city, $catalogue_type1, $catalogue_type2, $categories, $current_category, $catalogue
 */
use yii\helpers\Html;

?>
<div class="catalogue">
    <p>Формирование каталога:</p>
    <div class="row">
        <?= Html::a('Каталог', [ 'category/list', 'city' => $city->uri_name, 'id' => $catalogue_type1,],
            [ 'class' => "col-lg-6 col-md-6 col-sm-6 catalogue-type" ]) ?>
        <?= Html::a('Отрасли', [ 'category/list', 'city' => $city->uri_name, 'id' => $catalogue_type2,],
            [ 'class' => "col-lg-6 col-md-6 col-sm-6 catalogue-type" ]) ?>
    </div>
    <div class="row">
        <?php
        // Отрисовка дерева категорий
        $items = [];
        $id = isset($current_category) ? $current_category->id : -1;
        $i = -1;
        $active = false;
        foreach ($categories as $category) {
            $i++;
            $url = \yii\helpers\Url::to([ 'category/view','city' => $city->uri_name, 'id' => $category['id'] ]);
            $active = $id == $category['id'] ? $i : $active;
            $elem = [ 'header' => Html::a($category['name'], $url, [ 'data-pjax' => 0 ]), 'content' => '' ];
            if (isset($category['children'])) {
                $content = '';
                foreach($category['children'] as $child){
                    $url = \yii\helpers\Url::to([ 'category/view', 'city' => $city->uri_name, 'id' => $child['id'] ]);
                    $active = $id == $child['id'] ? $i : $active;
                    $class = $id == $child['id'] ? 'subcategory subcategory-active' : 'subcategory';
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
<script type="text/javascript">
    window.addEventListener('load', function() {
        $('.catalogue-accordion').on('click', 'a', function(event){
            $('.catalogue-accordion a').removeClass('subcategory-active');
            if ($(this).hasClass('subcategory'))
                $(this).addClass('subcategory-active');
        });
    });
</script>
