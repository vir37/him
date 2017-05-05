<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$phone = \Yii::$app->params['phone'];
$city = \Yii::$app->params['city'];
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <p>Позвоните нам</p>
        <div class="col-lg-5 col-md-5">
            <label for="phone">по телефону: </label>
            <?= Html::a($phone, "tel:$phone", [ 'class' => 'phone btn btn-default', 'name' => 'phone']) ?>
        </div>
    </div>
    <div class="row" style="margin-top: 1em; margin-bottom: 1em;">
        <div class="col-lg-2 delim"></div>
        <div class="col-lg-1"><p>ИЛИ</p></div>
        <div class="col-lg-2 delim"></div>
    </div>
    <div class="row">
        <p>Отправьте заявку, и мы обязательно с вами свяжемся</p>
        <div class="col-lg-5 col-md-5">
            <?php $form = ActiveForm::begin([ 'id' => 'contact-form', 'layout' => 'inline' ]); ?>
                <div class="row">
                <?= $form->field($model, 'name', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'inputOptions' => [ 'class' => 'col-lg-12 col-md-12 form-control' ],
                    'errorOptions' => [ 'class' => 'col-lg-12 col-md-12'],
                    'options' => [ 'class' => 'col-lg-12 col-md-12' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ])->textInput(['autofocus' => true]) ?>
                </div>
                <div class="row">
                <?= $form->field($model, 'email', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'inputOptions' => [ 'class' => 'col-lg-12 col-md-12 form-control' ],
                    'options' => [ 'class' => 'col-lg-12 col-md-12' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ]) ?>
                </div>
                <div class="row">
                <?= $form->field($model, 'subject', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'inputOptions' => [ 'class' => 'col-lg-12 col-md-12 form-control' ],
                    'options' => [ 'class' => 'col-lg-12 col-md-12' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ]) ?>
                </div>
                <div class="row">
                <?= $form->field($model, 'body', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'inputOptions' => [ 'class' => ' form-control col-lg-12 col-md-12' ],
                    'options' => [ 'class' => 'col-lg-12 col-md-12' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ])->textarea(['rows' => 6]) ?>
                </div>
                <div class="row">
                <?= $form->field($model, 'verifyCode', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'options' => [ 'class' => 'col-lg-12 col-md-12' ],
                    'inputOptions' => [ 'class' => 'col-lg-12 col-md-12' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ])->widget(Captcha::className(), [
                    'captchaAction' => [ 'site/captcha', 'city' => $city->uri_name ],
//                    'imageOptions' => [ 'class' => 'col-lg-6 col-md-6'],
                    'options' => [ 'class' => 'col-lg-6 col-md-6 form-control' ],
                    'template' => '<div class="col-lg-6 col-md-6">{image}</div>{input}',
                ]) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
