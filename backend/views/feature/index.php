<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeatureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Характеристики';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feature-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], [
            'class' => 'btn btn-success',
            'title' => 'Новая характеристика',
        ])?>
    </p>
<?php Pjax::begin(); ?>
    <div class="row">
    <?= GridView::widget([
        'summary' => 'Показано {begin}-{end} из {totalCount}',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [ 'class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'short_name',
                'headerOptions' => [ 'class' => 'col-lg-2 col-md-2'],
            ],
            [
                'attribute' => 'name',
                'headerOptions' => [ 'class' => 'col-lg-6 col-md-6'],
            ],
            [
                'attribute' => 'type_id',
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1'],
                'label' => 'Тип знач-я',
                'value' => function($model, $key, $index, $column) {
                    return $model->type->type;
                }
            ],
            [
                'attribute' => 'uom_id',
                'headerOptions' => [ 'class' => 'col-lg-2 col-md-2'],
                'label' => 'Ед-ца изм-я',
                'value' => function($model, $key, $index, $column) {
                    return isset($model->uom) ? $model->uom->name : '';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]) ?>
    </div>
<?php Pjax::end(); ?></div>
