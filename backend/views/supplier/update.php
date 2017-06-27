<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Supplier */

$this->title = 'Редактирование поставщика: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => "Поставщики", 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Правка';
?>
<div class="supplier-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_tabs', [
        'model' => $model,
    ]) ?>

</div>
