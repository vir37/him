<?php

use frontend\assets\FancyboxAsset;
use yii\helpers\Html,
    yii\helpers\ArrayHelper,
    yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use common\models\Supplier;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $model common\models\Warehouse */
/* @var $form yii\widgets\ActiveForm */
FancyboxAsset::register($this);
$dataProvider = new ActiveDataProvider();

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

 <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'id' => 'warehouse-form',
        'fieldConfig' => [
            'enableError' => true,
            'labelOptions' => [ 'class' => 'control-label' ],
        ],
]); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $form->field($model, 'supplier_id', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12' ],
                'inputOptions' => [ 'class' => 'form-control', ],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2'],
                'wrapperOptions' => [ 'class' => 'col-lg-8 col-md-8'],
            ])->dropDownList(ArrayHelper::map( Supplier::find()->all(), 'id', 'name'), [
               'prompt' => '...' ])->label('Поставщик') ?>

            <?= $form->field($model, 'address_id', [
                'template' => '{label}{beginWrapper}<input type="text" disabled="disabled" class="form-control" id="addr-str" value="'.
                    ($model->address ? $model->address->makeAddress(): '').'">{input}{error}{hint}{endWrapper}'.
                    Html::a('<span class="glyphicon glyphicon-pencil"></span>', ($model->address ? [ 'address/update', 'id'=>$model->address->id] : [ '/address' ]), [
                        'class' => 'btn btn-default _fancybox address-select',
                        'id' => 'warehouse-address-select',
                        'data' => [ 'base_url' => Url::to(['/address']), 'callback' => 'procAddress', 'pjax' => 0 ],
                        'onclick' => 'changeHRef(this);',
                    ]).
                    Html::a('<span class="glyphicon glyphicon-remove"></span>', '#', [
                        'class' => 'btn btn-default address-remove',
                        'data' => [ 'pjax' => 0 ],
                        'onclick' => 'warehouseRemoveAddress(this);',
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
        <div class="delimiter2"></div>
        <div class="contacts">
            <?php Pjax::begin([
                'id'=>'warehouse-contacts-pc', 'timeout' => 6000,
                'enableReplaceState' => false, 'enablePushState' => false,
                'options' => [ 'data' => ['refresh-url' => Yii::$app->request->url ]],
            ]); ?>
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span><span class="label label-default">Добавить</span>', [ '/contact' ], [
                    'class' => 'btn _fancybox contact-select'. ($model->isNewRecord ? ' hidden': ''),
                    'id' => 'contact-select',
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
                    'viewParams' => [ 'warehouse' => $model ],
                    'emptyText' => false,
                ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
        <?php if (!isset($viewMode) or !$viewMode): ?>
        <div class="panel-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save'] ) ?>
            <?= Html::submitButton('Сохранить и остаться', ['class' => 'btn btn-primary', 'name' => 'save_n_stay' ] ) ?>
        </div>
        <?php endif; ?>
    </div>
<?php ActiveForm::end(); ?>
<script type="text/javascript">

    function procAddress(elem, clicker){
        var addr_id = $(elem).data('id'),
            base_url = $(clicker).data('base_url');
        $.ajax(base_url + '/get-full-address', {
            data: { id: addr_id },
            success: function(data, status, request) {
                var parent = $('#'+clicker.id).closest('.form-group');
                parent.find('input[type=hidden]').val(addr_id);
                parent.find('input[disabled]').val(data);
            },
            error: function(request, status, throw_obj){ alert(request); }
        });
    }

    function addContact(elem, clicker) {
        var contact_id = $(elem).data('id'),
            id = $(clicker).data('model_id');
        $.ajax(baseUrl + '/warehouse/link-contact', {
            data: {id: id, contact_id: contact_id},
            success: function (data, status, request) {
                warehouseRefrehPjax();
            },
            error: function (response, status, throw_obj) { alert(status); }
        });
    }

    function warehouseRefrehPjax() {
        var  href = $('#warehouse-contacts-pc').data('refresh-url');
        if (href == undefined)
            $.pjax.reload('#warehouse-contacts-pc', { replace: false, refresh: false });
        else
            $.pjax.reload('#warehouse-contacts-pc', { url: href, replace: false, refresh: false });
    }

    function removeContact(elem) {
        event.preventDefault();
        event.stopImmediatePropagation();
        if (!confirm('Вы действительно хотите удалить запись?'))
            return false;
        $.ajax(elem.href, {
            success: function (data, status, request) {
                warehouseRefrehPjax();
            },
            error: function (response, status, throw_obj) {
                alert(status);
            }
        });
    }

    function warehouseRemoveAddress(elem){
        event.preventDefault();
        event.stopImmediatePropagation();
        $(elem).closest('.form-group').find('.form-control').val('');
    }

    function changeHRef(elem) {
        var addr_id = $(elem).closest('.form-group').find('input[type=hidden]').val(),
            base_url = $(elem).data('base_url');
        if (addr_id != '') {
            elem.href = base_url + '/update?id=' + addr_id;
        } else {
            elem.href = base_url;
        }
    }
</script>