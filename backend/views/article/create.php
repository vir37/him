<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Новая статья';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = ['label' => 'Текстовые статья', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
