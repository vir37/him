<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
$img = strlen($model->logo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($model->logo) : '/images/no_logo.png';
?>

<div class="manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->fileInput([ 'accept' => 'image/jpeg,image/png']) ?>
    <?= Html::img($img,[
        'style' => 'width: 150px',
        'alt' => 'NO PHOTO',
    ]) ?>

    <?= $form->field($model, 'web_site')->textInput([ 'style' => 'width: 50%;']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
