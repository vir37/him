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
    <div class="col-lg-4 col-md-4">
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>',
            [ '/warehouse/unlink-contact', 'contact_id' => $key, 'id' => $_params_['warehouse']->id ],
            [
                'title' => 'Отвязать контакт',
                'data' => [
                    'confirm' => 'Вы действительно хотите отвязать контакт?',
                ],
            ]
        ) ?>
        <?= $model->FIO ?>
    </div>
    <div class="col-lg-4 col-md-4"><span class="glyphicon glyphicon-phone-alt"></span><?= toLink($model->phones, 'tel') ?></div>
    <div class="col-lg-4 col-md-4"><span class="glyphicon glyphicon-envelope"></span><?= toLink($model->emails, 'mailto') ?></div>
</div>
