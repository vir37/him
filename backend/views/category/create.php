<?php

use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Новая категория';
$this->params['breadcrumbs'][] = ['label' => 'Управление каталогами', 'url' => ['catalogue/']];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-image fa-2x" aria-hidden="true"></i>
            <h3 class="panel-title">Изображения категории</h3>
        </div>
        <div class="panel-body">
            <?php Pjax::begin([ 'enableReplaceState' => false, 'enablePushState' => false, 'timeout' => 6000 ]); ?>
            <?= $this->render('/common/_images', [
                'model' => $imageUploader,
                'linkModel' => $model,
            ]) ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>