<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use bizley\quill\Quill;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */

if (is_array($model->catalogue))
    $catalogueList = ArrayHelper::map($model->catalogue, 'id', 'name');
else
    $catalogueList = ArrayHelper::map([$model->catalogue], 'id', 'name');
$img = strlen($model->icon) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($model->icon) : '/icons/no_image.png';
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
                ])->dropDownList( $catalogueList, [
                    'id' => 'catalogue_select',
                    'disabled' => $model->catalogue_id,
                    'data-target' => '#parent_category',   // Целевой контейнер, который будет заполняться списком категорий
                    'prompt' => '...',
                    'options' => $model->catalogue_id ? ["$model->catalogue_id" => ["selected" => true]] : [],
                ])->label('Каталог') ?>
                <i class="fa fa-spinner fa-spin fa-2x fa-fw loader-hide" style="position: absolute;"></i>
                <?= $form->field($model, 'parent_id', [
                    'labelOptions' => ['class' => 'control-label col-lg-4 col-md-5'],
                    'inputTemplate' => '<div class="col-lg-6 col-md-5">{input}</div>',
                    'options' => ['class' => 'form-group col-lg-7 col-md-7'],
                ])->dropDownList( ArrayHelper::map($model::find()->
                                    where(['catalogue_id' => $model->catalogue_id])->
                                    andWhere(['not', ['id' => $model->id]])->all(), 'id', 'name'), [
                    'prompt' => '...',
                    'id' => 'parent_category'
                ]) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'description', [
                    'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                    'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2' ],
                    'inputTemplate' => '<div class="col-lg-9 col-md-9">{input}</div>',
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
            <div class="row">
                <div class="form-group col-lg-12 col-md-12">
                    <?= Html::label('Иконка', null, [ 'class' => 'control-label col-lg-2 col-md-2' ]) ?>
                    <div class="col-lg-3 col-md-3">
                        <?= Html::img($img,[
                            'style' => 'width: 150px',
                            'alt' => 'NO PHOTO',
                        ]) ?>
                    </div>
                    <?= $form->field($model, 'icon', [
                        'options' => [ 'class' => 'col-lg-3 col-md-3'],
                    ])->fileInput([ 'accept' => 'image/jpeg,image/png'])->label(false) ?>
                </div>
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
