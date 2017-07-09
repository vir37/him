<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Warehouse */

$this->title = $model->supplier->name .' - склад ID '. $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="warehouse-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Выбрать', '#', ['class' => 'btn btn-primary btn-fancy', 'data' => [ 'selectable' => true, 'id' => $model->id ]] ) ?>
    </p>

    <?= Html::beginTag('fieldset', [ 'disabled' => true ]) ?>
    <?= $this->render('_form', [
        'model' => $model,
        'viewMode' => true,
    ]) ?>
    <?= Html::endTag('fieldset') ?>
</div>
