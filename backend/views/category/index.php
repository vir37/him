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
if ($catalogueId) {
    $url_params['catalogueId'] = $catalogueId;
    foreach ($filter_items as $item)
        if ($item['id'] == $catalogueId) {
            $label = $item['label'];
            $class = 'selected';
        }
}
$buttonsParams = !$categorySelected ? '#' : [ 'id' => $categorySelected ];
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
        $(this).attr('data-pjax', 1);
        $(this).attr('href', item.href + '/position?direction=up&id=' + item.id + '&catalogueId=' + $catalogueId);
    });
    $("#button-down-position").each(function(){
        $(this).removeAttr('disabled');
        $(this).attr('data-pjax', 1);
        $(this).attr('href', item.href + '/position?direction=down&id=' + item.id + '&catalogueId=' + $catalogueId);
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
                'data' => $model->makeTree($dataProvider, [ 'href' => Url::to(['/category'])], $categorySelected),
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
                    <?= Html::a('Добавить', array_merge(['create'], $url_params), [
                        'class' => 'btn btn-default',
                        'title' => 'Добавить новую категорию'
                    ]) ?>
                    <?= Html::a('Редактировать', $buttonsParams == '#' ? ['#'] : array_merge(['update'], $buttonsParams, $url_params), [
                        'class' => 'btn btn-default',
                        'data-pjax' => 0,
                        'disabled' => $buttonsParams == '#',
                        'id' => 'button-update',
                        'title' => 'Редактировать категорию'
                    ]) ?>
                    <?= Html::a('Удалить', $buttonsParams == '#' ? ['#'] : array_merge(['delete'], $buttonsParams, $url_params), [
                        'class' => 'btn btn-danger',
                        'data-confirm' => 'Вы действительно хотите удалить?',
                        'data-pjax' => 0,
                        'disabled' => $buttonsParams == '#',
                        'id' => 'button-delete',
                        'title' => 'Удалить категорию'
                    ]) ?>
                    <hr/>
                    <?= Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
                        $buttonsParams == '#' ? ['#'] : array_merge(['position', 'direction' => 'up'], $buttonsParams, $url_params),
                        [
                            'class' => 'btn btn-info',
                            'data-pjax' => $buttonsParams == '#' ? 0 : 1,
                            'disabled' => $buttonsParams == '#',
                            'id' => 'button-up-position',
                            'title' => 'Поднять вверх'
                    ]) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
                        $buttonsParams == '#' ? ['#'] : array_merge(['position', 'direction' => 'down'], $buttonsParams, $url_params),
                        [
                            'class' => 'btn btn-info',
                            'data-pjax' => $buttonsParams == '#' ? 0 : 1,
                            'disabled' => $buttonsParams == '#',
                            'id' => 'button-down-position',
                            'title' => 'Опустить вниз'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
