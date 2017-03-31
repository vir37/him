<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.03.2017
 * Time: 22:41
 */
use yii\helpers\Html,
    yii\helpers\ArrayHelper,
    yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\Catalogue;
use yii\widgets\Pjax;

$product_id = isset($product_id) ? $product_id : null;
?>
<?php Pjax::begin([ 'enableReplaceState' => false, 'enablePushState' => false, 'timeout' => 6000 ]); ?>

<?= Html::beginTag('fieldset', [ 'disabled' => ((isset($mode) && $mode == 'view') || !isset($product_id)) ]) ?>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-sitemap fa-2x" aria-hidden="true"></i>
        <h3 class="panel-title">Связанные категории</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php $form = ActiveForm::begin([
                'action' => ['assign-category'],
                'layout' => 'inline',
                'fieldConfig' => [
                    'labelOptions' => [ 'class' => 'control-label', ],
                ]
            ]); ?>
            <?= $form->field($model, 'product_id')->hiddenInput(['value' => $product_id])->label(false) ?>
            <div class="form-group  col-lg-4 col-md-4">
                <?= Html::label('Каталог', 'catalogue_select', ['class' => 'control-label col-lg-4 col-md-4']) ?>
                <div class="col-lg-8 col-md-8">
                <?= Html::dropDownList('catalogue_select', null,
                    ArrayHelper::map(Catalogue::find()->all(), 'id', 'name'),[
                        'id' => 'catalogue_select',
                        'prompt' => '...',
                        'data-target' => '#category_id',   // Целевой контейнер, который будет заполняться списком категорий
//                        'data-url' => '/category/list?product_id='.$product_id,    // URL для AJAX-запроса данных
                        'data-url' => '/category/list?product_id='.$product_id. '&include=0',    // URL для AJAX-запроса данных
                        'class' => 'form-control',
                    ])?>
                </div>
                <i class="fa fa-spinner fa-spin fa-2x fa-fw loader-hide" style="position: absolute;"></i>
            </div>
            <?= $form->field($model, 'category_id', [
                'labelOptions' => ['class' => 'control-label col-lg-4 col-md-5'],
                'inputTemplate' => '<div class="col-lg-6 col-md-5">{input}</div>',
                'options' => ['class' => 'form-group col-lg-7 col-md-7'],
            ])->dropDownList( [], [
                'prompt' => '...',
                'id' => 'category_id',
            ])->label('Категория') ?>
            <?= Html::submitButton('<i class="fa fa-link"></i>', [
                'class' => 'btn btn-primary',
                'name' => 'add',
                'title' => 'Привязать категорию',
            ]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?= Html::endTag('fieldset') ?>
<?php Pjax::end(); ?>
