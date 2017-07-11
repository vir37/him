<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = 'Редактирование: ' . $model->FIO;
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->FIO, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="contact-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="contact-form col-lg-7 col-md-8">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
