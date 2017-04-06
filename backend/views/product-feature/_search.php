<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductFeatureSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-feature-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'feature_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'value_numeric') ?>

    <?= $form->field($model, 'value_string') ?>

    <?php // echo $form->field($model, 'upd_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
