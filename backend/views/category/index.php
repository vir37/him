<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ButtonDropdown;

$this->title = 'Список категорий';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= ButtonDropdown::widget([
                'label' => 'Фильтр по каталогам',
                'dropdown' => [
                    'items' => $filter_items,
                ],
                'options' => [ 'class' => 'btn-default' ],
                'split' => true,
            ])?>
        </div>
    </div>

    <p>
        You may change the content of this page by modifying
        the file <code><?= __FILE__; ?></code>.
    </p>
</div>