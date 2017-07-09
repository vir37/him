<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.07.2017
 * Time: 10:47
 */
use yii\helpers\Html;
?>
<div data-key="<?= $key ?>" class="row contact-view">
    <div class="col-lg-1 col-md-1">
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>',
            [ '/supplier/unlink-contact', 'contact_id' => $key, 'id' => $_params_['supplier']->id ],
            [
                'class' => 'btn',
                'title' => 'Отвязать контакт',
                'data' => [
                    'pjax' => 0,
                ],
                'onclick' => 'removeContact(this);',
            ]
        ) ?>
    </div>
    <div class="col-lg-11 col-md-11">
        <div class="col-lg-4 col-md-4"><?= $model->FIO ?></div>
        <div class="col-lg-4 col-md-4"><span class="glyphicon glyphicon-phone-alt">&nbsp;</span><?= toLink($model->phones, 'tel') ?></div>
        <div class="col-lg-4 col-md-4"><span class="glyphicon glyphicon-envelope">&nbsp;</span><?= toLink($model->emails, 'mailto') ?></div>
    </div>
</div>
