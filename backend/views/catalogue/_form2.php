<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Catalogue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalogue-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-4 col-md-3 col-lg-2',
                'wrapper' => 'col-sm-8 col-md-7 col-lg-6',
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить',
            ['class' => $model->isNewRecord ? 'btn btn-success col-sm-offset-10 col-md-offset-9 col-lg-offset-7' : 'btn btn-primary col-sm-offset-10 col-md-offset-9 col-lg-offset-7']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
