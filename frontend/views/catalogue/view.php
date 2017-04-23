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
$this->title = "Каталог химической продукции в {$city->name} - ООО \"ТЕРА-ИНВЕСТ\"";
$this->params['breadcrumbs'][] = 'Каталог';
?>
<div class="catalogue-index">
    <div class="row">
        <?php Pjax::begin([ 'id' => 'pjax-container', 'timeout' => 60000 ]); ?>
        <div class="col-lg-3 col-md-3 catalogue">
            <p>Формирование каталога:</p>
            <div class="row">
                <?= Html::a('Карточки', [ 'catalogue/view', 'city' => $city->uri_name, 'id' => $catalogue_type1,],
                    [ 'class' => "col-lg-6 col-md-6 catalogue-type" ]) ?>
                <?= Html::a('Список', [ 'catalogue/view', 'city' => $city->uri_name, 'id' => $catalogue_type2,],
                    [ 'class' => "col-lg-6 col-md-6 catalogue-type" ]) ?>
            </div>
            <div class="row">
                <?php
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
        <div class="col-lg-9 col-md-9 catalogue-content">

        </div>
        <?php Pjax::end(); ?>
    </div>
</div>
<script type="text/javascript">
    window.onload = function() {
        $(document).on('click', '.catalogue-accordion a', function (event) {
            var container = $(this).closest('[data-pjax-container]');
            $.pjax({url: this.href, container: container });
            event.preventDefault();
        });
    };
</script>