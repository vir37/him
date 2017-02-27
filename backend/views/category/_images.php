<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.02.2017
 * Time: 22:44
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\bootstrap\Alert;
?>

<?php $form = ActiveForm::begin([
    'action' => 'image-upload',
    'options' => [
        'enctype' => 'multipart/form-data',
        'data-pjax' => 1,
    ],
    'layout' => 'inline',
    'fieldConfig' => [
        'labelOptions' => [ 'class' => 'control-label' ],
    ]])
?>
    <div class="row">
        <?= $form->field($model, 'objectId', ['template' => '{input}'])->hiddenInput()->label(False) ?>
        <?= $form->field($model, 'imageFile', [
            'labelOptions' => [ 'class' => 'control-label col-lg-5 col-md-5' ],
            'options' => [ 'class' => 'form-group col-lg-6 col-md-6 col-sm-6'],
        ])->fileInput([
            'disabled' => $linkModel->id ? false: true,
            'class' => 'btn btn-default'
        ])->label('Файл с изображением')
        ?>
        <?= $form->field($model, 'isMain', [
            'options' => [ 'class' => 'col-lg-3 col-md-3 col-sm-3' ],
        ])->checkbox()?>
        <?= Html::submitButton('<span class="glyphicon glyphicon-save"></span>', [
            'class' => 'btn btn-primary col-lg-offset-2 col-md-offset-2',
            'disabled' => $linkModel->id ? false: true,
        ])?>
    </div>
<?php
    if (isset($alert)) {
        echo Alert::widget([
            'options' => [
                'class' => "alert-{$alert['type']}",
            ],
            'body' => $alert['body'],
        ]);
    }
?>
<?php ActiveForm::end() ?>