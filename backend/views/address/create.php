<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Address */

$this->title = 'Новый адрес';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Адреса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="address-form col-lg-8 col-md-8">
        <?= $this->render('_form', [ 'model' => $model, ]) ?>
    </div>
</div>
