<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$phone = \Yii::$app->params['phone'];
$city = \Yii::$app->params['city'];
if (Yii::$app->request->isAjax)
    $action = \yii\helpers\Url::to(['site/contact', 'city' =>$city->uri_name, "isAjax" => true ]);
else
    $action = '';

?>
<div class="site-contact row">
    <div class="col-lg-12 col-md-12 panel panel-primary">
    <div class="panel-body">
        <h4>Позвоните нам</h4>
        <div class="form-group" style="text-align: center; ">
            <label for="phone" style="margin-right: 2em;">по телефону:</label>
            <?= Html::a($phone, "tel:$phone", [
                'class' => 'phone btn btn-default',
                'name' => 'phone',
                'onclick' => '$.fancybox.close();',
            ]) ?>
        </div>
        <div class="row" style="margin-top: 1em; margin-bottom: 1em;">
            <div class="col-lg-5 delim"></div>
            <div class="col-lg-2"><p>ИЛИ</p></div>
            <div class="col-lg-5 delim"></div>
        </div>
        <h4>Отправьте заявку, и мы обязательно с вами свяжемся</h4>
        <div class="">
            <?php $form = ActiveForm::begin([ 'id' => 'contact-form', 'layout' => 'horizontal' ]); ?>
                <?= $form->field($model, 'email', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'inputOptions' => [ 'class' => 'form-control' ],
                    'options' => [ 'class' => 'form-group' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ])->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'phone', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'inputOptions' => [ 'class' => 'form-control' ],
                    'options' => [ 'class' => 'form-group' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ]) ?>
                <?= $form->field($model, 'body', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'inputOptions' => [ 'class' => ' form-control' ],
                    'options' => [ 'class' => 'form-group' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ])->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode', [
                    'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                    'options' => [ 'class' => 'form-group' ],
                    'inputOptions' => [ 'class' => 'col-lg-12 col-md-12' ],
                    'labelOptions' => [ 'class' => 'col-lg-3 col-md-4'],
                    'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-8' ],
                ])->widget(Captcha::className(), [
                    'captchaAction' => [ 'site/captcha', 'city' => $city->uri_name ],
//                    'imageOptions' => [ 'class' => 'col-lg-6 col-md-6'],
                    'options' => [ 'class' => 'form-control' ],
                    'template' => '<div class="col-lg-6 col-md-6">{image}</div><div class="col-lg-6 col-md-6 ">{input}</div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div></div>
</div>
<?php
    if (Yii::$app->request->isAjax) {

    }
?>
