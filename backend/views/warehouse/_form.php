<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Warehouse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_dt')->textInput() ?>

    <?= $form->field($model, 'update_dt')->textInput() ?>

    <?= $form->field($model, 'supplier_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
