<?php

use yii\helpers\Html;
use yii\grid\GridView,
    yii\grid\Column;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поставщики';
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новый поставщик', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'create_dt',
            // 'update_dt',
            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'col-lg-3 col-md-3'],
                'label' => 'Наименование',
            ],
            [
                'class' => Column::className(),
                'header' => 'Юр.адрес',
                'headerOptions' => [ 'class' => 'col-lg-2 col-md-2' ],
                'content' => function($model, $key, $index, $column) {
                    if ($model->jurAddress != Null) {
                        return $model->jurAddress->makeAddress();
                    }
                    return '';
                }
            ],
            /*
            [
                'class' => Column::className(),
                'header' => 'Почт.адрес',
                'headerOptions' => [ 'class' => 'col-lg-2 col-md-2' ],
                'content' => function($model, $key, $index, $column) {
                    if ($model->postAddress != Null) {
                        return $model->postAddress->makeAddress();
                    }
                    return '';
                }
            ],
            */
            //'description:ntext',
            // 'INN',
            // 'OGRN',
            // 'jur_address_id',
            // 'fact_address_id',
            // 'post_address_id',
            // 'logo',
            // 'phone',
            [
                'attribute' => 'phone',
                'filter' => false,
                'headerOptions' => ['class' => 'col-lg-2 col-md-2'],
                'label' => 'Телефоны',
            ],
            /*
            [
                'attribute' => 'site',
                'headerOptions' => ['class' => 'col-lg-2 col-md-2'],
            ],*/
            // 'note:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'col-lg-1 col-md-1'],
                'header' => 'Действия',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
