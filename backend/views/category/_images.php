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
use yii\bootstrap\Carousel;
?>

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
<?php ActiveForm::end() ?>
<hr/>
<div class="row">
<?php
    $items = [];
    foreach ($linkModel->images as $image) {
        $a_main = '<a href="#" class="btn btn-default" role="button" title="Назначить главной"><span class="glyphicon glyphicon-check"></span></a>';
        $a_del = '<a href="#" class="btn btn-default" role="button" title="Удалить"><span class="glyphicon glyphicon-remove"></span></a>';
        $items[] = [
            'content' => '<img src="/images/'.$image->name.'"/>',
            'caption' =>  $image->is_main ? '<p>Главная фотография</p>'.$a_del : $a_main.$a_del,
        ];
    }
    echo Carousel::widget([
        'items' => $items,
        'clientOptions' => [ 'interval' => false ],
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left"></span>',
            '<span class="glyphicon glyphicon-chevron-right"></span>',
        ],
    ]);
?>
</div>