<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18.06.2017
 * Time: 23:18
 */
use yii\bootstrap\Tabs;

?>
<?=
    Tabs::widget([
        'items' => [
            [
                'label' => 'Основная информация',
                'content' => $this->render('_tab1', [
                    'model' => $model,
                    'viewMode' => isset($viewMode) ? $viewMode : false,
                ]),
            ],
            [
                'label' => 'Склады',
                'linkOptions' => $model->isNewRecord ? [ 'disabled' => "disabled", 'onclick' => 'return isDisabled(this);' ] : [],
                'content' => $this->render('_tab2', [
                    'model' => $model,
                    'viewMode' => isset($viewMode) ? $viewMode : false,
                ]),
                'options' => [ 'class' => 'tab-pane tab-warehouse' ]
            ],
            [
                'label' => 'Товары и цены',
                'linkOptions' => $model->isNewRecord ? [ 'disabled' => "disabled", 'onclick' => 'return isDisabled(this);' ] : [],
            ]
        ],
    ])
?>
<script type="text/javascript">
    function afterLoad(){
        $(document).on('click', '.modalWindow a.btn-close', function(event){
            event.preventDefault();
            event.stopImmediatePropagation();
            $(this).closest('.modalWindow').hide().find('.modalContent').html('');
        });
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
        $('.address-remove').on('click', function(event){
            event.preventDefault();
            $(this).closest('.form-group').find('.form-control').val('');
        });
    }
</script>