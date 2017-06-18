<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WarehouseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_dt') ?>

    <?= $form->field($model, 'update_dt') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'address_id') ?>

    <?php // echo $form->field($model, 'work_hours') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
