<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductFeature */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-feature-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'feature_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_numeric')->textInput() ?>

    <?= $form->field($model, 'value_string')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upd_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
