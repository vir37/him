<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\assets\FancyboxAsset;
/* @var $this yii\web\View */
/* @var $searchModel common\models\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

FancyboxAsset::register($this);
$this->title = 'Склады';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1', ],
            ],
            [
                'attribute' => 'id',
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1', ],
            ],
            [
                'attribute' => 'supplier_id',
                'label' => 'Поставщик',
                'headerOptions' => [ 'class' => 'col-lg-5 col-md-5' ],
                'content' => function($model, $key, $index, $column) {
                    return $model->supplier->name;
                }
            ],
            [
                'attribute' => 'address_id',
                'label' => 'Адрес',
                'filter' => false,
                'content' => function($model, $key, $index, $column) {
                    return $model->address ? $model->address->makeAddress() : '';
                }
            ],
            // 'work_hours',
            // 'note:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1' ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
