<?php

use yii\helpers\Html,
    yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model common\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form col-lg-8 col-md-8">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'fieldConfig' => [
            'enableError' => true,
            'labelOptions' => [ 'class' => 'sr-only' ],
        ],
    ]); ?>

    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row">
                <?= $form->field($model, 'region_id', [
                    'template' => '{label}{input}{error}{hint}',
                    'options' => [ 'class' => 'col-lg-8 col-md-8'],
                ])->dropDownList(ArrayHelper::map( Region::find()->all(), 'id', 'name'), [
                    'prompt' => 'выберите регион...' ])?>

                <?= $form->field($model, 'index', [
                    'template' => '{label}{input}{error}{hint}',
                    'options' => [ 'class' => 'col-lg-4 col-md-4'],
                    'inputOptions' => [ 'placeholder' => 'Индекс', 'id' => 'index'  ],
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'settlement', [
                    'template' => '{label}{input}{error}{hint}',
                    'options' => [ 'class' => 'col-lg-5 col-md-5'],
                    'inputOptions' => [ 'placeholder' => 'Населенный пункт', 'id' => 'settlement'  ],
                ])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'street', [
                    'template' => '{label}{input}{error}{hint}',
                    'options' => [ 'class' => 'col-lg-7 col-md-7' ],
                    'inputOptions' => [ 'placeholder' => 'Улица', 'id' => 'street' ],
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'house', [
                    'template' => '{label}{input}{error}{hint}',
                    'options' => [ 'class' => 'col-lg-3 col-md-3' ],
                    'inputOptions' => [ 'placeholder' => 'Дом', 'id' => 'house' ],
                ])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'corp', [
                    'template' => '{label}{input}{error}{hint}',
                    'options' => [ 'class' => 'col-lg-3 col-md-3' ],
                    'inputOptions' => [ 'placeholder' => 'Корп./Стр.', 'id' => 'corp' ],
                ])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'apartment', [
                    'template' => '{label}{input}{error}{hint}',
                    'options' => [ 'class' => 'col-lg-3 col-md-3' ],
                    'inputOptions' => [ 'placeholder' => 'Кв./Оф.', 'id' => 'apartment' ],
                ])->textInput() ?>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <?= Html::submitButton('Сохранить' , ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    window.addEventListener('load', function(){
        $('#index').mask('999999', { placeholder: 'X'});
    });
</script>