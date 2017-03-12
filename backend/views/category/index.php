<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ButtonDropdown;
use yii\widgets\Pjax;
use execut\widget\TreeView;
use yii\web\JsExpression;

$this->title = 'Дерево категорий';
$this->params['breadcrumbs'][] = $this->title;
$label = 'Фильтр по каталогам';
$class = '';
if ($catalogue)
    foreach ($filter_items as $item)
        if ($item['id'] == $catalogue->id) {
            $label = $item['label'];
            $class = 'selected';
        }
$onSelect = new JsExpression(<<<JS
function (ev, item) {
    console.log(item);
    console.log(ev);
}
JS
);
?>

<div class="category-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php Pjax::begin(['enablePushState' => true, 'enableReplaceState' => true]); ?>
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
    <?= TreeView::widget([
                'data' => $model->makeTree($dataProvider,
                    []),
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
    <?php Pjax::end(); ?>
</div>
