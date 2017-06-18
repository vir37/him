<?php

use yii\helpers\Html,
    yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model common\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row">
                <?= $form->field($model, 'region_id', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'options' => [ 'class' => 'col-lg-6 col-md-6' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-3'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
                ])->dropDownList(ArrayHelper::map( Region::find()->all(), 'id', 'name'), [
                    'prompt' => '...' ]) ?>

                <?= $form->field($model, 'uri_name', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'options' => [ 'class' => 'col-lg-3 col-md-3' ],
                    'labelOptions' => [ 'class' => 'col-lg-4 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
                ])->textInput(['maxlength' => true])->label('URL') ?>

            </div>
            <div class="row">
                <?= $form->field($model, 'name' ,[
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'options' => [ 'class' => 'col-lg-5 col-md-5' ],
                    'labelOptions' => [ 'class' => 'col-lg-4 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
                ])->textInput(['maxlength' => true])->label('Наименование') ?>

                <?= $form->field($model, 'name_pp' ,[
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'options' => [ 'class' => 'col-lg-7 col-md-7' ],
                    'labelOptions' => [ 'class' => 'col-lg-5 col-md-5'],
                    'wrapperOptions' => [ 'class' => 'col-lg-7 col-md-7'],
                ])->textInput(['maxlength' => true])->label('Наименование в РП (где?)') ?>

                <?= $form->field($model, 'index', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'options' => [ 'class' => 'col-lg-4 col-md-4' ],
                    'labelOptions' => [ 'class' => 'col-lg-6 col-md-6'],
                    'wrapperOptions' => [ 'class' => 'col-lg-6 col-md-6'],
                ])->textInput(['maxlength' => true]) ?>

                <div class="input-group col-lg-7 col-md-7">
                    <?= $form->field($model, 'latitude', [
                        'template' => '{input}',
                        //'options' => [ 'class' => 'col-lg-8 col-md-8' ],
                        //'labelOptions' => [ 'class' => 'col-lg-6 col-md-6'],
                    ])->textInput(['maxlength' => true])->label(false) ?>

                    <?= $form->field($model, 'longitude', [
                        'template' => '{input}',
                        //'options' => [ 'class' => 'col-lg-4 col-md-4' ],
                    ])->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <?= $form->field($model, 'fake_address', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'options' => [ 'class' => 'col-lg-12 col-md-12' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-3'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
                ])->textInput(['maxlength' => true]) ?>

            </div>
        </div>
        <?php if(!isset($mode) || $mode !== 'view'): ?>
            <div class="panel-footer">
                <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
