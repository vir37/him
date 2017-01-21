<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CatalogueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalogue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
        'id' => 'searchForm'
    ]); ?>

    <?= $form->field($model, 'name', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('name'),
            'id' => 'searchField',
        ],
        'template' => '<div lass="row"><div class="col-sm-11 col-md-11 col-lg-11">{input}{error}{hint}</div></div>',
        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">'.
            Html::a('<span class="glyphicon glyphicon-remove"></span>',
                '#', [ 'id' => 'searchFieldReset']).
            '</span></div>',
    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span>', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    window.onload = function() {
        document.getElementById('searchFieldReset').addEventListener('click', function(){
            $(this).closest('form')[0].reset();
            $(this).closest('.input-group ').find('input').val('');
        })
    }
</script>