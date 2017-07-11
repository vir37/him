<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контактные лица';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h3><?= Html::encode($this->title) ?></h3>
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
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1' ],
            ],
            //'create_dt',
            //'update_dt',
            [
                'attribute' => 'FIO',
                'headerOptions' => [ 'class' => 'col-lg-5 col-md-5' ],
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->FIO, '#', [ 'data' => [ 'id' => $key, 'fancybox-finish' => true ]]);
                }
            ],
            [
                'attribute' => 'phones',
                'content' => function($model, $key, $index, $column) {
                    if (!$model->phones)
                        return '';
                    $result = [];
                    foreach (explode(',', $model->phones) as $phone){
                        $result[] = Html::a(trim($phone), 'tel:'.trim($phone), [ 'data' => [ 'fancybox-finish' => true ]]);
                    }
                    return implode(', ', $result);
                }
            ],
            [
                'attribute' => 'emails',
                'content' => function($model, $key, $index, $column) {
                    if (!$model->emails)
                        return '';
                    $result = [];
                    foreach (explode(',', $model->emails) as $email){
                        $result[] = Html::a(trim($email), 'mailto:'.trim($email), [ 'data' => [ 'fancybox-finish' => true ]]);
                    }
                    return implode(', ', $result);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => [ 'class' => 'col-lg-1 col-md-1' ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
