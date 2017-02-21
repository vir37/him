<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.02.2017
 * Time: 22:44
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
    'action' => 'image-upload',
    'options' => ['enctype' => 'multipart/form-data'],
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
            'class' => 'btn btn-default col-lg-6 col-md-6'
        ])->label('Файл с изображением')
        ?>
        <?= $form->field($model, 'isMain')->checkbox()?>
    </div>
    <div class="row">
        <?= Html::submitButton('Загрузить', [
            'class' => 'btn btn-primary',
            'disabled' => $linkModel->id ? false: true,
        ])?>
    </div>
<?php ActiveForm::end() ?>