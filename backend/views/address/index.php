<?php

use yii\helpers\Html;
use yii\grid\GridView,
    yii\grid\Column;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Адреса';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => false,
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1' ],
            ],
            [
                'attribute' => 'region_id',
                'label' => 'Регион',
                'headerOptions' => [ 'class' => 'col-lg-3 col-md-3' ],
                'content' => function($model, $key, $index, $column){ return $model->region->name; },
            ],
            [
                'attribute' => 'settlement',
                'headerOptions' => [ 'class' => 'col-lg-2 col-md-2' ],
            ],
            [
                'class' => Column::className(),
                'header' => 'Полный адрес',
                'headerOptions' => [ 'class' => 'col-lg-5 col-md-5' ],
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->makeAddress(), '#', [ 'data' => [ 'selectable' => true, 'id' => $key ]]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
