<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Address */

$this->title = $model->makeAddress();
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Адреса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="address-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Выбрать', '#', ['class' => 'btn btn-primary btn-fancy', 'data' => [ 'selectable' => true, 'id' => $model->id ]] ) ?>
    </p>
    <div class="address-form col-lg-8 col-md-8">
    <?= Html::beginTag('fieldset', [ 'disabled' => true ]) ?>
        <?= $this->render('_form', [
            'model' => $model,
            'viewMode' => true,
        ]) ?>
    <?= Html::endTag('fieldset') ?>
    </div>
</div>
