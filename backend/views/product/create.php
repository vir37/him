<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = "Новый товар";
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => "Товары", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_tabs', [
        'mode' => 'create',
        'model' => $model,
        'imageUploader' => $imageUploader,
    ]) ?>
</div>
