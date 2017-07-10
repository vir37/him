<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Warehouse */

$this->title = 'Новый склад';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="warehouse-form col-lg-9 col-md-10">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
