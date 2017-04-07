<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Uom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uom-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
    ]); ?>

    <?= $form->field($model, 'short_name', [
        'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
        'options' => [ 'class' => 'form-group col-lg-4 col-md-4'],
        'labelOptions' => [ 'class' => 'control-label col-lg-7 col-md-7'],
        'wrapperOptions' => [ 'class' => 'col-lg-5 col-md-5'],
    ])->textInput(['maxlength' => true,])->label('Краткое наименование') ?>

    <?= $form->field($model, 'name', [
        'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
        'options' => [ 'class' => 'form-group col-lg-7 col-md-7'],
        'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
        'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
    ])->textInput(['maxlength' => true])->label('Полное наименование') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
