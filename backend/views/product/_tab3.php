<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.03.2017
 * Time: 22:41
 */
use yii\helpers\Html,
    yii\helpers\ArrayHelper,
    yii\helpers\Url;

use yii\grid\GridView,
    yii\grid\ActionColumn;
use yii\bootstrap\ActiveForm;
use common\models\Catalogue,
    common\models\Category,
    common\models\CategoryProduct;
use yii\widgets\Pjax,
    yii\bootstrap\Alert;
use yii\db\Query;

$catalogues = Catalogue::find()->all();
$dataProvider = new \yii\data\ActiveDataProvider();
$product_id = isset($product_id) ? $product_id : null;
$disabled = (isset($mode) && $mode == 'view') || !isset($product_id) ? true : false;
?>
<?php Pjax::begin([
    'enableReplaceState' => false,
    'enablePushState' => false,
    'timeout' => 10000,
    'id' => 'tab3_pjax',
]); ?>

<?= Html::beginTag('fieldset', [ 'disabled' => $disabled ]) ?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-sitemap fa-2x" aria-hidden="true"></i>
        <h3 class="panel-title">Связанные категории</h3>
    </div>
    <div class="panel-body">
        <!-- Блок уведомлений -->
        <div id="alert-placement">
            <?php
            if (isset($alert)) {
                echo Alert::widget([
                    'options' => [ 'class' => "alert-{$alert['type']}", ],
                    'body' => $alert['body'],
                ]);
            }
            ?>
        </div>
        <?php
                if ($product_id) {
                    foreach ($catalogues as $catalogue) {
                        $query = new Query();
                        $query->addSelect(['`c`.*, `cp`.`list_position` as `product_position`'])
                            ->from(['c' => Category::tableName()])
                            ->leftJoin(['cp' => CategoryProduct::tableName()], 'c.id = cp.category_id')
                            ->where(['c.catalogue_id' => $catalogue->id])
                            ->andWhere(['cp.product_id' => $product_id]);
                        if ($query->count() > 0) {
                            $dataProvider->query = $query;
                            $dataProvider->refresh();
                            echo '<div class="row">';
                            echo GridView::widget([
                                'dataProvider' => $dataProvider,
                                'summary' => "<div class='col-lg-12 col-md-12'>
                                                <h5 style='background: cornsilk;'><span class='glyphicon glyphicon-book'></span> {$catalogue->name}</h5>
                                             </div>",
                                'options' => ['class' => 'col-lg-12 col-md-12'],
                                'columns' => [
                                    [
                                        'attribute' => 'name',
                                        'enableSorting' => false,
                                        'options' => ['class' => 'col-lg-9 col-md-9'],
                                        'label' => 'Категория',
                                        'content' => function($model, $key, $index, $column) {
                                            return \yii\widgets\Breadcrumbs::widget([
                                                'homeLink' => false,
                                                'links' => Category::findOne($model['id'])->buildBreadcrumbs(),
                                                'options' => ['class' => 'tree-breadcrumbs'],
                                            ]);
                                        }
                                    ],
                                    [
                                        'attribute' => 'product_position',
                                        'enableSorting' => false,
                                        'label' => 'Позиция в категории',
                                        'content' => function($model, $key, $index, $column) use ($product_id){
                                            return \yii\bootstrap\ButtonDropdown::widget([
                                                'label' => $model['product_position'],
                                                'containerOptions' => [ 'class' => "col-lg-5 col-md-5"],
                                                'options' => [
                                                    'class' => 'btn-default btn-sm col-lg-12 col-md-12 position-selector',
                                                    'data' => [
                                                        'category' => $model['id'],
                                                        'product' => $product_id,
                                                        'position' => $model['product_position'],
                                                        'url' => Url::toRoute(['/category-product/list']),
                                                        'action-url' => Url::toRoute(['/category-product/change-position',
                                                            'category_id' => $model['id'], 'product_id' => $product_id
                                                        ]),
                                                    ],
                                                ],
                                                'dropdown' => ['id' => "list_{$model['id']}_{$product_id}", ],
                                            ]);
                                        }
                                    ],
                                    [
                                        'class' => ActionColumn::className(),
                                        'template' => '{delete}',
                                        'controller' => 'category-product',
                                        'buttons' => [
                                            'delete' => function($url, $model, $key) use ($product_id, $disabled){
                                                return Html::a('<span class="fa fa-chain-broken"></span>',
                                                    Url::to(['product/unlink-category', 'category_id' => $model['id'],
                                                             'product_id' => $product_id]),
                                                    [
                                                        'title' => 'Разорвать связь c категорией',
                                                        'data' => [
                                                            'confirm' => 'Вы дествительно хотите отвязать категорию?',
                                                            'pjax' => 1,
                                                        ],
                                                        'disabled' => $disabled ,
                                                    ]);
                                            },
                                        ],
                                    ],
                                ],
                            ]);
                            echo '</div>';
                        }
                    }
                }
        ?>
        <!-- Блок добавления новой связки Товара с Категорией -->
        <?php if ($mode == 'update'): ?>
            <div class="delimiter"></div>
            <div class="row">
                <?php $form = ActiveForm::begin([
                    'action' => ['assign-category'],
                    'layout' => 'inline',
                    'options' => [ 'data-pjax' => true ],
                    'fieldConfig' => [ 'labelOptions' => [ 'class' => 'control-label', ], ]
                ]); ?>
                <?= $form->field($model, 'product_id')->hiddenInput(['value' => $product_id])->label(false) ?>
                <div class="form-group  col-lg-4 col-md-4">
                    <?= Html::label('Каталог', 'catalogue_select', ['class' => 'control-label col-lg-4 col-md-4']) ?>
                    <div class="col-lg-8 col-md-8">
                    <?= Html::dropDownList('catalogue_select', null,
                        ArrayHelper::map($catalogues, 'id', 'name'),[
                            'id' => 'catalogue_select',
                            'prompt' => '...',
                            'data-target' => '#category_id',   // Целевой контейнер, который будет заполняться списком категорий
                            'data-url' => '/category/list?product_id='.$product_id. '&include=0',    // URL для AJAX-запроса данных
                            'class' => 'form-control',
                        ])?>
                    </div>
                    <i class="fa fa-spinner fa-spin fa-2x fa-fw loader-hide" style="position: absolute;"></i>
                </div>
                <?= $form->field($model, 'category_id', [
                    'labelOptions' => ['class' => 'control-label col-lg-4 col-md-5'],
                    'inputTemplate' => '<div class="col-lg-6 col-md-5">{input}</div>',
                    'options' => ['class' => 'form-group col-lg-7 col-md-7'],
                ])->dropDownList( [], [ 'prompt' => '...', 'id' => 'category_id',])->label('Категория') ?>
                <?= Html::submitButton('<i class="fa fa-link"></i>', [
                    'class' => 'btn btn-primary',
                    'name' => 'add',
                    'title' => 'Привязать категорию',
                ]) ?>
                <?php ActiveForm::end(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= Html::endTag('fieldset') ?>
<?php Pjax::end(); ?>
<!-- Скрипты -->
<script type="text/javascript">
    function getPositions() {
        var that = $(this), url = that.attr('data-url'),
            action = that.attr('data-action-url'),
            category = that.attr('data-category'),
            product = that.attr('data-product'),
            position = that.attr('data-position');
        $.ajax(url+'?category_id='+category+'&product_id='+product, {
            dataType: 'json',
            async: false,
            success: function (data, status) {
                var list = $('#list_'+category+'_'+product);
                list.html("");
                while (data.length) {
                    el = data.shift();
                    if (el.list_position == position)
                        list.append('<li class="disabled"><a data-pjax=0 href="#">'+el.list_position+'</a></li>');
                    else
                        list.append('<li><a data-pjax=0 class="new-position" href="#" data-action-url="'+action+'&new_position='+el.list_position+'">'+el.list_position+'</a></li>');
                }
            },
            error: function (data, status, e) {
                alert('Request error: ' + e);
            }
        });
        return false;
    }
    function changePosition(){
        var btn = $(this).parentsUntil('td').find('button');
        $.ajax($(this).attr('data-action-url'), {
            dataType: 'json',
            success: function(data, status) {
                if (data.status == 'success') {
                    var html = btn.html().replace(/[0-9]*/, data.position);
                    btn.html(html);
                    btn.attr('data-position', +data.position);
                }
                $('#alert-placement').html(data.response);
            },
            error: function(data, status, e) {
                alert('Response error: ' + e);
            }
        });
    }

    window.addEventListener('load', function () {
        $(document).on('click', '.position-selector', getPositions);
        $(document).on('click', '.new-position', changePosition);
    });
</script>