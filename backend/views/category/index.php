<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ButtonDropdown;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use execut\widget\TreeView;

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
        'data' => $model->makeTree($dataProvider),
        'header' => 'Дерево категорий',
        'size' => TreeView::SIZE_MIDDLE,
    ])?>
    <?php Pjax::end(); ?>
</div>
