<?php

use frontend\assets\FancyboxAsset;
use yii\helpers\Html,
    yii\helpers\ArrayHelper,
    yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\Supplier;
/* @var $this yii\web\View */
/* @var $model common\models\Warehouse */
/* @var $form yii\widgets\ActiveForm */
FancyboxAsset::register($this);
?>

<div class="warehouse-form col-lg-9 col-md-10">

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

            <?= $form->field($model, 'supplier_id', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'inputOptions' => [ 'class' => 'form-control', ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->dropDownList(ArrayHelper::map( Supplier::find()->all(), 'id', 'name'), [
               'prompt' => '...' ])->label('Поставщик') ?>

            <?= $form->field($model, 'address_id', [
                'template' => '{label}{beginWrapper}<input type="text" disabled="disabled" class="form-control" value="'.
                    ($model->address ? $model->address->makeAddress(): '').'">{input}{error}{hint}{endWrapper}'.
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
            ])->hiddenInput()->label('Адрес') ?>

            <?= $form->field($model, 'work_hours', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'inputOptions' => [ 'class' => 'form-control', 'placeholder' => 'режим работы' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-3 col-md-3'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'note', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
            ])->textarea(['rows' => 6]) ?>
        </div>
        <?php if (!isset($viewMode) or !$viewMode): ?>
        <div class="panel-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success'] ) ?>
        </div>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    var editClicker;
    window.addEventListener('load', function(){
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