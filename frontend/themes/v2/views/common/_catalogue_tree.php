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
<div class="aside">
    <div class="aside__title subtitle">Каталог</div>
    <div class="aside__nav nav-block">
        <ul>
        <?php
        // Отрисовка дерева категорий
        $items = [];
        $id = isset($current_category) ? $current_category->id : -1;
        $i = -1;
        foreach ($categories as $category) {
            $i++;
            $url = \yii\helpers\Url::to([ 'category/view','city' => $city->uri_name, 'id' => $category['id'] ]);
            $active = $id == $category['id'];
            $content = '';
            // $elem = [ 'header' => Html::a($category['name'], $url, [ 'data-pjax' => 0 ]), 'content' => '' ];
            if (isset($category['children'])) {
                $content = '<ul>';
                foreach($category['children'] as $child){
                    $url = \yii\helpers\Url::to([ 'category/view', 'city' => $city->uri_name, 'id' => $child['id'] ]);
                    $active = $id == $child['id'] or $active;
                    $params = $id == $child['id'] ? ['class' => 'selected', 'data-pjax' => 0] : ['data-pjax' => 0];
                    $content .= Html::tag('li', Html::a($child['name'], $url, $params));
                }
                $content .= '</ul>';
            }
            $params = $active ? [ 'class' => 'selected' ]: [];
            echo Html::beginTag('li', $params);
            echo Html::a($category['name'], $url, ['style' => 'text-transform: uppercase;', 'data-pjax' =>0]);
            echo $content;
            echo Html::endTag('li');
        }
        ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    window.addEventListener('load', function() {
    });
</script>
