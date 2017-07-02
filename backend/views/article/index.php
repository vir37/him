<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Текстовые статьи';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

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
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1'],
            ],
            //'create_dt',
            [
                'attribute' => 'update_dt',
                'filter' => false,
                'headerOptions' => [ 'class' => 'col-lg-2 col-md-2' ],
            ],
            [
                'attribute' => 'name',
                'headerOptions' => [ 'class' => 'col-lg-3 col-md-3'],
            ],
            'title',
            // 'body:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1' ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
