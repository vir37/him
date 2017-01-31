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
    <div class="panel panel-default">
        <div class="panel-heading" style="position:relative;"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
            <h3 class="panel-title">Основная информация</h3></div>
        <div class="panel-body">
            <div class="row">
                <?= $form->field($model, 'name', [
                    'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                    'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                    'inputTemplate' => '<div class="col-lg-9 col-md-9">{input}</div>',
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'catalogue_id', [
                    'labelOptions' => [ 'class' => 'control-label col-lg-5 col-md-5'],
                    'inputTemplate' => '<div class="col-lg-7 col-md-7">{input}</div>',
                    'options' => [ 'class' => 'form-group col-lg-5 col-md-5'],
                ])->dropDownList( ArrayHelper::map($model->catalogue, 'id', 'name'), [
                    'prompt' => '...',
                    'options' => [ '2' => ['selected' => true]],
                ])->label('Каталог') ?>

                <?= $form->field($model, 'parent_id', [
                    'labelOptions' => ['class' => 'control-label col-lg-4 col-md-5'],
                    'inputTemplate' => '<div class="col-lg-6 col-md-5">{input}</div>',
                    'options' => ['class' => 'form-group col-lg-7 col-md-7'],
                ])->dropDownList( ArrayHelper::map($model::find()->all(), 'id', 'name'), [
                    'prompt' => '...',
                ]) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'description', [
                    'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                    'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                    'inputTemplate' => '<div class="col-lg-9 col-md-9">{input}</div>',
                ])->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-edge fa-2x" aria-hidden="true"></i>
            <h3 class="panel-title">Поисковая оптимизаци (SEO)</h3></div>
        <div class="panel-body">
        <?= $form->field($model, 'meta_desc', [
            'options' => [ 'class' => 'form-group col-lg-6 col-md-6'],
            'labelOptions' => [ 'class' => 'control-label col-lg-3 col-md-3'],
            'inputTemplate' => '<div class="col-lg-9 col-md-9">{input}</div>',
        ])->textInput(['maxlength' => true])->label('Описание') ?>

        <?= $form->field($model, 'meta_keys', [
            'options' => [ 'class' => 'form-group col-lg-6 col-md-6'],
            'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
            'inputTemplate' => '<div class="col-lg-8 col-md-8">{input}</div>',
        ])->textInput(['maxlength' => true])->label('Ключевые слова') ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
