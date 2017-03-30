<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.03.2017
 * Time: 22:41
 */
use yii\helpers\Html;
?>
<?= Html::beginTag('fieldset', [ 'disabled' => (isset($mode) && $mode == 'view') ]) ?>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-tasks fa-2x" aria-hidden="true"></i>
        <h3 class="panel-title">Характеристики</h3>
    </div>
    <div class="panel-body">
    </div>
</div>

<?= Html::endTag('fieldset') ?>
