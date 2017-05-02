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
