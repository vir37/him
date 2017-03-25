<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = $model->fio." ({$model->id})";
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$img = strlen($model->photo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($model->photo) : '/images/no_photo.png';

?>
<div class="employee-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'label' => 'Пользователь системы',
                'value' => $model->user_id ? $model->user->username : '',
            ],
            'fio',
            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => Html::img( $img, [
                        'style' => 'width: 150px',
                        'alt' => 'NO PHOTO',])
            ],
            'post',
            'email:email',
            [
                'attribute' => 'phone',
                'format' => 'raw',
                'value' => $model->phone ? Html::a($model->phone, "tel:{$model->phone}") : "",
            ],
            [
                'attribute' => 'is_chief',
                'format' => 'raw',
                'value' => Html::checkbox('is_chief', $model->is_chief, [ 'disabled' => true]),
            ],
            'create_dt',
        ],
    ]) ?>

</div>
