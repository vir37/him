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
                'headerOptions' => ['class' => 'col-lg-2 col-md-2'],
                'label' => 'Наименование',
            ],
            [
                'class' => Column::className(),
                'header' => 'Юр.адрес',
                'headerOptions' => [ 'class' => 'col-lg-2 col-md-2' ],
                'content' => function($model, $key, $index, $column) {
                    if (($address = $model->jurAddress()) != Null) {
                        return $address->makeAddress();
                    }
                    return 'пусто';
                }
            ],
            [
                'class' => Column::className(),
                'header' => 'Почт.адрес',
                'headerOptions' => [ 'class' => 'col-lg-2 col-md-2' ],
                'content' => function($model, $key, $index, $column) {
                    if (($address = $model->postAddress()) != Null) {
                        return $address->makeAddress();
                    }
                    return 'пусто';
                }
            ],
            //'description:ntext',
            // 'INN',
            // 'OGRN',
            // 'jur_address_id',
            // 'fact_address_id',
            // 'post_address_id',
            // 'logo',
            // 'phone',
            [
                'attribute' => 'email',
                'headerOptions' => ['class' => 'col-lg-2 col-md-2'],
                'label' => 'Email',
            ],
            [
                'attribute' => 'site',
                'headerOptions' => ['class' => 'col-lg-2 col-md-2'],
            ],
            // 'note:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
