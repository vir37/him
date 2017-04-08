<?php

use yii\helpers\Html,
    yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use \common\models\FeatureType,
    \common\models\Uom;

/* @var $this yii\web\View */
/* @var $model common\models\Feature */
/* @var $form yii\widgets\ActiveForm */
$type_list = ArrayHelper::map(FeatureType::find()->all(), 'id', 'type');
$uom_list = ArrayHelper::map(Uom::find()->all(), 'id', 'name')
?>

<div class="feature-form col-lg-6 col-md-5">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'offset' => '',
                'label' => 'col-lg-4 col-md-4',
                'wrapper' => 'col-lg-8 col-md-8',
                'error' => '',
                'hint' => '',
            ]
        ],
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <?= $form->field($model, 'short_name', [
                'template' => '{label}{beginWrapper}{input}{error}{hint}{endWrapper}',
                'options' => [ 'class' => 'row' ],
                'labelOptions' => [ 'class' => 'col-lg-5 col-md-5' ],
                'wrapperOptions' => [ 'class' => 'col-lg-6 col-md-6 col-lg-offset-1 col-md-offset-1' ],
            ])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name' , [ 'options' => [ 'class' => 'row' ] ] )->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type_id', [ 'options' => [ 'class' => 'row' ] ])
                ->dropDownList($type_list, [ 'prompt' => '...' ]) ?>

            <?= $form->field($model, 'uom_id', [ 'options' => [ 'class' => 'row' ] ])
                ->dropDownList($uom_list, [ 'prompt' => '...' ]) ?>
        </div>

        <div class="panel-footer">
            <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
