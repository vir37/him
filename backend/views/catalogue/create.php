<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Catalogue */

$this->title = 'Новый каталог';
$this->params['breadcrumbs'][] = [ 'label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = [ 'label' => 'Список каталогов', 'url' => ['catalogue/list']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="catalogue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
