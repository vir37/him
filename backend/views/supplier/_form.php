<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'fieldConfig' => [
            'enableError' => true,
            'labelOptions' => [ 'class' => 'control-label' ],
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php // $form->field($model, 'create_dt')->textInput() ?>
            <?php // $form->field($model, 'update_dt')->textInput() ?>

            <?= $form->field($model, 'name', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-5 col-md-5'],
                'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->textInput(['maxlength' => true])->label('Наименование') ?>

            <?= $form->field($model, 'INN', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-3 col-md-3'],
                'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'OGRN', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-3 col-md-3'],
                'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
            ])->textarea(['rows' => 6])->label('Описание') ?>

        <?= $form->field($model, 'jur_address_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'fact_address_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'post_address_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
