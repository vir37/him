<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index', 'catalogue_id' => $model->catalogue_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= Html::beginTag('fieldset', [ 'disabled' => true ]) ?>
        <?= $this->render('_form', [
            'model' => $model,
            'viewMode' => true,
        ]) ?>
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-image fa-2x" aria-hidden="true"></i>
                <h3 class="panel-title">Изображения категории</h3>
            </div>
            <div class="panel-body">
                <?= $this->render('/common/_images', [
                    'linkModel' => $model,
                ]) ?>
            </div>
        </div>
    <?= Html::endTag('fieldset') ?>
</div>
