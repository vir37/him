<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Catalogue */

$this->title = 'Редактирование каталога: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => 'Список каталогов', 'url' => ['catalogue/list']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="catalogue-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('_form2', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
