<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Warehouse */

$this->title = 'Редактирование: ' . $model->supplier->name .' - склад ID '. $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->supplier->name .' - склад ID '. $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Правка';
?>
<div class="warehouse-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
