<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.01.2017
 * Time: 0:12
 */
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CatalogueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список каталогов';
$this->params['breadcrumbs'][] = [ 'label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="catalogue-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Новый каталог', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>   <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
        },
    ]) ?>
    <?php Pjax::end(); ?>
</div>