<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.03.2017
 * Time: 22:40
 */
use yii\bootstrap\Tabs;
if (!isset($mode))
    $mode = 'view';
if (!isset($containerClass))
    $containerClass = 'product-view';
?>
<?= Tabs::widget([
    'items' => [
        [
            'label' => 'основная информация',
            'content' => $this->render('_tab1', [
                'mode' => $mode,
                'model' => $model,
                'imageUploader' => $imageUploader,
            ]),
        ],
        [
            'label' => 'Характеристики',
            'content' => $this->render('_tab2'),
        ],
    ],
]) ?>
