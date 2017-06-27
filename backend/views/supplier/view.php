<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Supplier */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => "Поставщики", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= Html::beginTag('fieldset', [ 'disabled' => true ]) ?>
        <?= $this->render('_tabs', [
            'model' => $model,
            'viewMode' => true,
        ]) ?>
    <?= Html::endTag('fieldset') ?>

</div>
