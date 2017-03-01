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
        <?= Html::beginTag('fieldset', [ 'disabled' => $linkModel->id ? false: true ]) ?>
            <?= $form->field($model, 'objectId', ['template' => '{input}'])->hiddenInput()->label(False) ?>
            <?= $form->field($model, 'imageFile', [
                'labelOptions' => [ 'class' => 'control-label col-lg-5 col-md-5' ],
                'options' => [ 'class' => 'form-group col-lg-6 col-md-6 col-sm-6'],
            ])->fileInput([
                'class' => 'btn btn-default'
            ])->label('Файл с изображением')
            ?>
            <?= $form->field($model, 'isMain', [ 'options' => [ 'class' => 'col-lg-3 col-md-3 col-sm-3' ] ])->checkbox()?>
            <?= Html::submitButton('<span class="glyphicon glyphicon-save"></span>', [
                'class' => 'btn btn-primary col-lg-offset-2 col-md-offset-2',
                'disabled' => $linkModel->id ? false: true,
            ])?>
        <?= Html::endTag('fieldset') ?>
    </div>
<?php ActiveForm::end() ?>
<hr/>
<div class="row">
<?php
    $items = [];
    unset($linkModel->images);
    foreach ($linkModel->images as $image) {
        $a_main = Html::a('<span class="glyphicon glyphicon-check"></span>', '#', [
            'id' => "img-set-main", 'class' => "btn btn-default btn-sm",
            'role' => "button", 'title' => "Назначить главной",
        ]);
        $a_del = Html::a('<span class="glyphicon glyphicon-remove"></span>', ['/category-img/delete', 'id' => $image->id], [
            'id' => "img-del", 'class' => "btn btn-default btn-sm",
            'role' => "button", 'title' => "Удалить",
            'data' => [
                'confirm' => 'Вы действительно хотите удалить изображение?',
                'pjax' => 1,
            ],
        ]);
        $content = $image->is_main ? '<img src="/images/'.$image->name.'"/>'.$a_del : '<img src="/images/'.$image->name.'"/>'.$a_del.$a_main;
        $items[] = [
            'content' => '<div class="img-container">'.$content.'</div>',
            'caption' =>  $image->is_main ? '<p>Главная фотография</p>' : False,
        ];
    }
    if (sizeof($items) > 0)
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