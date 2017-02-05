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
    'layout' => 'horizontal',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-lg-2 col-md-3 col-sm-4',
        ]
    ]])
?>
    <?= $form->field($model, 'objectId', ['template' => '{input}'])->hiddenInput()->label(False) ?>
    <?= $form->field($model, 'imageFile')->fileInput([
            'disabled' => $linkModel->id ? false: true,
            'class' => 'btn btn-default'
        ])->label('Файл с изображением')
    ?>
    <?= Html::submitButton('Загрузить', [
        'class' => 'btn btn-primary',
        'disabled' => $linkModel->id ? false: true,
    ])?>
<?php ActiveForm::end() ?>