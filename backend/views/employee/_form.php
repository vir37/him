<?php
/* @var $this yii\web\View */
/* @var $model common\models\Employee */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html,
    yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\User;
$users = User::find()->all();
$img = strlen($model->photo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($model->photo) : '/images/no_photo.png';
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id', [
        'labelOptions' => [ 'class' => 'control-label col-lg-5 col-md-5'],
        //'inputTemplate' => '<div class="col-lg-7 col-md-7">{input}</div>',
//        'options' => [ 'class' => 'form-group col-lg-5 col-md-5'],
    ])->dropDownList( ArrayHelper::map($users, 'id', 'username'), [
        'id' => 'user_id',
        'disabled' => $model->user_id,
        'prompt' => '...',
        'options' => $model->user_id ? ["$model->user_id" => ["selected" => true]] : [],
    ])->label('Пользователь системы') ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->fileInput([ 'accept' => 'image/jpeg,image/png']) ?>
    <?= Html::img($img,[
        'style' => 'width: 150px',
        'alt' => 'NO PHOTO',
    ]) ?>

    <?= $form->field($model, 'post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_chief')->checkbox() ?>

    <?= $form->field($model, 'create_dt')->textInput(['disabled' => True]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
