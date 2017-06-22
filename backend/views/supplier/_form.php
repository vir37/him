<?php

use frontend\assets\FancyboxAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
FancyboxAsset::register($this);

$img = strlen($model->logo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($model->logo) : '/icons/no_logo.png';
$img = Html::img($img, [ 'style' => 'width: 150px; margin-bottom: 10px; ', 'alt' => 'NO PHOTO', ]);
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
                'inputOptions' => [ 'class' => 'form-control', 'id' => 'inn'],
                'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'OGRN', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-3 col-md-3'],
                'inputOptions' => [ 'class' => 'form-control', 'id' => 'ogrn'],
                'labelOptions' => [ 'class' => 'control-label col-lg-4 col-md-4'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
            ])->textarea(['rows' => 6])->label('Описание') ?>

            <?= $form->field($model, 'jur_address_id', [
                'template' => '{label}{beginWrapper}<input type="text" disabled="disabled" class="form-control">{input}{error}{hint}{endWrapper}'.
                        Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address', 'fancybox' => true ], [
                            'class' => 'btn btn-default fancybox',
                        ]),
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
            ])->hiddenInput() ?>

            <?= $form->field($model, 'fact_address_id', [
                'template' => '{label}{beginWrapper}<input type="text" disabled="disabled" class="form-control">{input}{error}{hint}{endWrapper}'.
                        Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address', 'fancybox' => true ], [
                            'class' => 'btn btn-default fancybox',
                        ]),
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
            ])->hiddenInput() ?>

            <?= $form->field($model, 'post_address_id', [
                'template' => '{label}{beginWrapper}<input type="text" disabled="disabled" class="form-control">{input}{error}{hint}{endWrapper}'.
                          Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address', 'fancybox' => true ], [
                              'class' => 'btn btn-default fancybox',
                          ]),
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
            ])->hiddenInput() ?>

            <?= $form->field($model, 'logo', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}'.$img,
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-4 col-md-4'],
            ])->fileInput([ 'accept' => 'image/jpeg,image/png']) ?>

            <?= $form->field($model, 'phone', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-4 col-md-4' ],
                'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'Телефоны' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-10 col-md-10'],
            ])->textInput(['maxlength' => true])->label('<span class="glyphicon glyphicon-phone-alt"></span>') ?>

            <?= $form->field($model, 'email', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-4 col-md-4' ],
                'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'Email' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-10 col-md-10'],
            ])->textInput(['maxlength' => true])->label('<span class="glyphicon glyphicon-envelope"></span>') ?>

            <?= $form->field($model, 'site', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-4 col-md-4' ],
                'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'WEB-сайт' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-10 col-md-10'],
            ])->textInput(['maxlength' => true])->label('<span class="glyphicon glyphicon-globe"></span>') ?>

            <?= $form->field($model, 'note', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-10 col-md-10'],
            ])->textarea(['rows' => 3]) ?>

        </div>
        <div class="panel-footer">
            <?= Html::submitButton( 'Сохранить', ['class' => 'btn btn-primary', 'name' => 'save']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    window.addEventListener('load', function(){
        $('#inn').mask('9999999999?99', { placeholder: 'X'});
        $('#ogrn').mask('9999999999999', { placeholder: 'X'});
        $('.fancybox').fancybox({
            type: 'iframe',
            iframe: {headers:{"X-fancyBox": !0}},
            beforeLoad: function() { debugger; },
            beforeShow: function(){
                this.width = $('.container').width();
                //this.height = $('.container').height();
            }
        });
    });
</script>