<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Supplier */

$this->title = "Новый поставщик";
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => "Поставщики", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_tabs', [
        'model' => $model,
    ]) ?>

</div>
