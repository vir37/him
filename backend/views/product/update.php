<?php

use yii\helpers\Html;
use yii\bootstrap\Carousel;
/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Редактирование товара: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_tabs', [
        'mode' => 'update',
        'model' => $model,
        'imageUploader' => $imageUploader,
    ]) ?>
</div>
