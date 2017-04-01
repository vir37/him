<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 01.04.2017
 * Time: 10:25
 */
use yii\helpers\Html;
?>
<div class="row">
<?= Html::tag('div', $model->name, ['class' => 'col-lg-8 col-md-8']) ?>
<?= Html::tag('div', $model->list_position, ['class' => 'col-lg-2 col-md-2']) ?>
</div>