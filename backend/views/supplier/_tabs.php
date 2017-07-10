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
        $('._fancybox').fancybox( {
            minWidth: 100,
            autoSize: false,
            scrolling: 'no'
        });
    }
</script>