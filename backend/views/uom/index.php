<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
if (isset($model)) {
    if ($model->id) {
        $this->title = $model->name;
        $this->params['breadcrumbs'][] = ['label' => 'Единицы измерения', 'url' => ['uom/']];
    } else {
        $this->title = Yii::t('app', 'Новая единица измерения');
        $this->params['breadcrumbs'][] = ['label' => 'Единицы измерения', 'url' => ['uom/']];
    };
} else
    $this->title = Yii::t('app', 'Единицы измерения');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uom-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (!isset($model)): ?>
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create'], [
            'class' => 'btn btn-success',
            'title' => 'Новая единица измерения'
        ]) ?>
    </p>
    <?php endif; ?>
<?php Pjax::begin(); ?>
    <?php if (isset($model)): ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <?= GridView::widget([
            'summary' => 'Показано {begin}-{end} из {totalCount}',
            'options' => [ 'class' => 'col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'headerOptions' => ['class' => 'col-lg-1 col-md-1'],
                ],
//                'id',
                [
                    'attribute' => 'short_name',
                    'headerOptions' => ['class' => 'col-lg-3 col-md-3'],
                    'label' => 'Краткое наименование',
                ],
                [
                    'attribute' => 'name',
                    'headerOptions' => ['class' => 'col-lg-7 col-md-7'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}  {delete}',
                ],
            ],
        ]); ?>
    </div>
<?php Pjax::end(); ?></div>
