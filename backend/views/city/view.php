<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= Html::beginTag('fieldset', [ 'disabled' => true ]) ?>
        <?= $this->render('_form', [
            'model' => $model,
            'mode' => 'view',
        ]) ?>
    <?= Html::endTag('fieldset') ?>


</div>
