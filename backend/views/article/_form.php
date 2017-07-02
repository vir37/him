<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use bizley\quill\Quill;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
if (!isset($viewMode))
    $viewMode = false;
?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'fieldConfig' => [
            'enableError' => true,
            'labelOptions' => [ 'class' => 'control-label' ],
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-body">

            <?= $form->field($model, 'create_dt', [
                'template' => '{label}{beginWrapper}<p class="form-control">'.$model->create_dt.'</p>{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-4 col-md-4'],
                'labelOptions' => [ 'class' => 'control-label col-lg-5 col-md-5'],
                'wrapperOptions' => [ 'class' => 'col-lg-7 col-md-7'],
            ]) ?>

            <?= $form->field($model, 'update_dt', [
                'template' => '{label}{beginWrapper}<p class="form-control">'.$model->update_dt.'</p>{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-5 col-md-5'],
                'labelOptions' => [ 'class' => 'control-label col-lg-5 col-md-5'],
                'wrapperOptions' => [ 'class' => 'col-lg-6 col-md-6'],
            ]) ?>

            <?= $form->field($model, 'name', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-10 col-md-10'],
                'labelOptions' => [ 'class' => 'control-label col-lg-3 col-md-3'],
                'wrapperOptions' => [ 'class' => 'col-lg-4 col-md-4'],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title',[
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'form-group col-lg-10 col-md-10'],
                'labelOptions' => [ 'class' => 'control-label col-lg-3 col-md-3'],
                'wrapperOptions' => [ 'class' => 'col-lg-9 col-md-9'],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'body', [
                'options' => [ 'class' => 'form-group col-lg-12 col-md-12'],
                'labelOptions' => [ 'class' => 'control-label col-lg-2 col-md-2' ],
                'inputTemplate' => '<div class="col-lg-10 col-md-10">{input}</div>',
            ])->widget(Quill::className(), [
                'modules' => [
                    'formula' => true,
                    'clipboard' => true,
                    'history' => true,
                ],
                'toolbarOptions' => [
                    [['font' => []], ['size' => ['small', false, 'large', 'huge']]],
                    ['code', 'code-block'],
                    [['script'=>'sub'],['script'=>'super']],
                    ['bold', 'italic', 'strike', 'underline'],
                    [['color' => []], ['background' => []]],
                    [['header' => [1,2,3,4,5,6,false]], 'blockquote' ],
                    [['indent' => '-1'], ['indent' => '+1'],
                        ['list' => 'ordered'], ['list' => 'bullet'], ['align' => []], ['direction'=>'rtl'],
                    ],
                    ['formula', 'image', 'video'],
                    ['clean']
                ]
            ])?>
        </div>
        <?php if (!isset($viewMode) or !$viewMode): ?>
        <div class="panel-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php endif; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    var afterLoad = function(){
        var viewMode = <?= $viewMode?>;
        if (viewMode && (typeof q_quill_1 !== 'undefined')) {
            q_quill_1.disable();
        }
    }
</script>
