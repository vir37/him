<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Manufacturer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$img = strlen($model->logo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($model->logo) : '/images/no_logo.png';
?>
<div class="manufacturer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'web_site',
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'value' => Html::img( $img, [ 'style' => 'width: 150px', 'alt' => 'NO PHOTO',])
            ],
        ],
    ]) ?>

</div>
