<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.06.2017
 * Time: 11:01
 */

use yii\helpers\Html;
?>

<?= Html::beginTag('fieldset', [ 'disabled' => (isset($mode) && $mode == 'view') ]) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<?= Html::endTag('fieldset') ?>
