<?php

use yii\helpers\Html,
    yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Catalogue,
    common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */

$catalogueList = Catalogue::find()->all();
if (!is_array($catalogueList))
    $catalogueList = [$catalogueList];
$catalogueList = ArrayHelper::map($catalogueList, 'id', 'name');
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?= $form->field($model, 'catalogue_id', [
        'labelOptions' => [ 'class' => 'control-label col-lg-5 col-md-5'],
        'inputTemplate' => '<div class="col-lg-7 col-md-7">{input}</div>
                    <i class="fa fa-spinner fa-spin fa-2x fa-fw loader-hide" style="position: absolute;"></i>',
        'options' => [ 'class' => 'form-group col-lg-5 col-md-5'],
    ])->dropDownList( $catalogueList, [
        'id' => 'catalogue_select',
        'data-target' => '#category_id',   // Целевой контейнер, который будет заполняться списком категорий
        'data-url' => '/category/list',    // URL для AJAX-запроса данных
//        'disabled' => $model->catalogue_id,
        'prompt' => '...',
        'options' => $model->catalogue_id ? ["$model->catalogue_id" => ["selected" => true]] : [],
    ])->label('Каталог') ?>



    <?= $form->field($model, 'category_id', [
        'labelOptions' => ['class' => 'control-label col-lg-4 col-md-5'],
        'inputTemplate' => '<div class="col-lg-6 col-md-5">{input}</div>',
        'options' => ['class' => 'form-group col-lg-7 col-md-7'],
    ])->dropDownList( ArrayHelper::map(Category::find()->
            where(['catalogue_id' => $model->catalogue_id])->all(), 'id', 'name'), [
        'prompt' => '...',
        'id' => 'category_id',
        'data-submitform' => "#{$form->id}",
    ])->label('Категория') ?>
    <?php ActiveForm::end(); ?>

</div>
