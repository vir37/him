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
use yii\bootstrap\ActiveForm;
use common\models\Feature,
    common\models\ProductFeature;
use yii\db\Query;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$product_id = isset($product_id) ? $product_id : 0;
$fQuery = (new Query())->select('feature_id')->from(ProductFeature::tableName())->where(['product_id' => $product_id]);

$dataProvider = new ActiveDataProvider();
$dataProvider->query = ProductFeature::find()->where([ 'product_id' => $product_id]);

?>
<?php Pjax::begin([ 'enableReplaceState' => false, 'enablePushState' => false, 'timeout' => 6000 ]); ?>
<?= Html::beginTag('fieldset', [ 'disabled' => (isset($mode) && $mode == 'view') ]) ?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-tasks fa-2x" aria-hidden="true"></i>
        <h3 class="panel-title">Характеристики</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'options' => ['class' => 'col-lg-12 col-md-12'],
                'columns' => [
                    [
                        'headerOptions' => [ 'class' => 'col-lg-1 col-md-1'],
                        'class' => 'yii\grid\SerialColumn',
                    ],
                    [
                        'headerOptions' => [ 'class' => 'col-lg-3 col-md-3'],
                        'label' => 'Наименование',
                        'content' => function($model, $key, $index, $column) {
                            $content = $model->feature->name;
                            $content .= isset($model->feature->uom) ? ', '.$model->feature->uom->short_name : '';
                            return "<p>$content</p>";
                        }
                    ],
                    [
                        'headerOptions' => [ 'class' => 'col-lg-7 col-md-7'],
                        'label' => 'Значение',
                        'content' => function($model, $key, $index, $column) {
                            switch ($model->feature->type_id) {
                                case 1: $value = $model->value_numeric; break;
                                case 2: $value = $model->value_string; break;
                                default: $value = '';
                            };
                            return Html::textInput("product_feature_{$model->id}", $value, [
                                'class' => 'col-lg-11 col-md-11',
                                'disabled' => true,
                            ]).' '.Html::a('<span class="glyphicon glyphicon-ok"></span>',
                                Url::to(["product-feature/update", "id" => $model->id]),
                                [
                                    'class' => 'btn-icon',
                                    'data' => [
                                        'pjax' => 0,
                                    ],
                                ]
                            );
                        }
                    ],
                    [
                        'class' => \yii\grid\ActionColumn::className(),
                        'controller' => 'product-feature',
                        'template' => '{update}&nbsp;&nbsp;{delete}',
                        'contentOptions' => [ 'class' => 'action'],
                        'buttons' => [
                            'update' => function($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                                    'title' => 'Update',
                                    'aria-label' => 'Update',
                                    'data' => [ 'pjax' => 0 ],
                                ]);
                            },
                            'delete' => function($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => 'Delete',
                                    'aria-label' => 'Delete',
                                    'data' => [ 'pjax' => 0, 'method' => 'post' ],
                                ]);
                            },
                        ],
                    ],
                ],
            ]) ?>
        </div>
        <!-- Блок добавления новой характеристики -->
        <?php if ($mode == 'update'): ?>
            <div class="delimiter"></div>
            <div class="row">
                <?php $form = ActiveForm::begin([
                    'action' => ['add-feature'],
                    'layout' => 'inline',
                    'options' => [ 'data-pjax' => true ],
                ]); ?>
                <?= $form->field($model, 'product_id')->hiddenInput(['value' => $product_id])->label(false) ?>

                <?php
                    $features = Feature::find()->where(['not in', 'id', $fQuery])->all();
                    $feature_ops = array();
                    array_walk($features, function($item, $key) use (&$feature_ops){
                        $feature_ops[$item->id] = [ 'type_id' => $item->type_id ];
                    });
                    echo $form->field($model, 'feature_id', [
                        'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                        'labelOptions' => ['class' => 'control-label col-lg-4 col-md-4'],
                        'wrapperOptions' => [ 'class' => 'col-lg-7 col-md-7' ],
                        'inputTemplate' => '{input}<i class="fa fa-spinner fa-spin fa-2x fa-fw loader-hide" style="position: absolute;"></i>',
                        'options' => ['class' => 'form-group col-lg-4 col-md-4'],
                    ])->dropDownList(ArrayHelper::map($features, 'id', 'name'),
                    [
                        'prompt' => '...',
                        'id' => 'feature_select',
                        'options' => $feature_ops,
                    ])->label('Характеристика');
                ?>

                <?= $form->field($model, 'value_numeric', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8' ],
                    'options' => [
                        'class' => 'form-group col-lg-3 col-md-3 feature-value',
                        'id' => 'value-numeric', 'style' => 'display:none;'
                    ],
                ])->textInput()->label('Значение') ?>

                <?= $form->field($model, 'value_string', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'labelOptions' => [ 'class' => 'control-label col-lg-3 col-md-3'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9' ],
                    'options' => [
                        'class' => 'form-group col-lg-6 col-md-6 feature-value',
                        'id' => 'value-string', 'style' => 'display:none'
                    ],
                ])->textInput()->label('Значение') ?>

                <?= Html::submitButton('<i class="fa fa-plus"></i>', [
                    'class' => 'btn btn-primary',
                    'name' => 'add',
                    'title' => 'Добавить характеристику',
                ]) ?>
                <?php ActiveForm::end(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= Html::endTag('fieldset') ?>
<?php Pjax::end(); ?>
<script type="text/javascript">
    window.addEventListener('load', function() {
        $(document).on('change', '#feature_select', function(){
            $('.feature-value').removeClass('required').hide();
            switch ($(this).find('option:selected').attr('type_id')) {
                case "1": $('#value-numeric').addClass('required').show(); break;
                case "2": $('#value-string').addClass('required').show(); break;
            }
        });

        $(document).on('click', 'td.action a', function() {
            debugger;
            event.preventDefault();
            alert('click');
            return false;
        });
    });
</script>