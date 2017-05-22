<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ButtonDropdown;
use yii\widgets\Pjax;
use execut\widget\TreeView;
use yii\web\JsExpression;
use yii\helpers\Url;

$this->title = 'Категории';
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = $this->title;
$label = 'Фильтр по каталогам';
$class = '';
$url_params = [];
if ($catalogue_id) {
    $url_params['catalogue_id'] = $catalogue_id;
    foreach ($filter_items as $item)
        if ($item['id'] == $catalogue_id) {
            $label = $item['label'];
            $class = 'selected';
        }
}
$onSelect = new JsExpression(<<<JS
function (ev, item) {
    $("#button-update").each(function(){
        $(this).removeAttr('disabled');
        $(this).attr('href', item.href + '/update?id=' + item.id);
    });
    $("#button-delete").each(function(){
        $(this).removeAttr('disabled');
        $(this).attr('href', item.href + '/delete?id=' + item.id);
    });
    $("#button-up-position").each(function(){
        $(this).removeAttr('disabled');
        $(this).attr('href', item.href + '/position?direction=up&id=' + item.id + '&catalogue_id=' + $catalogue_id);
    });
    $("#button-down-position").each(function(){
        $(this).removeAttr('disabled');
        $(this).attr('href', item.href + '/position?direction=down&id=' + item.id + '&catalogue_id=' + $catalogue_id);
    });
}
JS
);
?>

<div class="category-index">
    <h3>Дерево категорий</h3>
    <?php Pjax::begin(['enablePushState' => false, 'enableReplaceState' => false, 'timeout' => 6000]); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= ButtonDropdown::widget([
                'label' => $label,
                'containerOptions' => [ 'class' => "$class" ],
                'dropdown' => [
                    'items' => $filter_items,
                ],
                'options' => [ 'class' => "btn-default jquery-ui-disable" ],
                'split' => true,
                'id' => 'catalogue_filter',
            ])?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?= TreeView::widget([
                'data' => $model->makeTree($dataProvider, [ 'href' => Url::to(['/category'])]),
                'header' => 'Дерево категорий',
                'size' => TreeView::SIZE_MIDDLE,
                'clientOptions' => [
                    'onNodeSelected' => $onSelect,
                    'showBorder' => false,
                    'levels' => 1,
//                    'collapseIcon' => 'glyphicon glyphicon-folder-open',
//                    'expandIcon' => 'glyphicon glyphicon-folder-close',
                    'emptyIcon' => 'glyphicon glyphicon-tint',
                ],
            ])?>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <?= Html::a('Добавить', array_merge(['/category/create'], $url_params), [
                        'class' => 'btn btn-default',
                        'title' => 'Добавить новую категорию'
                    ]) ?>
                    <?= Html::a('Редактировать', ['#'], [
                        'class' => 'btn btn-default',
                        'disabled' => true,
                        'id' => 'button-update',
                        'title' => 'Редактировать категорию'
                    ]) ?>
                    <?= Html::a('Удалить', ['#'], [
                        'class' => 'btn btn-danger',
                        'data-confirm' => 'Вы действительно хотите удалить?',
                        'disabled' => true,
                        'id' => 'button-delete',
                        'title' => 'Удалить категорию'
                    ]) ?>
                    <hr/>
                    <?= Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['#'], [
                        'class' => 'btn btn-info',
                        'data-pjax' => 1,
                        'disabled' => true,
                        'id' => 'button-up-position',
                        'title' => 'Поднять вверх'
                    ]) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['#'], [
                        'class' => 'btn btn-info',
                        'data-pjax' => 1,
                        'disabled' => true,
                        'id' => 'button-down-position',
                        'title' => 'Опустить вниз'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
