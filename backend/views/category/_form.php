<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'fieldConfig' => [
            'labelOptions' => [ 'class' => 'control-label', ],
        ]
    ]); ?>

    <?= $form->field($model, 'catalogue_id', [
            'labelOptions' => [ 'class' => 'control-label col-lg-3 col-md-3'],
            'inputTemplate' => '<div class="col-lg-8 col-md-8">{input}</div>',
            'options' => [ 'class' => 'col-lg-6 col-md-6'],
        ])->dropDownList( ArrayHelper::map($model->catalogue, 'id', 'name'),
            [
                'prompt' => '...',
                'options' => [ '2' => ['selected' => true]],
            ])->label('Каталог') ?>

    <?= $form->field($model, 'parent_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keys')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
