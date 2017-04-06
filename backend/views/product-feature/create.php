<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductFeature */

$this->title = Yii::t('app', 'Create Product Feature');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Features'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-feature-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
