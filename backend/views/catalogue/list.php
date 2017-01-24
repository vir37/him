<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19.01.2017
 * Time: 0:12
 */
use yii\helpers\Html;
use yii\grid\GridView,
    yii\grid\ActionColumn;
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
    <?php Pjax::begin(); ?>   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'description',
            [
                'header' => 'Действия',
                'class' => ActionColumn::className(),
                'contentOptions' => [ 'style' => 'width: 1%;' ],
            ]
        ],
    ]) ?>
    <?php Pjax::end(); ?>
</div>