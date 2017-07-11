<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin([
    'layout' => 'inline',
    'fieldConfig' => [
        'enableError' => true,
        'labelOptions' => [ 'class' => 'control-label' ],
    ],
]); ?>
    <div class="panel panel-default">
        <div class="panel-body">

            <?php //= $form->field($model, 'create_dt')->textInput() ?>

            <?php //= $form->field($model, 'update_dt')->textInput() ?>

            <?= $form->field($model, 'FIO', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-10 col-md-10'],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phones', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'телефоны' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-10 col-md-10'],
            ])->textInput(['maxlength' => true])->label('<span class="glyphicon glyphicon-phone-alt"></span>') ?>

            <?= $form->field($model, 'emails', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'адреса электронной почты' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-10 col-md-10'],
            ])->textInput(['maxlength' => true])->label('<span class="glyphicon glyphicon-envelope"></span>') ?>
        </div>
        <?php if (!isset($viewMode) || !$viewMode): ?>
        <div class="panel-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success' ]) ?>
        </div>
        <?php endif; ?>
    </div>
<?php ActiveForm::end(); ?>

