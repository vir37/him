<?php

use yii\helpers\Html,
    yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use \common\models\Manufacturer;
use bizley\quill\Quill;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
if (!isset($viewMode))
    $viewMode = false;
?>

<div class="product-form">

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
                    'options' => [ 'class' => 'form-group col-lg-7 col-md-7'],
                    'labelOptions' => [ 'class' => 'control-label col-lg-3 col-md-3'],
                    'inputTemplate' => '<div class="col-lg-9 col-md-9">{input}</div>',
                ])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'manufacturer_id', [
                    'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
                    'inputTemplate' => '<div class="col-lg-8 col-md-8">{input}</div>',
                    'options' => [ 'class' => 'form-group col-lg-5 col-md-5'],
//                ])->dropDownList( ArrayHelper::map( $model->manufacturer ? [$model->manufacturer] : Manufacturer::find()->all(),
                ])->dropDownList( ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name'),
                    [
                        'id' => 'manufacturer_select',
//                        'disabled' => $model->manufacturer_id,
                        'prompt' => '...',
                        'options' => $model->manufacturer_id ? ["$model->manufacturer_id" => ["selected" => true]] : [],
                ])->label('Производитель') ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'description', [
                    'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                    'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                    'inputTemplate' => '<div class="col-lg-10 col-md-10">{input}</div>',
                ])->widget(Quill::className(), [
                    'modules' => [
                        'formula' => true,
                        'clipboard' => true,
                        'history' => true,
                    ],
                    'toolbarOptions' => [
                        [['font' => []], ['size' => ['small', false, 'large', 'huge']]],
                        ['code', 'code-block'],
                        [['script'=>'sub'],['script'=>'super']],
                        ['bold', 'italic', 'strike', 'underline'],
                        [['color' => []], ['background' => []]],
                        [['header' => [1,2,3,4,5,6,false]], 'blockquote' ],
                        [['indent' => '-1'], ['indent' => '+1'],
                            ['list' => 'ordered'], ['list' => 'bullet'], ['align' => []], ['direction'=>'rtl'],
                        ],
                        ['formula', 'image', 'video'],
                        ['clean']
                    ]
                ])?>
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
    <?php
        if (!isset($viewMode) || !$viewMode) {
               echo Html::beginTag('div', ['class' => 'form-group']);
                echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', [
                    'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                    'name' => $model->isNewRecord ? 'create' : 'save',
                ]);
                if ($model->isNewRecord)
                    echo Html::submitButton('Создать и остаться', ['class' => 'btn btn-primary', 'name' => 'create_n_stay']);
                echo Html::endTag('div');
            }
    ?>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    var afterLoad = function(){
        var viewMode = <?= $viewMode?>;
        if (viewMode && (typeof q_quill_1 !== 'undefined')) {
            q_quill_1.disable();
        }
    }
</script>
