<?php

use frontend\assets\FancyboxAsset;
use yii\helpers\Html, yii\helpers\Url;
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
                        Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address' ], [
                            'class' => 'btn btn-default fancybox address-select',
                            'data' => [ 'base_url' => Url::to(['/address']) ],
                        ]).
                        Html::a('<span class="glyphicon glyphicon-remove"></span>', '#', [
                            'class' => 'btn btn-default address-remove',
                        ]),
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->hiddenInput() ?>

            <?= $form->field($model, 'fact_address_id', [
                'template' => '{label}{beginWrapper}<input type="text" disabled="disabled" class="form-control">{input}{error}{hint}{endWrapper}'.
                        Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address' ], [
                            'class' => 'btn btn-default fancybox address-select',
                            'data' => [ 'base_url' => Url::to(['/address']) ],
                        ]).
                        Html::a('<span class="glyphicon glyphicon-remove"></span>', '#', [
                            'class' => 'btn btn-default address-remove',
                        ]),
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->hiddenInput() ?>

            <?= $form->field($model, 'post_address_id', [
                'template' => '{label}{beginWrapper}<input type="text" disabled="disabled" class="form-control">{input}{error}{hint}{endWrapper}'.
                          Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address' ], [
                              'class' => 'btn btn-default fancybox address-select',
                              'data' => [ 'base_url' => Url::to(['/address']) ],
                          ]).
                          Html::a('<span class="glyphicon glyphicon-remove"></span>', '#', [
                              'class' => 'btn btn-default address-remove',
                          ]),
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
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
    var editClicker;
    window.addEventListener('load', function(){
        $('#inn').mask('9999999999?99', { placeholder: 'X'});
        $('#ogrn').mask('9999999999999', { placeholder: 'X'});
        $('.address-select').on('click', function(event){
            var addr_id = $(this).closest('.form-group').find('input[type=hidden]').val(),
                base_url = $(this).data('base_url');
            if (addr_id != '') {
                this.href = base_url + '/update?id='+addr_id;
            } else {
                this.href = base_url;
            }
        });
        $('.fancybox').fancybox({
            type: 'iframe',
            beforeLoad: function() {
                Cookies.set('fancybox', 1, { expires: 1 })
                editClicker = this.element[0];
            },
            beforeShow: function(){
                this.width = $('.container').width();
                //this.height = $('.container').height();
            },
            beforeClose: function(){
                Cookies.remove('fancybox');
            }
        });
        /* Обработка нажатия на ссылки, позволяющие сделать выбор */
        $(document).on('fancy:click', 'body', function(event, elem){
            if ($(elem).data('selectable')) {
                var addr_id = $(elem).data('id'),
                    base_url = $(editClicker).data('base_url');;
                $.fancybox.close();
                $.ajax(base_url + '/get-full-address', {
                    data: { id: addr_id },
                    success: function(data, status, request) {
                        var parent = $(editClicker).closest('.form-group');
                        parent.find('input[type=hidden]').val(addr_id);
                        parent.find('input[disabled]').val(data);
                    },
                    error: function(request, status, throw_obj){
                        alert(request);
                    },
                    complete: function(){
                        editClicker = undefined;
                    }
                })
            }
        });
        $('.address-remove').on('click', function(event){
            event.preventDefault();
            $(this).closest('.form-group').find('.form-control').val('');
        });
    });

</script>