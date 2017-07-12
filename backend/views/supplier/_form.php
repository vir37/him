<?php

use frontend\assets\FancyboxAsset;
use yii\helpers\Html,
    yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView,
    yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
FancyboxAsset::register($this);
$dataProvider = new ActiveDataProvider();

$img = strlen($model->logo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($model->logo) : '/icons/no_logo.png';
$img = Html::img($img, [ 'style' => 'width: 150px; margin-bottom: 10px; ', 'alt' => 'NO PHOTO', ]);

function renderAddressField($address, $model) {
    if ($model->isNewRecord)
        $value = '';
    else {
        switch($address) {
            case 'jur_address':
                $value = $model->jurAddress ? $model->jurAddress->makeAddress(): '';
                break;
            case 'fact_address':
                $value = $model->factAddress ? $model->factAddress->makeAddress(): '';
                break;
            case 'post_address':
                $value = $model->postAddress ? $model->postAddress->makeAddress(): '';
                break;
            default:
                $value = '';
        }
    }
    return '<input type="text" disabled="disabled" class="form-control" value="'.$value.'">';
}
function toLink($data, $proto) {
    if (!$data)
        return '...';
    $result = [];
    foreach (explode(',', $data) as $elem){
        $result[] = Html::a(trim($elem), $proto.':'.trim($elem));
    }
    return implode(', ', $result);
}

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
                'template' => '{label}{beginWrapper}'.renderAddressField('jur_address', $model).'{input}{error}{hint}{endWrapper}'.
                        Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address' ], [
                            'class' => 'btn btn-default _fancybox address-select',
                            'id' => 'supplier-jur-address-select',
                            'data' => [ 'base_url' => Url::to(['/address']), 'callback' => 'procAddress', 'pjax' => 0 ],
                        ]).
                        Html::a('<span class="glyphicon glyphicon-remove"></span>', '#', [
                            'class' => 'btn btn-default address-remove',
                            'data' => [ 'pjax' => 0 ],
                        ]),
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->hiddenInput() ?>

            <?= $form->field($model, 'fact_address_id', [
                'template' => '{label}{beginWrapper}'.renderAddressField('fact_address', $model).'{input}{error}{hint}{endWrapper}'.
                        Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address' ], [
                            'class' => 'btn btn-default _fancybox address-select',
                            'id' => 'supplier-fact-address-select',
                            'data' => [ 'base_url' => Url::to(['/address']), 'callback' => 'procAddress', 'pjax' => 0 ],
                        ]).
                        Html::a('<span class="glyphicon glyphicon-remove"></span>', '#', [
                            'class' => 'btn btn-default address-remove',
                            'data' => [ 'pjax' => 0 ],
                        ]),
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->hiddenInput() ?>

            <?= $form->field($model, 'post_address_id', [
                'template' => '{label}{beginWrapper}'.renderAddressField('post_address', $model).'{input}{error}{hint}{endWrapper}'.
                          Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/address' ], [
                              'class' => 'btn btn-default _fancybox address-select',
                              'id' => 'supplier-post-address-select',
                              'data' => [ 'base_url' => Url::to(['/address']), 'callback' => 'procAddress', 'pjax' => 0 ],
                          ]).
                          Html::a('<span class="glyphicon glyphicon-remove"></span>', '#', [
                              'class' => 'btn btn-default address-remove',
                              'data' => [ 'pjax' => 0 ],
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
        <div class="delimiter2"></div>
        <div class="contacts">
            <?php Pjax::begin(['id'=>'pjax-container', 'timeout' => 6000, 'enableReplaceState' => false, 'enablePushState' => false ]); ?>
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span><span class="label label-default">Добавить</span>', [ '/contact' ], [
                'class' => 'btn _fancybox contact-select'. ($model->isNewRecord ? ' hidden': ''),
                'style' => 'float: right;',
                'title' => 'Добавить новый контакт',
                'data' => [ 'callback' => 'addContact', 'pjax' => 0, 'model_id' => $model->id ],
            ]) ?>
            <h4 style="text-align: center; padding-bottom: 2rem; padding-top: 2rem;">Список контактов</h4>
            <?php
            $dataProvider->query = $model->getContact();
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'pager' => false,
                'itemView' => '_contact_view',
                'viewParams' => [ 'supplier' => $model ],
                'emptyText' => false,
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
        <?php if (!isset($viewMode) or !$viewMode): ?>
        <div class="panel-footer">
            <?= Html::submitButton( 'Сохранить', ['class' => 'btn btn-primary', 'name' => 'save']) ?>
            <?= Html::submitButton( 'Сохранить и остаться', ['class' => 'btn btn-primary', 'name' => 'save_n_stay']) ?>
        </div>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    var editClicker;

    function addContact(elem, clicker) {
        var contact_id = $(elem).data('id'),
            id = $(clicker).data('model_id');
        $.ajax(baseUrl + '/supplier/link-contact', {
            data: {id: id, contact_id: contact_id},
            success: function (data, status, request) {
                $.pjax.reload('#pjax-container')
            },
            error: function (response, status, throw_obj) {
                alert(status);
            }
        });
    }

    function removeContact(elem) {
        event.preventDefault();
        if (!confirm('Вы действительно хотите удалить запись?'))
            return false;
        $.ajax(elem.href, {
            success: function (data, status, request) {
                $.pjax.reload('#pjax-container', {replace: false, refresh: false})
            },
            error: function (response, status, throw_obj) {
                alert(status);
            }
        });
    }

    function procAddress(elem, clicker){
        var addr_id = $(elem).data('id'),
            base_url = $(clicker).data('base_url');
        $.ajax(base_url + '/get-full-address', {
            data: { id: addr_id },
            success: function(data, status, request) {
                var parent = $(clicker).closest('.form-group');
                parent.find('input[type=hidden]').val(addr_id);
                parent.find('input[disabled]').val(data);
            },
            error: function(request, status, throw_obj){
                alert(request);
            }
        });
    }

</script>