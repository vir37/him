<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => "Товары", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= $this->render('_tabs', [
        'mode' => 'view',
        'containerClass' => 'product-view',
        'model' => $model,
        'imageUploader' => null,
    ]) ?>
</div>
