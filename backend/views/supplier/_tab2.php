<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09.07.2017
 * Time: 17:30
 */
use yii\widgets\Pjax;
use yii\helpers\Html,
    yii\helpers\Url;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$dataProvider = new ActiveDataProvider();
$dataProvider->query = $model->getWarehouse();
?>
<?php Pjax::begin([ 'id'=>'pjax-container-tab2', 'timeout' => 6000, 'enableReplaceState' => false, 'enablePushState' => false ]) ?>
<div class="panel panel-default">
    <div class="panel-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'options' => ['class' => 'warehouse-list col-lg-12 col-md-12'],
            'columns' => [
                [
                    //'headerOptions' => [ 'class' => 'col-lg-1 col-md-1'],
                    'class' => 'yii\grid\SerialColumn',
                ],
                [
                    'headerOptions' => [ 'class' => 'col-lg-7 col-md-7'],
                    'header' => 'Адрес и контакты',
                    'content' => function($model, $key, $index, $column) {
                        $result = $model->address ? '<p><strong>'.$model->address->makeAddress().'</strong></p>': '';
                        foreach ($model->contact as $contact) {
                            $result .= '<address>'.$contact->FIO.':
                            <span class="glyphicon glyphicon-phone-alt">&nbsp;'. toLink($contact->phones, 'tel').'</span>
                            <span class="glyphicon glyphicon-envelope">&nbsp;'. toLink($contact->emails, 'mailto').'</span></address>';
                        }
                        return $result;
                    },
                ],
                [
                    'headerOptions' => [ 'class' => 'col-lg-2 col-md-2' ],
                    'header' => 'Режим работы',
                    'content' => function($model, $key, $index, $column){ return $model->work_hours; },
                ],
                [
                    'headerOptions' => [ 'class' => 'col-lg-2 col-md-2' ],
                    'header' => 'Примечание',
                    'contentOptions' => [ 'style' => 'position:relative;' ],
                    'content' => function($model, $key, $index, $column){
                        if (\yii\helpers\StringHelper::countWords($model->note) > 3) {
                            $str = \yii\helpers\StringHelper::truncateWords($model->note, 3);
                            return Html::a($str, '#note-'.$key).Html::tag('div',
                                $model->note.'<a href="#close" class="btn-close" title="Закрыть">&#10006;</a>',
                                [
                                    'id' => 'note-'.$key,
                                    'class' => 'note'
                                ]);
                        }
                        return $model->note;
                    },
                ],
                [
                    'class' => \yii\grid\Column::className(),
                    'header' => 'Действия',
                    'headerOptions' => [ 'class' => 'col-lg-1 col-md-1'],
                    'content' => function($model, $key, $index, $column){
                        $update = Html::a('<span class="glyphicon glyphicon-pencil"></span>', [ '/warehouse/update', 'id'=>$key], [
                                'title' => 'Редактировать склад',
                                'class' => '_fancybox',
                                'data' => [ 'pjax' => 0, 'callback' => 'refreshWarehouses' ],
                            ]);
                        $delete = Html::a('<span class="glyphicon glyphicon-trash"></span>', [ '/warehouse/delete', 'id'=>$key], [
                                'title' => 'Удалить склад',
                                'data' => [ 'pjax' => 0, ],
                                'onclick' => 'deleteWarehouse(this);',
                            ]);
                        return "$update&nbsp;&nbsp;$delete";
                    },
                ],
                /*
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'controller' => 'warehouse',
                    'template' => '{update}&nbsp;&nbsp;{delete}',
                    'header' => 'Действия',
                    'headerOptions' => [ 'class' => 'col-lg-1 col-md-1'],
                    'contentOptions' => [ 'class' => 'action'],
                    'buttons' => [
                        'delete' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                [ 'warehouse/delete', 'id'=>$key], [
                                    'title' => 'Удалить склад',
                                    'data' => [ 'pjax' => 0, ],
                                    'onclick' => 'deleteWarehouse(this);',
                                ]);
                        },
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                Url::to([ 'warehouse/update', 'id'=>$key]), [
                                    'title' => 'Редактировать склад',
                                    'class' => '_fancybox fancybox.ajax',
                                    'data' => [
                                        'pjax' => 0,
                                        'callback' => 'refreshWarehouses'
                                    ],
                                ]);
                        },
                    ],
                ],*/
            ],
        ]) ?>
    </div>
    <div class="panel-footer">
        <?= Html::a('Добавить новый', ['warehouse/create', 'supplier_id' => $model->id ], [
            'class' => 'btn btn-default _fancybox warehouse-select',
            'data' => [ 'callback' => 'refreshWarehouses' ],
        ])?>
    </div>
</div>
<div class="modalWindow">
    <a href="#" class="btn-close" title="Закрыть">X</a>
    <div class="modalContent">
    </div>
</div>
<?php Pjax::end() ?>
<script type="text/javascript">
    function refreshWarehouses(){
        event.preventDefault();
        event.stopImmediatePropagation();
        $.pjax.reload('#pjax-container-tab2', { replace: false, refresh: false });
    }
    function deleteWarehouse(elem){
        event.preventDefault();
        if (!confirm('Вы действительно хотите удалить запись?'))
            return false;
        $.ajax(elem.href, {
            method: 'POST',
            success: function (data, status, request) {
                $.pjax.reload('#pjax-container-tab2', { replace: false, refresh: false })
            },
            error: function (response, status, throw_obj) {
                alert(status);
            }
        });
    }
</script>