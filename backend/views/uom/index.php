<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Единицы измерения');
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uom-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], [
            'class' => 'btn btn-success',
            'title' => 'Новая единица измерения'
        ]) ?>
    </p>
<?php Pjax::begin(); ?>
    <?php if (isset($model)): ?>
    <div class="row">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <?= GridView::widget([
            'options' => [ 'class' => 'col-lg-8 col-md-8'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'attribute' => 'short_name',

                ],
                'name',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
<?php Pjax::end(); ?></div>
