<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Feature */

$this->title = 'Редактирование характеристики: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="feature-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
