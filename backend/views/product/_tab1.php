<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.03.2017
 * Time: 22:41
 */
use yii\widgets\Pjax;

use yii\helpers\Html;
if (!isset($imageUploader))
    $imageUploader = null;
?>

    <?= Html::beginTag('fieldset', [ 'disabled' => (isset($mode) && $mode == 'view') ]) ?>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        <div class="image-form">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-image fa-2x" aria-hidden="true"></i>
                    <h3 class="panel-title">Изображения товара</h3>
                </div>
                <div class="panel-body">
                    <?php Pjax::begin([ 'enableReplaceState' => false, 'enablePushState' => false, 'timeout' => 60000 ]); ?>
                        <?= $this->render('/common/_images', [
                            'model' => $imageUploader,
                            'linkModel' => $model,
                        ]) ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    <?= Html::endTag('fieldset') ?>
