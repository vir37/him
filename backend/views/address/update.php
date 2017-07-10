<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Address */

$this->title = 'Редактирование адреса: ' . $model->makeAddress();
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Адреса', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="address-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="address-form col-lg-8 col-md-8">
        <?= $this->render('_form', [ 'model' => $model, ]) ?>
    </div>
</div>
