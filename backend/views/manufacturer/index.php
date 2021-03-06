<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Производители';
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новый производитель', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => [ 'style' => 'width: 50px;'],
            ],
            'name',
            [
                'attribute' => 'web_site',
                'format' => 'raw',
                'value' => function($data) { return Html::a($data->web_site, $data->web_site); }
            ],
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'value' => function($data) {
                    $img = strlen($data->logo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($data->logo) : '/icons/no_logo.png';
                    return Html::img($img, ['style' => 'width:100px;']);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
